<?php

namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use app\models\User;
use app\models\Aluno;
use app\models\UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\db\IntegrityException;
use yii\base\Exception;
use app\models\UploadLattesForm;
use app\models\UploadCvsdisciplinasForm;
use app\models\UploadCvsalunosForm;
use yii\web\UploadedFile;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                          return (Yii::$app->user->identity->checarAcesso('administrador') || Yii::$app->user->identity->checarAcesso('secretaria'));
                        }
                    ],
                    [   'actions' => ['perfil', 'lattes', 'uploadDisciplinas'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                      [ 'actions' => ['update'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                               return Yii::$app->user->identity->id == filter_input(INPUT_GET, 'id') ;
                        }
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionPerfil()
    {
        return $this->render('perfil', [
            'model' => $this->findModel(Yii::$app->user->identity->id),
        ]);
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->setPassword();
            if($model->save()){
                $this->mensagens('success', 'Usuário Alterado', 'Usuário alterado com sucesso.');
                return Yii::$app->user->identity->checarAcesso('administrador') ? $this->redirect(['view', 'id' => $model->id]) : $this->redirect(['perfil']);
            }
            else
                $this->mensagens('danger', 'Erro ao Alterar Usuário', 'Ocorreu um erro ao alterar o usuário. Verifique os campos e tente novamente.');
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        if($model->professor){
            $alunos = $model->getAlunos($model->id);
            if($alunos){
                $this->mensagens('warning', 'Usuário com alunos associados', 'O usuário corrente é professor e possui alunos.');
                return $this->redirect(['index']);
            }
        }

        try{
            $model->delete();
            $this->mensagens('success', 'Usuário Removido', 'Usuário removido com sucesso.');
        }catch(IntegrityException $e){
            $this->mensagens('danger', 'Erro ao Remover Usuário', 'Ocorreu um erro ao remover o Usuário.');
        }

        return $this->redirect(['index']);
    }

    /**
     * Uploads Lattes.
     * @return mixed
     */
    public function actionCvsalunos()
    {
        $model = new UploadCvsalunosForm();
        $dir = '';

        if (Yii::$app->request->isPost) {
            $model->csvAlunosFile = UploadedFile::getInstance($model, 'csvAlunosFile');
            if($model->upload()){
              $dir = 'uploads/alunosCsv.csv';
              $handle = fopen($dir, "r");
              fgetcsv($handle);
              fgetcsv($handle);
              while (($fileop = fgetcsv($handle, 0, ";")) !== false)
                     {
                        $id_pessoa = utf8_encode($fileop[0]);
                        $nome_pessoa = utf8_encode($fileop[1]);
                        $sexo = utf8_encode($fileop[2]);
                        $dt_nascimento = utf8_encode($fileop[3]);
                        $dt_nascimento = substr($dt_nascimento, 0, 10);
                        $forma_ingresso = utf8_encode($fileop[4]);
                        $forma_evasao = utf8_encode($fileop[5]);
                        $cod_curso = utf8_encode($fileop[6]);
                        $nome_unidade = utf8_encode($fileop[7]);
                        $matr_aluno = utf8_encode($fileop[8]);
                        $num_versao = utf8_encode($fileop[9]);
                        $periodo_ingresso = utf8_encode($fileop[10]);
                        $dt_evasao = utf8_encode($fileop[11]);
                        $dt_evasao = substr($dt_evasao, 0, 10);
                        $periodo_evasao = utf8_encode($fileop[12]);

                        $sql = "INSERT INTO j17_aluno_grad VALUES ('$id_pessoa', '$nome_pessoa', '$sexo', '$dt_nascimento', '$forma_ingresso', '$forma_evasao', '$cod_curso', '$nome_unidade', '$matr_aluno', '$num_versao', '$periodo_ingresso', '$dt_evasao', '$periodo_evasao') ON DUPLICATE KEY UPDATE MATR_ALUNO = MATR_ALUNO";
                        $query = Yii::$app->db->createCommand($sql)->execute();
                     }

              $this->mensagens('success', 'Sucesso', 'Upload foi realizado com sucesso.');
            } else {
              $this->mensagens('danger', 'ERRO', 'UPLOAD csv nao esta correto.');
            }
        }
		return $this->render('cvsalunos', ['model' => $model]);
    }


    /**
     * Uploads Lattes.
     * @return mixed
     */
    public function actionLattes()
    {
        $model = new UploadLattesForm();
        $idUsuario = Yii::$app->user->identity->id;
        $dir = '';

        if (Yii::$app->request->isPost) {
            $model->lattesFile = UploadedFile::getInstance($model, 'lattesFile');
            if ($model->upload($idUsuario)) {
                // file is uploaded successfully
                $dir = 'uploads/lattes-'.$idUsuario.'.xml';
                $xml = simplexml_load_file($dir);
                $formacao = '';

                $idLattes = $xml['NUMERO-IDENTIFICADOR'];
                if(!empty($xml->{'DADOS-GERAIS'}->{'FORMACAO-ACADEMICA-TITULACAO'}->{'DOUTORADO'})){
                  $formacao = "3;" . $xml->{'DADOS-GERAIS'}->{'FORMACAO-ACADEMICA-TITULACAO'}->{'DOUTORADO'}['NOME-CURSO'] . ";" . $xml->{'DADOS-GERAIS'}->{'FORMACAO-ACADEMICA-TITULACAO'}->{'DOUTORADO'}['NOME-INSTITUICAO'] . ";" . $xml->{'DADOS-GERAIS'}->{'FORMACAO-ACADEMICA-TITULACAO'}->{'DOUTORADO'}['ANO-DE-CONCLUSAO'];
                } else if(!empty($xml->{'DADOS-GERAIS'}->{'FORMACAO-ACADEMICA-TITULACAO'}->{'MESTRADO'})){
                  $formacao = "2;" . $xml->{'DADOS-GERAIS'}->{'FORMACAO-ACADEMICA-TITULACAO'}->{'MESTRADO'}['NOME-CURSO'] . ";" . $xml->{'DADOS-GERAIS'}->{'FORMACAO-ACADEMICA-TITULACAO'}->{'MESTRADO'}['NOME-INSTITUICAO'] . ";" . $xml->{'DADOS-GERAIS'}->{'FORMACAO-ACADEMICA-TITULACAO'}->{'MESTRADO'}['ANO-DE-CONCLUSAO'];
                } else {
                  $formacao = "1;" . $xml->{'DADOS-GERAIS'}->{'FORMACAO-ACADEMICA-TITULACAO'}->{'GRADUACAO'}['NOME-CURSO'] . ";" . $xml->{'DADOS-GERAIS'}->{'FORMACAO-ACADEMICA-TITULACAO'}->{'GRADUACAO'}['NOME-INSTITUICAO'] . ";" . $xml->{'DADOS-GERAIS'}->{'FORMACAO-ACADEMICA-TITULACAO'}->{'GRADUACAO'}['ANO-DE-CONCLUSAO'];
                }

                $resumo = $xml->{'DADOS-GERAIS'}->{'RESUMO-CV'}['TEXTO-RESUMO-CV-RH'];
                $data = date('d/m/Y');

                $connection = Yii::$app->getDb();
                $command = $connection->createCommand("UPDATE j17_user SET idLattes=:column1, formacao=:column2, resumo=:column3, ultimaAtualizacao=:column4 WHERE id=:id")
                ->bindValue(':column1', $idLattes)
                ->bindValue(':column2', $formacao)
                ->bindValue(':column3', $resumo)
                ->bindValue(':column4', $data)
                ->bindValue(':id', $idUsuario)
                ->execute();

                foreach ($xml->{'DADOS-GERAIS'}->{'PREMIOS-TITULOS'} as $premio) {
          				for ($i=0; $i < count($premio); $i++) {
          					$titulo = $premio->{'PREMIO-TITULO'}[$i]['NOME-DO-PREMIO-OU-TITULO'];
          					$entidade = $premio->{'PREMIO-TITULO'}[$i]['NOME-DA-ENTIDADE-PROMOTORA'];
          					$ano = $premio->{'PREMIO-TITULO'}[$i]['ANO-DA-PREMIACAO'];
          					$sql = "INSERT INTO j17_premios (idProfessor, titulo, entidade, ano) VALUES ($idUsuario, '$titulo', '$entidade', '$ano') ON DUPLICATE KEY UPDATE id = id";
                    Yii::$app->db->createCommand($sql)->execute();

                  }
          			}

                $this->mensagens('success', 'Sucesso', 'Upload foi realizado com sucesso.');
            } else {
              $this->mensagens('danger', 'UPLOAD xml nao esta correto.');
            }
        }
		return $this->render('lattes', ['model' => $model]);
    }

	/**
     * Uploads Lattes.
     * @return mixed
     */


    public function actionCvsdisciplinas()
    {
        $model = new UploadCvsdisciplinasForm();

        if (Yii::$app->request->isPost) {
            $model->csvDisciplinasFile = UploadedFile::getInstance($model, 'csvDisciplinasFile');
            if ($model->upload(Yii::$app->user->identity->id)) {
                // file is uploaded successfully
				$this->mensagens('success', 'Sucesso', 'Upload realizado com sucesso.');
				//return $this->redirect(['lattes');
            }
        }
		return $this->render('cvsdisciplinas', ['model' => $model]);
		//var_dump($model);
	}

	// Método que atualiza o banco com os formandos do período
    public function actionPit()
    {

		$token = "108FEF2DC23A626489596417D31C7729-".date("d-m-Y");
		$tokenMD5 = MD5($token);
		$link = 'http://200.129.163.42:8080/viper/listaFormados?cod_curso=IE08&ano_evasao=2016&periodo_evasao=1&sistema=PPGI&tkn='.$tokenMD5;
		var_dump($link);

        $webservice = @file_get_contents($link);

        // Verifica se o WS está disponivel
        //Caso negativo ele exibe o formulario em branco
        if($webservice == null)
        {
            echo "ERRO NO WEBSERVICE";

        }

        $dados = json_decode($webservice, true);

		var_dump($dados);

    }



    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('A página solicitada não existe.');
        }
    }

    /* Envio de mensagens para views
   Tipo: success, danger, warning*/
    protected function mensagens($tipo, $titulo, $mensagem){
        Yii::$app->session->setFlash($tipo, [
            'type' => $tipo,
            'icon' => 'home',
            'duration' => 5000,
            'message' => $mensagem,
            'title' => $titulo,
            'positonY' => 'top',
            'positonX' => 'center',
            'showProgressbar' => true,
        ]);
    }
}

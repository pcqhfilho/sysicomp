<?php

namespace numeros\controllers;

use Yii;
use numeros\models\Graduacao;
use numeros\models\GraduacaoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * GraduacaoController implements the CRUD actions for Graduacao model.
 */
class GraduacaoController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Graduacao models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new GraduacaoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    // Actions referentes as views de pesquisa de cada curso
    public function actionAlunosPd(){
        return $this->alunosFormados('Processamento de Dados');
    }

    public function actionAlunosCc(){
        return $this->alunosFormados('Ciência da Computação');
    }

    public function actionAlunosSi()
    {
        return $this->alunosFormados('Sistemas de Informação');
    }

    /* Função que renderiza view para alunos formados em Processamento de Dados ou
    Ciência da Computação ou Sistemas de Informação */
    private function alunosFormados($curso){
        if($curso == "Processamento de Dados"){
            $busca_curso = 'IE06';
            $searchModel = new GraduacaoSearch();
            $dataProvider = $searchModel->searchAlunos(Yii::$app->request->queryParams, $busca_curso);        
            
        }else if($curso == "Ciência da Computação"){
            $busca_curso = 'IE08';
            $searchModel = new GraduacaoSearch();
            $dataProvider = $searchModel->searchAlunos(Yii::$app->request->queryParams, $busca_curso);        
                   
        }else{
            $busca_curso = 'IE15';
            $searchModel = new GraduacaoSearch();
            $dataProvider = $searchModel->searchAlunos(Yii::$app->request->queryParams, $busca_curso);                    
        }

        //query que retorna a quantidade de alunos do curso parametro
        $qtdEgr = (new \yii\db\Query())
        ->from('j17_aluno_grad')
        ->where(['FORMA_EVASAO' => 'Formado', 'COD_CURSO' => $busca_curso])
        ->count();
        
        return $this->render('index',[
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'qtdEgr' => $qtdEgr,
            'curso' => $curso
        ]);
    }

    /**
     * Displays a single Graduacao model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Graduacao model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Graduacao();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Graduacao model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Graduacao model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Graduacao model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Graduacao the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Graduacao::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

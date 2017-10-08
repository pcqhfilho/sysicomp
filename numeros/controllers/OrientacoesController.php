<?php

namespace numeros\controllers;
use Yii;
use numeros\models\Professor;
use numeros\models\Orientacoes;

class OrientacoesController extends \yii\web\Controller
{
    private function changeDataFormat($data){
        if($data)
        if($data[2] != '/'){
          $date = date_create($data);
          return date_format($date, 'd/m/Y');
        }
        return $data;
    }

    public function actions()
    {
        $this->layout = "@numeros/views/layouts/professorMain.php";
    }

    public function actionGraduacao($id)
    {
        $modelProfessor = new Professor();
        $modelOrientacoes = new Orientacoes();

        $professor = $modelProfessor->getProfessor($id);
        $updatedAt = $this->changeDataFormat($professor['updated_at']);

        //Povoando variaveis com Querys referentes a Graduação
        //utilizando os parametros id do professor, tipo e status

        /*
        - Tipo (1 - Graduação, 2 - Mestrado, 3 - Doutorado)
        - Status (1 - Em Andamento, 2 - Concluída)
	    */

        $orientacoesAndamentoGraduacao = $modelOrientacoes->getOrientacoesPorTipoStatus($id, 1, 1);
        $orientacoesConcluidasGraduacao = $modelOrientacoes->getOrientacoesPorTipoStatus($id, 1, 2);

        $orientacoesAndamentoGraduacaoPorAno = $modelOrientacoes->getOrientacoesPorAnoTipoStatus($id, 1, 1);
        $orientacoesConcluidasGraduacaoPorAno = $modelOrientacoes->getOrientacoesPorAnoTipoStatus($id, 1, 2);

        $countOrientacoesAndamentoGraduacao = $modelOrientacoes->getCountOrientacoesPorTipoStatus($id, 1, 1);
        $countOrientacoesConcluidasGraduacao = $modelOrientacoes->getCountOrientacoesPorTipoStatus($id, 1, 2);

        return $this->render('graduacao', [
            'professor' => $professor,
            'updatedAt' => $updatedAt,
            'orientacoesAndamentoGraduacao' => $orientacoesAndamentoGraduacao,
            'orientacoesConcluidasGraduacao' => $orientacoesConcluidasGraduacao,
            'orientacoesAndamentoGraduacaoPorAno' => $orientacoesAndamentoGraduacaoPorAno,
            'orientacoesConcluidasGraduacaoPorAno' => $orientacoesConcluidasGraduacaoPorAno,
            'countOrientacoesAndamentoGraduacao' => $countOrientacoesAndamentoGraduacao,
            'countOrientacoesConcluidasGraduacao' => $countOrientacoesConcluidasGraduacao
        ]);
    }

    public function actionMestrado($id)
    {
        $modelProfessor = new Professor();
        $modelOrientacoes = new Orientacoes();

        $professor = $modelProfessor->getProfessor($id);
        $updatedAt = $this->changeDataFormat($professor['updated_at']);

        //Povoando variaveis com Querys referentes a Mestrado
        //utilizando os parametros id do professor, tipo e status

        /*
        - Tipo (1 - Graduação, 2 - Mestrado, 3 - Doutorado)
        - Status (1 - Em Andamento, 2 - Concluída)
	    */

        $orientacoesAndamentoMestrado = $modelOrientacoes->getOrientacoesPorTipoStatus($id, 2, 1);
        $orientacoesConcluidasMestrado = $modelOrientacoes->getOrientacoesPorTipoStatus($id, 2, 2);

        $orientacoesAndamentoMestradoPorAno = $modelOrientacoes->getOrientacoesPorAnoTipoStatus($id, 2, 1);
        $orientacoesConcluidasMestradoPorAno = $modelOrientacoes->getOrientacoesPorAnoTipoStatus($id, 2, 2);

        $countOrientacoesAndamentoMestrado = $modelOrientacoes->getCountOrientacoesPorTipoStatus($id, 2, 1);
        $countOrientacoesConcluidasMestrado = $modelOrientacoes->getCountOrientacoesPorTipoStatus($id, 2, 2);

        return $this->render('mestrado', [
            'professor' => $professor,
            'updatedAt' => $updatedAt,
            'orientacoesAndamentoMestrado' => $orientacoesAndamentoMestrado,
            'orientacoesConcluidasMestrado' => $orientacoesConcluidasMestrado,
            'orientacoesAndamentoMestradoPorAno' => $orientacoesAndamentoMestradoPorAno,
            'orientacoesConcluidasMestradoPorAno' => $orientacoesConcluidasMestradoPorAno,
            'countOrientacoesAndamentoMestrado' => $countOrientacoesAndamentoMestrado,
            'countOrientacoesConcluidasMestrado' => $countOrientacoesConcluidasMestrado
        ]);
    }

    public function actionDoutorado($id)
    {
        $modelProfessor = new Professor();
        $modelOrientacoes = new Orientacoes();

        $professor = $modelProfessor->getProfessor($id);
        $updatedAt = $this->changeDataFormat($professor['updated_at']);

        //Povoando variaveis com Querys referentes a Doutorado
        //utilizando os parametros id do professor, tipo e status

        /*
        - Tipo (1 - Graduação, 2 - Mestrado, 3 - Doutorado)
        - Status (1 - Em Andamento, 2 - Concluída)
	    */

        $orientacoesAndamentoDoutorado = $modelOrientacoes->getOrientacoesPorTipoStatus($id, 3, 1);
        $orientacoesConcluidasDoutorado = $modelOrientacoes->getOrientacoesPorTipoStatus($id, 3, 2);

        $orientacoesAndamentoDoutoradoPorAno = $modelOrientacoes->getOrientacoesPorAnoTipoStatus($id, 3, 1);
        $orientacoesConcluidasDoutoradoPorAno = $modelOrientacoes->getOrientacoesPorAnoTipoStatus($id, 3, 2);

        $countOrientacoesAndamentoDoutorado = $modelOrientacoes->getCountOrientacoesPorTipoStatus($id, 3, 1);
        $countOrientacoesConcluidasDoutorado = $modelOrientacoes->getCountOrientacoesPorTipoStatus($id, 3, 2);

        return $this->render('doutorado', [
            'professor' => $professor,
            'updatedAt' => $updatedAt,
            'orientacoesAndamentoDoutorado' => $orientacoesAndamentoDoutorado,
            'orientacoesConcluidasDoutorado' => $orientacoesConcluidasDoutorado,
            'orientacoesAndamentoDoutoradoPorAno' => $orientacoesAndamentoDoutoradoPorAno,
            'orientacoesConcluidasDoutoradoPorAno' => $orientacoesConcluidasDoutoradoPorAno,
            'countOrientacoesAndamentoDoutorado' => $countOrientacoesAndamentoDoutorado,
            'countOrientacoesConcluidasDoutorado' => $countOrientacoesConcluidasDoutorado
        ]);
    }
}

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

}

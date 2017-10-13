<?php

namespace numeros\controllers;

use Yii;
use numeros\models\Graduacao;
use numeros\models\GraduacaoSearch;
use yii\web\Controller;

class GraduacaoController extends Controller
{

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
        $searchModel = new GraduacaoSearch();
        if($curso == "Processamento de Dados"){
            $busca_curso = 'IE06';
            $dataProvider = $searchModel->searchAlunos(Yii::$app->request->queryParams, $busca_curso);        
        }else if($curso == "Ciência da Computação"){
            $busca_curso = 'IE08';            
            $dataProvider = $searchModel->searchAlunos(Yii::$app->request->queryParams, $busca_curso);        
        }else{
            $busca_curso = 'IE15';
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
}

<?php

namespace numeros\controllers;
use Yii;
use numeros\models\Professor;

class ProfessorController extends \yii\web\Controller
{

    //muda data de y-m-d para d/m/Y
    private function changeDataFormat($data){
            if($data)
            if($data[2] != '/'){
              $date = date_create($data);
              return date_format($date, 'd/m/Y');
            }
            return $data;
    }

    public function actions(){

        $this->layout = '@numeros/views/layouts/professorMain.php';
    }

    public function actionIndex($id)
    {
        $modelProfessor = new Professor();
        $professor = $modelProfessor->getProfessor($id);
        $updatedAt = $this->changeDataFormat($professor['updated_at']);
        return $this->render('index', [
            'professor' => $professor,
            'updatedAt' => $updatedAt,
            ]);
    }

    public function actionPublicacao($id)
    {
        $modelProfessor = new Professor();
        $professor = $modelProfessor->getProfessor($id);
        $updatedAt = $this->changeDataFormat($professor['updated_at']);
        return $this->render('publicacao', [
            'professor' => $professor,
            'updatedAt' => $updatedAt,
            ]);
    }

    public function actionGraduacao($id)
    {
        $modelProfessor = new Professor();
        $professor = $modelProfessor->getProfessor($id);
        $updatedAt = $this->changeDataFormat($professor['updated_at']);
        return $this->render('graduacao', [
            'professor' => $professor,
            'updatedAt' => $updatedAt,
            ]);
    }

    public function actionMestrado($id)
    {
        $modelProfessor = new Professor();
        $professor = $modelProfessor->getProfessor($id);
        $updatedAt = $this->changeDataFormat($professor['updated_at']);
        return $this->render('mestrado', [
            'professor' => $professor,
            'updatedAt' => $updatedAt,
            ]);
    }

    public function actionDoutorado($id)
    {
        $modelProfessor = new Professor();
        $professor = $modelProfessor->getProfessor($id);
        $updatedAt = $this->changeDataFormat($professor['updated_at']);
        return $this->render('doutorado', [
            'professor' => $professor,
            'updatedAt' => $updatedAt,
            ]);
    }
}

<?php

namespace numeros\controllers;
use Yii;
use numeros\models\Professor;

class ProfessorController extends \yii\web\Controller
{

    // This function changes the date format 'y-m-d' to 'd/m/Y' because in the stored data contains both those date formats
    public function changeDataFormat($data){
            if($data)
            if($data[2] != '/'){
              $date = date_create($data);
              return date_format($date, 'd/m/Y');
            }
            return $data;
    }

    public function actions()
    {
        $this->layout = '@numeros/views/layouts/professorMain.php';
    }

    public function actionIndex($id)
    {
        $modelProfessor = new Professor();
        $updatedAt = $modelProfessor->getUpdatedAt($id);
        $updatedAt = $this->changeDataFormat($updatedAt);
        return $this->render('index', [
            'id' => $id,
            'updatedAt' => $updatedAt,
            ]);
    }

    public function actionPublicacao($id)
    {
        $modelProfessor = new Professor();
        $updatedAt = $modelProfessor->getUpdatedAt($id);
        $updatedAt = $this->changeDataFormat($updatedAt);
        return $this->render('publicacao', [
            'id' => $id,
            'updatedAt' => $updatedAt,
            ]);
    }

    public function actionProjeto($id)
    {
        $modelProfessor = new Professor();
        $updatedAt = $modelProfessor->getUpdatedAt($id);
        $updatedAt = $this->changeDataFormat($updatedAt);
        return $this->render('projeto', [
            'id' => $id,
            'updatedAt' => $updatedAt,
            ]);
    }

    public function actionGraduacao($id)
    {
        $modelProfessor = new Professor();
        $updatedAt = $modelProfessor->getUpdatedAt($id);
        $updatedAt = $this->changeDataFormat($updatedAt);
        return $this->render('graduacao', [
            'id' => $id,
            'updatedAt' => $updatedAt,
            ]);
    }

    public function actionMestrado($id)
    {
        $modelProfessor = new Professor();
        $updatedAt = $modelProfessor->getUpdatedAt($id);
        $updatedAt = $this->changeDataFormat($updatedAt);
        return $this->render('mestrado', [
            'id' => $id,
            'updatedAt' => $updatedAt,
            ]);
    }

    public function actionDoutorado($id)
    {
        $modelProfessor = new Professor();
        $updatedAt = $modelProfessor->getUpdatedAt($id);
        $updatedAt = $this->changeDataFormat($updatedAt);
        return $this->render('doutorado', [
            'id' => $id,
            'updatedAt' => $updatedAt,
            ]);
    }

    public function actionPremio($id)
    {
        $modelProfessor = new Professor();
        $updatedAt = $modelProfessor->getUpdatedAt($id);
        $updatedAt = $this->changeDataFormat($updatedAt);
        return $this->render('premio', [
            'id' => $id,
            'updatedAt' => $updatedAt,
            ]);
    }

}

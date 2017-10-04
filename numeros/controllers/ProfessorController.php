<?php

namespace numeros\controllers;

class ProfessorController extends \yii\web\Controller
{
    public function actionIndex($id)
    {
        $this->layout = '@numeros/views/layouts/professorMain.php';
        return $this->render('index');
    }

}

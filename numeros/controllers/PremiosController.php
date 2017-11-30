<?php

namespace numeros\controllers;
use numeros\models\Professor;
use numeros\models\Premios;

class PremiosController extends \yii\web\Controller
{
    //muda data de y-m-d para d/m/Y
    public function changeDataFormat($data){
        if($data)
        if($data[2] != '/'){
          $date = date_create($data);
          return date_format($date, 'd/m/Y');
        }
        return $data;
    }

    public function actionIndex($id)
    {
        $this->layout = '@numeros/views/layouts/professorMain.php';
        $modelProfessor = new Professor();
        $modelPremios = new Premios();

        $professor = $modelProfessor->getProfessor($id);
        $updatedAt = $this->changeDataFormat($professor['updated_at']);

        $premios = $modelPremios->getPremios($id);
        $countPremios = $modelPremios->getCountPremios($id);

        return $this->render('index', [
            'professor' => $professor,
            'updatedAt' => $updatedAt,
            'premios' => $premios,
            'countPremios' => $countPremios,
            ]);
    }



}

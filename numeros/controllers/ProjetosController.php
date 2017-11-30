<?php

namespace numeros\controllers;
use Yii;
use numeros\models\Projetos;
use numeros\models\Professor;

class ProjetosController extends \yii\web\Controller
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
        $modelProjetos = new Projetos();

        $professor = $modelProfessor->getProfessor($id);
        $updatedAt = $this->changeDataFormat($professor['updated_at']);

        $queryProjetos = $modelProjetos->getProjetos($id);
        $queryProjetosPorAno = $modelProjetos->getProjetosPorAno($id);
        $countProjetos = $modelProjetos->getCountProjetos($id);

        return $this->render('index', [
            'professor' => $professor,
            'updatedAt' => $updatedAt,
            'queryProjetos' => $queryProjetos,
            'queryProjetosPorAno' => $queryProjetosPorAno,
            'countProjetos' => $countProjetos,
            ]);
    }

}

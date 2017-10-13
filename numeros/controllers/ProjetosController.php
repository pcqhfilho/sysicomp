<?php

namespace numeros\controllers;
use Yii;
use numeros\models\Projetos;
use numeros\models\Professor;

class ProjetosController extends \yii\web\Controller
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

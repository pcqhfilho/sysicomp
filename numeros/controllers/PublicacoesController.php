<?php

namespace numeros\controllers;
use Yii;
use numeros\models\Professor;
use numeros\models\Publicacoes;

class PublicacoesController extends \yii\web\Controller
{
    // This function changes the date format 'y-m-d' to 'd/m/Y' because in the stored data contains both those date formats
    private function changeDataFormat($data){
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
        $modelPublicacoes = new Publicacoes();

        $professor = $modelProfessor->getProfessor($id);
        $updatedAt = $this->changeDataFormat($professor['updated_at']);

        $publicacoesEmConferencias = $modelPublicacoes->getPublicacoesPorTipo($id, 1);
        $publicacoesEmPeriodicos = $modelPublicacoes->getPublicacoesPorTipo($id, 2);
        $publicacoesEmLivros = $modelPublicacoes->getPublicacoesPorTipo($id, 3);
        $publicacoesEmCapitulos = $modelPublicacoes->getPublicacoesPorTipo($id, 4);

        $publicacoesEmConferenciasPorAno = $modelPublicacoes->getPublicacoesPorTipoPorAno($id, 1);
        $publicacoesEmPeriodicosPorAno = $modelPublicacoes->getPublicacoesPorTipoPorAno($id, 2);

        $countPublicacoesEmConferencias = $modelPublicacoes->getCountPublicacoesPorTipo($id, 1);
        $countPublicacoesEmPeriodicos = $modelPublicacoes->getCountPublicacoesPorTipo($id, 2);
        $countPublicacoesEmLivros = $modelPublicacoes->getCountPublicacoesPorTipo($id, 3);
        $countPublicacoesEmCapitulos = $modelPublicacoes->getCountPublicacoesPorTipo($id, 4);


        return $this->render('index', [
            'professor' => $professor,
            'updatedAt' => $updatedAt,
            'publicacoesEmConferencias' => $publicacoesEmConferencias,
            'publicacoesEmPeriodicos' => $publicacoesEmPeriodicos,
            'publicacoesEmLivros' => $publicacoesEmLivros,
            'publicacoesEmCapitulos' => $publicacoesEmCapitulos,
            'publicacoesEmConferenciasPorAno' => $publicacoesEmConferenciasPorAno,
            'publicacoesEmPeriodicosPorAno' => $publicacoesEmPeriodicosPorAno,
            'countPublicacoesEmConferencias' => $countPublicacoesEmConferencias,
            'countPublicacoesEmPeriodicos' => $countPublicacoesEmPeriodicos,
            'countPublicacoesEmLivros' => $countPublicacoesEmLivros,
            'countPublicacoesEmCapitulos' => $countPublicacoesEmCapitulos,
        ]);
    }

}

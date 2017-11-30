<?php

namespace numeros\controllers;
use Yii;
use numeros\models\Professor;
use numeros\models\Publicacoes;

class PublicacoesController extends \yii\web\Controller
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

    public function actionIndex($id)
    {
        $this->layout = '@numeros/views/layouts/professorMain.php';
        $modelProfessor = new Professor();
        $modelPublicacoes = new Publicacoes();

        $professor = $modelProfessor->getProfessor($id);
        $updatedAt = $this->changeDataFormat($professor['updated_at']);

        //Povoando variaveis com Querys referentes a Publicações
        //utilizando os parametros id do professor e tipo.

        //- Tipo (1 - Conferência, 2 - Periódico, 3 - Livro, 4 - Capítulo)

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

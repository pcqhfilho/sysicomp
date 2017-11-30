<?php

namespace numeros\controllers;
use Yii;
use numeros\models\Publicacoes;

class GraficopublicacoesController extends \yii\web\Controller
{
    public function actionIndex($ano)
    {
        $this->layout = '@numeros/views/layouts/main.php';
        $modelPublicacoes = new Publicacoes();

        $anoAtual = $ano;

        $qtdTotalPublicacoesAno = (new \yii\db\Query())
        ->from('j17_publicacoes')
        ->where([
        'ano' => $anoAtual,
        'tipo' => [1, 2],
        ])
        ->count();

        $qtdConf = (new \yii\db\Query())
        ->from('j17_publicacoes')
        ->where([
        'ano' => $anoAtual,
        'tipo' => 1,
        ])
        ->count();

        $qtdPeriod = (new \yii\db\Query())
        ->from('j17_publicacoes')
        ->where([
        'ano' => $anoAtual,
        'tipo' => 2,
        ])
        ->count();

        $queryPublicacoesConf = (new \yii\db\Query())
          ->from('j17_publicacoes')
          ->where([
              'tipo' => 1,
              'ano' => $anoAtual,
          ])
          ->orderBy('titulo')
          ->all();

        $queryPublicacoesPeriod = (new \yii\db\Query())
          ->from('j17_publicacoes')
          ->where([
              'tipo' => 2,
              'ano' => $anoAtual,
          ])
          ->orderBy('titulo')
          ->all();

        return $this->render('index',[
          'anoAtual' => $anoAtual,
          'qtdTotalPublicacoesAno' => $qtdTotalPublicacoesAno,
          'qtdConf' => $qtdConf,
          'qtdPeriod' => $qtdPeriod,
          'queryPublicacoesConf' => $queryPublicacoesConf,
          'queryPublicacoesPeriod' => $queryPublicacoesPeriod,
        ]);
    }

}

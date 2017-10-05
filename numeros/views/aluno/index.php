<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel numeros\models\AlunoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = ' ALUNOS FORMADOS';
$this->params['breadcrumbs'][] = $this->title;
?>

<div style="display: flex; flex-direction: column; align-items: center;">

    <h2><?= Html::encode($qtdEgr . $this->title) ?></h2>
    <h4 style="text-transform: capitalize"><?= $curso ?></h4>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['attribute' => 'nome',
            'headerOptions' => ['style' => 'width:80%'],
            ],
            ['attribute' => 'anoconclusao',
                'value' => function ($model) {
                    return date("Y", strtotime($model->anoconclusao));
                },
                'headerOptions' => ['style' => 'width:20%'],
            ],
        ],
    ]); ?>
</div>

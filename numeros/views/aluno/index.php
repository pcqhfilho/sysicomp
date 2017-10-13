<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel numeros\models\AlunoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

Pjax::begin();

$this->title = ' ALUNOS FORMADOS';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
    <div style="display: flex; flex-direction: column; align-items: center;">
        <h2><?= Html::encode($qtdEgr . $this->title) ?></h2>
        <h4 style="text-transform: capitalize"><?= $curso ?></h4>
    </div>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute' => 'nome',
                'label' => 'Nome',            
                'headerOptions' => ['style' => 'width:85%'],
            ],
            [
                'attribute' => 'anoconclusao',
                'label' => 'Data de Conclusão',
                'headerOptions' => ['style' => 'width:15%'],                
                'value' => function ($model) {
                    return date("Y", strtotime($model->anoconclusao));
                },    
            ],
        ],
    ]); 
    ?>
</div>
   
<?php Pjax::end(); ?>
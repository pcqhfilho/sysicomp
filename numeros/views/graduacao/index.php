<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel numeros\models\GraduacaoSearch */
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
                'attribute' => 'NOME_PESSOA',
                'label' => 'Nome',
                'headerOptions' => ['style' => 'width:85%'],
            ],
            [
                'attribute' => 'PERIODO_EVASAO',
                'label' => 'Data de Conclusão',
                'value' => function ($aluno){
                    if($aluno['PERIODO_EVASAO']){
                        $data = explode("/", $aluno['PERIODO_EVASAO']);
                        return $data[0];
                    }
                    return $data['PERIODO_EVASAO'];
                },
                'headerOptions' => ['style' => 'width:15%'],
            ],
        ],
    ]); 
    ?>
</div>
   
<?php Pjax::end(); ?>
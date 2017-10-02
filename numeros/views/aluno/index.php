<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel numeros\models\AlunoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Alunos Formados';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="aluno-index">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'nome',
            'email:email',
            'senha',
            'matricula',
            // 'area',
            // 'curso',
            // 'endereco',
            // 'bairro',
            // 'cidade',
            // 'uf',
            // 'cep',
            // 'datanascimento',
            // 'sexo',
            // 'nacionalidade',
            // 'estadocivil',
            // 'cpf',
            // 'rg',
            // 'orgaoexpeditor',
            // 'dataexpedicao',
            // 'telresidencial',
            // 'telcomercial',
            // 'telcelular',
            // 'nomepai',
            // 'nomemae',
            // 'regime',
            // 'bolsista',
            // 'financiadorbolsa',
            // 'dataimplementacaobolsa',
            // 'agencia',
            // 'pais',
            // 'status',
            // 'dataingresso',
            // 'idiomaExameProf',
            // 'conceitoExameProf',
            // 'dataExameProf',
            // 'tituloQual2',
            // 'dataQual2',
            // 'conceitoQual2',
            // 'tituloTese',
            // 'dataTese',
            // 'conceitoTese',
            // 'horarioQual2',
            // 'localQual2',
            // 'resumoQual2:ntext',
            // 'horarioTese',
            // 'localTese',
            // 'resumoTese:ntext',
            // 'tituloQual1',
            // 'numDefesa',
            // 'dataQual1',
            // 'examinadorQual1',
            // 'conceitoQual1',
            // 'cursograd',
            // 'instituicaograd',
            // 'crgrad',
            // 'egressograd',
            // 'dataformaturagrad',
            // 'idUser',
            // 'orientador',
            // 'anoconclusao',
            // 'sede',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>

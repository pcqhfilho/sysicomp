<?php

namespace numeros\models;

use Yii;

/**
 * This is the model class for table "j17_projetos".
 *
 * @property integer $id
 * @property integer $idProfessor
 * @property string $titulo
 * @property string $descricao
 * @property integer $inicio
 * @property integer $fim
 * @property string $papel
 * @property string $financiadores
 * @property string $integrantes
 */
class Projetos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'j17_projetos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'idProfessor', 'titulo', 'descricao', 'inicio', 'papel', 'financiadores', 'integrantes'], 'required'],
            [['id', 'idProfessor', 'inicio', 'fim'], 'integer'],
            [['descricao'], 'string'],
            [['titulo'], 'string', 'max' => 300],
            [['papel'], 'string', 'max' => 15],
            [['financiadores', 'integrantes'], 'string', 'max' => 500],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'idProfessor' => 'Id Professor',
            'titulo' => 'Titulo',
            'descricao' => 'Descricao',
            'inicio' => 'Inicio',
            'fim' => 'Fim',
            'papel' => 'Papel',
            'financiadores' => 'Financiadores',
            'integrantes' => 'Integrantes',
        ];
    }

    public function getProjetos($idProfessor)
    {
        $query = (new \yii\db\Query())
        ->select('*')
        ->from('j17_projetos')
        ->where(['idProfessor' => $idProfessor])
        ->orderBy(['inicio' => SORT_DESC])
        ->all();

        return $query;
    }

    public function getProjetosPorAno($idProfessor)
    {
        $queryProjetosPorAno = (new \Yii\db\Query())
        ->select(['inicio', 'fim'])
        ->from('j17_projetos')
        ->where([
            'and',
            ['idProfessor' => $idProfessor],
            [
                'or', 
                [
                    '>=', 
                    'inicio', 
                    ('Year(now()) - 9')
                ], 
                [
                    '<=', 
                    'fim', 
                    'Year(now())'
                ]  
            ]
        ])
        ->orderBy('inicio ASC')
        ->all();

        return $queryProjetosPorAno;
    }

    public function getCountProjetos($id)
    {
        $countProjetos = (new Yii\db\Query())
        ->from('j17_projetos')
        ->where(['idProfessor' => $id])
        ->count();

        return $countProjetos;
    }
}

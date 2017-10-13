<?php

namespace numeros\models;

use Yii;

/**
 * This is the model class for table "j17_premios".
 *
 * @property integer $id
 * @property integer $idProfessor
 * @property string $titulo
 * @property string $entidade
 * @property integer $ano
 */
class Premios extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'j17_premios';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idProfessor', 'titulo', 'entidade', 'ano'], 'required'],
            [['idProfessor', 'ano'], 'integer'],
            [['titulo', 'entidade'], 'string', 'max' => 200],
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
            'entidade' => 'Entidade',
            'ano' => 'Ano',
        ];
    }

    public function getPremios($id)
    {
        $modelPremios = new Premios();
        $query = (new Yii\db\Query())
        ->from('j17_premios')
        ->where(['idProfessor' => $id])
        ->orderBy(['ano' => SORT_DESC])
        ->all();

        return $query;
    }
    
    public function getCountPremios($id)
    {
        $countPremios = (new Yii\db\Query())
        ->from('j17_premios')
        ->where(['idProfessor' => $id])
        ->count();

        return $countPremios;
    }
}

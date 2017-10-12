<?php

namespace numeros\models;

use Yii;

/**
 * This is the model class for table "j17_aluno_grad".
 *
 * @property int $id
 * @property int $ID_PESSOA
 * @property string $NOME_PESSOA
 * @property string $SEXO
 * @property string $DT_NASCIMENTO
 * @property string $FORMA_INGRESSO
 * @property string $FORMA_EVASAO
 * @property string $COD_CURSO
 * @property string $NOME_UNIDADE
 * @property string $MATR_ALUNO
 * @property string $NUM_VERSAO
 * @property string $PERIODO_INGRESSO
 * @property string $DT_EVASAO
 * @property string $PERIODO_EVASAO
 */
class Graduacao extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'j17_aluno_grad';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID_PESSOA', 'NOME_PESSOA', 'SEXO', 'DT_NASCIMENTO', 'FORMA_INGRESSO', 'FORMA_EVASAO', 'COD_CURSO', 'NOME_UNIDADE', 'MATR_ALUNO', 'NUM_VERSAO', 'PERIODO_INGRESSO', 'DT_EVASAO', 'PERIODO_EVASAO'], 'required'],
            [['ID_PESSOA'], 'integer'],
            [['NOME_PESSOA', 'DT_NASCIMENTO', 'FORMA_INGRESSO', 'FORMA_EVASAO', 'COD_CURSO', 'NOME_UNIDADE', 'MATR_ALUNO', 'NUM_VERSAO', 'PERIODO_INGRESSO', 'DT_EVASAO', 'PERIODO_EVASAO'], 'string', 'max' => 255],
            [['SEXO'], 'string', 'max' => 1],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ID_PESSOA' => 'Id  Pessoa',
            'NOME_PESSOA' => 'Nome  Pessoa',
            'SEXO' => 'Sexo',
            'DT_NASCIMENTO' => 'Dt  Nascimento',
            'FORMA_INGRESSO' => 'Forma  Ingresso',
            'FORMA_EVASAO' => 'Forma  Evasao',
            'COD_CURSO' => 'Cod  Curso',
            'NOME_UNIDADE' => 'Nome  Unidade',
            'MATR_ALUNO' => 'Matr  Aluno',
            'NUM_VERSAO' => 'Num  Versao',
            'PERIODO_INGRESSO' => 'Periodo  Ingresso',
            'DT_EVASAO' => 'Dt  Evasao',
            'PERIODO_EVASAO' => 'Periodo  Evasao',
        ];
    }
}

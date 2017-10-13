<?php

namespace numeros\models;

use Yii;

/**
 * This is the model class for table "j17_orientacoes".
 *
 * @property integer $id
 * @property integer $idProfessor
 * @property string $titulo
 * @property string $aluno
 * @property integer $ano
 * @property string $natureza
 * @property integer $tipo
 * @property integer $status
 */
class Orientacoes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'j17_orientacoes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idProfessor', 'titulo', 'aluno', 'ano', 'tipo', 'status'], 'required'],
            [['idProfessor', 'ano', 'tipo', 'status'], 'integer'],
            [['titulo'], 'string', 'max' => 300],
            [['aluno', 'natureza'], 'string', 'max' => 100],
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
            'aluno' => 'Aluno',
            'ano' => 'Ano',
            'natureza' => 'Natureza',
            'tipo' => 'Tipo',
            'status' => 'Status',
        ];
    }


    /*
        - Tipo (1 - Graduação, 2 - Mestrado, 3 - Doutorado)
        - Status (1 - Em Andamento, 2 - Concluída)
	*/
    public function getOrientacoesPorTipoStatus($idProfessor, $tipo, $status)
    {
        $query = (new Yii\db\Query())
        ->from('j17_orientacoes')
        ->where([
            'idProfessor' => $idProfessor,
            'tipo' => $tipo,
            'status' => $status
        ])
        ->orderBy(['ano' => SORT_DESC])
        ->all();

        return $query;
    }

    public function getOrientacoesPorAnoTipoStatus($id, $tipo, $status)
    {
        $query = (new Yii\db\Query())
        ->select('ano, count(id) as total')
        ->from('j17_orientacoes')
        ->where([
            'idProfessor' => $id,
            'tipo' => $tipo,
            'status' => $status
        ])
        ->groupBy('ano')
        ->orderBy(['ano' => SORT_ASC])
        ->all();

        return $query;
    }

    public function getCountOrientacoesPorTipoStatus($idProfessor, $tipo, $status)
    {
        $query = (new Yii\db\Query())
        ->from('j17_orientacoes')
        ->where([
            'idProfessor' => $idProfessor,
            'tipo' => $tipo,
            'status' => $status
        ])
        ->orderBy(['ano' => SORT_DESC])
        ->count();

        return $query;
    }
}
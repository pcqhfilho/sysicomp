<?php

namespace numeros\models;

use Yii;

/**
 * This is the model class for table "j17_publicacoes".
 *
 * @property integer $id
 * @property integer $idProfessor
 * @property string $titulo
 * @property integer $ano
 * @property string $local
 * @property integer $tipo
 * @property string $natureza
 * @property string $autores
 */
class Publicacoes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'j17_publicacoes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idProfessor', 'titulo', 'ano', 'tipo', 'autores'], 'required'],
            [['idProfessor', 'ano', 'tipo'], 'integer'],
            [['titulo', 'local', 'autores'], 'string', 'max' => 300],
            [['natureza'], 'string', 'max' => 10],
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
            'ano' => 'Ano',
            'local' => 'Local',
            'tipo' => 'Tipo',
            'natureza' => 'Natureza',
            'autores' => 'Autores',
        ];
    }


    //- Tipo (1 - Conferência, 2 - Periódico, 3 - Livro, 4 - Capítulo)
    public function getPublicacoesPorTipo($idProfessor, $tipo)
    {
        $query = (new Yii\db\Query())
        ->from('j17_publicacoes')
        ->where([
            'idProfessor' => $idProfessor,
            'tipo' => $tipo,
        ])
        ->orderBy(['ano' => SORT_DESC])
        ->all();

        return $query;
    }

    public function getPublicacoesPorTipoPorAno($idProfessor, $tipo)
    {
        $query = (new Yii\db\Query())
        ->select('ano, count(id) as total')
        ->from('j17_publicacoes')
        ->where([
            'idProfessor' => $idProfessor,
            'tipo' => $tipo
        ])
        ->groupBy('ano')
        ->all();

        return $query;
    }

    public function getCountPublicacoesPorTipo($idProfessor, $tipo)
    {
        $query = (new Yii\db\Query())
        ->from('j17_publicacoes')
        ->where([
            'idProfessor' => $idProfessor,
            'tipo' => $tipo,
        ])
        ->orderBy(['ano' => SORT_DESC])
        ->count();

        return $query;
    }
}

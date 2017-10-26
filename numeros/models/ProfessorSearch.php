<?php

namespace numeros\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use numeros\models\Professor;

/**
 * ProfessorSearch represents the model behind the search form of `numeros\models\Professor`.
 */
class ProfessorSearch extends Professor
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status', 'idLattes', 'idRH'], 'integer'],
            [['nome', 'username', 'auth_key', 'password_hash', 'password_reset_token', 'email', 'created_at', 'updated_at', 'visualizacao_candidatos', 'visualizacao_candidatos_finalizados', 'visualizacao_cartas_respondidas', 'administrador', 'coordenador', 'secretaria', 'professor', 'aluno', 'siape', 'dataIngresso', 'endereco', 'telcelular', 'telresidencial', 'unidade', 'titulacao', 'classe', 'nivel', 'regime', 'turno', 'formacao', 'resumo', 'alias', 'ultimaAtualizacao', 'cargo'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function searchProfessor($params)
    {
        $query = Professor::find()
        ->where(['professor' => 1])
        ->andWhere(['not like', 'nome', 'poderoso'])
        ->andWhere(['not like', 'nome', 'admin'])
        ->orderBy('nome');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions

        $query->andFilterWhere(['like', 'nome', $this->nome]);

        return $dataProvider;
    }
}

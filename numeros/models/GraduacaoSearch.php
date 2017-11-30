<?php

namespace numeros\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use numeros\models\Graduacao;

/**
 * GraduacaoSearch represents the model behind the search form of `numeros\models\Graduacao`.
 */
class GraduacaoSearch extends Graduacao
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID_PESSOA'], 'integer'],
            [['NOME_PESSOA', 'SEXO', 'DT_NASCIMENTO', 'FORMA_INGRESSO', 'FORMA_EVASAO', 'COD_CURSO', 'NOME_UNIDADE', 'MATR_ALUNO', 'NUM_VERSAO', 'PERIODO_INGRESSO', 'DT_EVASAO', 'PERIODO_EVASAO'], 'safe'],
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
    public function search($params)
    {
        $query = Graduacao::find();

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
        $query->andFilterWhere([
            'ID_PESSOA' => $this->ID_PESSOA,
        ]);

        $query->andFilterWhere(['like', 'NOME_PESSOA', $this->NOME_PESSOA])
            ->andFilterWhere(['like', 'SEXO', $this->SEXO])
            ->andFilterWhere(['like', 'DT_NASCIMENTO', $this->DT_NASCIMENTO])
            ->andFilterWhere(['like', 'FORMA_INGRESSO', $this->FORMA_INGRESSO])
            ->andFilterWhere(['like', 'FORMA_EVASAO', $this->FORMA_EVASAO])
            ->andFilterWhere(['like', 'COD_CURSO', $this->COD_CURSO])
            ->andFilterWhere(['like', 'NOME_UNIDADE', $this->NOME_UNIDADE])
            ->andFilterWhere(['like', 'MATR_ALUNO', $this->MATR_ALUNO])
            ->andFilterWhere(['like', 'NUM_VERSAO', $this->NUM_VERSAO])
            ->andFilterWhere(['like', 'PERIODO_INGRESSO', $this->PERIODO_INGRESSO])
            ->andFilterWhere(['like', 'DT_EVASAO', $this->DT_EVASAO])
            ->andFilterWhere(['like', 'PERIODO_EVASAO', $this->PERIODO_EVASAO]);

        return $dataProvider;
    }

    // Função que filtra alunos egressos da graduação de acordo com o curso passado como parametro
    public function searchAlunos($params, $curso){

        $query = Graduacao::find()
            ->andFilterWhere(['like', 'FORMA_EVASAO', 'Formado'])
            ->andFilterWhere(['like', 'COD_CURSO', $curso]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'NOME_PESSOA', $this->NOME_PESSOA])
            ->andFilterWhere(['like', 'PERIODO_EVASAO', $this->PERIODO_EVASAO]);

        return $dataProvider;
    }
}

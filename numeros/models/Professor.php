<?php

namespace numeros\models;
use yii\data\ActiveDataProvider;

use Yii;

/**
 * This is the model class for table "j17_user".
 *
 * @property integer $id
 * @property string $nome
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property integer $status
 * @property string $created_at
 * @property string $updated_at
 * @property string $visualizacao_candidatos
 * @property string $visualizacao_candidatos_finalizados
 * @property string $visualizacao_cartas_respondidas
 * @property string $administrador
 * @property string $coordenador
 * @property string $secretaria
 * @property string $professor
 * @property string $aluno
 * @property string $siape
 * @property string $dataIngresso
 * @property string $endereco
 * @property string $telcelular
 * @property string $telresidencial
 * @property string $unidade
 * @property string $titulacao
 * @property string $classe
 * @property string $nivel
 * @property string $regime
 * @property string $turno
 * @property integer $idLattes
 * @property string $formacao
 * @property string $resumo
 * @property string $alias
 * @property string $ultimaAtualizacao
 * @property integer $idRH
 * @property string $cargo
 */
class Professor extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'j17_user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nome', 'username', 'auth_key', 'password_hash', 'email', 'created_at', 'updated_at', 'visualizacao_candidatos_finalizados', 'visualizacao_cartas_respondidas'], 'required'],
            [['status', 'idLattes', 'idRH'], 'integer'],
            [['visualizacao_candidatos', 'visualizacao_candidatos_finalizados', 'visualizacao_cartas_respondidas'], 'safe'],
            [['resumo'], 'string'],
            [['nome', 'username', 'password_hash', 'password_reset_token', 'email', 'endereco'], 'string', 'max' => 255],
            [['auth_key', 'turno', 'cargo'], 'string', 'max' => 32],
            [['created_at', 'updated_at', 'siape', 'dataIngresso', 'regime', 'ultimaAtualizacao'], 'string', 'max' => 10],
            [['administrador', 'coordenador', 'secretaria', 'professor', 'aluno'], 'string', 'max' => 1],
            [['telcelular', 'telresidencial', 'classe', 'alias'], 'string', 'max' => 20],
            [['unidade'], 'string', 'max' => 60],
            [['titulacao'], 'string', 'max' => 15],
            [['nivel'], 'string', 'max' => 6],
            [['formacao'], 'string', 'max' => 300],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['password_reset_token'], 'unique'],
        ];
    }

    /* This function returns a dataProvider from query: 
        SELECT *
        FROM j17_user 
        WHERE professor = 1
        and nome like %poderoso%
        and nome like %admin% 
     */
    public function read()
    {
        $query = Professor::find()
        ->where(['professor' => 1])
        ->andWhere(['not like', 'nome', 'poderoso'])
        ->andWhere(['not like', 'nome', 'admin'])
        ->orderBy('nome');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => false,
        ]);
        return $dataProvider;
    }

    public function getUpdatedAt($id)
    {
        $query = (new \yii\db\Query())
        ->select(['updated_at'])
        ->from('j17_user')
        ->where(['id' => $id])
        ->one();

        return $query['updated_at'];
    }

    public function getNome($id)
    {
        $query = (new \yii\db\Query())
        ->select(['nome'])
        ->from('j17_user')
        ->where(['id' => $id])
        ->one();

        return $query['nome'];
    }

    public function getProfessor($id)
    {
        $query = (new \yii\db\Query())
        ->select('*')
        ->from('j17_user')
        ->where(['id' => $id])
        ->one();

        return $query;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nome' => 'Nome',
            'username' => 'Username',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'email' => 'Email',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'visualizacao_candidatos' => 'Visualizacao Candidatos',
            'visualizacao_candidatos_finalizados' => 'Visualizacao Candidatos Finalizados',
            'visualizacao_cartas_respondidas' => 'Visualizacao Cartas Respondidas',
            'administrador' => 'Administrador',
            'coordenador' => 'Coordenador',
            'secretaria' => 'Secretaria',
            'professor' => 'Professor',
            'aluno' => 'Aluno',
            'siape' => 'Siape',
            'dataIngresso' => 'Data Ingresso',
            'endereco' => 'Endereco',
            'telcelular' => 'Telcelular',
            'telresidencial' => 'Telresidencial',
            'unidade' => 'Unidade',
            'titulacao' => 'Titulacao',
            'classe' => 'Classe',
            'nivel' => 'Nivel',
            'regime' => 'Regime',
            'turno' => 'Turno',
            'idLattes' => 'Id Lattes',
            'formacao' => 'Formacao',
            'resumo' => 'Resumo',
            'alias' => 'Alias',
            'ultimaAtualizacao' => 'Ultima Atualizacao',
            'idRH' => 'Id Rh',
            'cargo' => 'Cargo',
        ];
    }
}

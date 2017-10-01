<?php
namespace numeros\controllers;

use Yii;
use PHPExcel;
use numeros\models\Professor;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['signup'],
                'rules' => [
                    [
                        'actions' => ['signup', 'cadastroppgi'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        //$this->layout = '@numeros/views/layouts/main.php';
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
    * Displays homepage.
    *
    * @return mixed
    */
    public function actionIndex()
    {

        //ALUNO_GRAD
        $qtdMatCc = (new \yii\db\Query())
        ->from('j17_aluno_grad')
        ->where([
        'COD_CURSO' => 'IE08',
        'DT_EVASAO' => '',
        ])
        ->count();

        $qtdMatSi = (new \yii\db\Query())
        ->from('j17_aluno_grad')
        ->where([
        'COD_CURSO' => 'IE15',
        'DT_EVASAO' => '',
        ])
        ->count();

        $qtdEgrPd = (new \yii\db\Query())
        ->from('j17_aluno_grad')
        ->where([
        'COD_CURSO' => 'IE06',
        'FORMA_EVASAO' => 'Formado',
        ])
        ->count();

        $qtdEgrCc = (new \yii\db\Query())
        ->from('j17_aluno_grad')
        ->where([
        'COD_CURSO' => 'IE08',
        'FORMA_EVASAO' => 'Formado',
        ])
        ->count();

        $qtdEgrSi = (new \yii\db\Query())
        ->from('j17_aluno_grad')
        ->where([
        'COD_CURSO' => 'IE15',
        'FORMA_EVASAO' => 'Formado',
        ])
        ->count();

        //ALUNO_PPGI

        $qtdMatMest = (new \yii\db\Query())
        ->from('j17_aluno')
        ->where([
        'status' => 0,
        'curso' => 1,
        ])
        ->count();

        $qtdMatDoc = (new \yii\db\Query())
        ->from('j17_aluno')
        ->where([
        'status' => 0,
        'curso' => 2,
        ])
        ->count();

        $qtdEgrMest = (new \yii\db\Query())
        ->from('j17_aluno')
        ->where([
        'status' => 1,
        'curso' => 1,
        ])
        ->count();

        $qtdEgrDoc = (new \yii\db\Query())
        ->from('j17_aluno')
        ->where([
        'status' => 1,
        'curso' => 2,
        ])
        ->count();

        // DOCENTES
        $modelProfessor = new Professor();
        $professorDataProvider = $modelProfessor->read();

        return $this->render('index',[
        'qtdMatCc' => $qtdMatCc,
        'qtdMatSi' => $qtdMatSi,
        'qtdEgrPd' => $qtdEgrPd,
        'qtdEgrCc' => $qtdEgrCc,
        'qtdEgrSi' => $qtdEgrSi,
        'qtdMatMest' => $qtdMatMest,
        'qtdMatDoc' => $qtdMatDoc,
        'qtdEgrMest' => $qtdEgrMest,
        'qtdEgrDoc' => $qtdEgrDoc,
        'professorDataProvider' => $professorDataProvider
        ]);
    }
}

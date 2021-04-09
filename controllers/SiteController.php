<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\EntryForm;
use app\models\Proyectos;
use yii\data\Pagination;

class SiteController extends Controller
{

    public function actionDashboard()
    {
        $query = Proyectos::find();
        $query->select('p.titulo, pe.estatus, est.estado,  com.nombre, esp.especialidad, lin.linea_investigacion, p.fecha_inicio, p.fecha_fin');
        $query->from('proyectos as p');
        $query->leftJoin('proyectos_estatus as pe', 'p.id_estatus=pe.id_estatus');
        $query->leftJoin('parroquias as parr', 'p.id_parroquia=parr.id_parroquia');
        $query->leftJoin('municipios as mun', 'parr.id_municipio=mun.id_municipio');
        $query->leftJoin('estados as est', 'mun.id_estado=est.id_estado');
        $query->leftJoin('comunidades as com', 'p.id_comunidad=com.id_comunidad');
        $query->leftJoin('especialidades as esp', 'p.id_especialidad=esp.id_especialidad');
        $query->leftJoin('lineas_investigacion as lin', 'p.id_linea_investigacion=lin.id_linea_investigacion');


        $pagination = new Pagination([
            'defaultPageSize' => 5,
            'totalCount' => $query->count(),
        ]);

        $proyectos = $query->orderBy('problema')
        ->offset($pagination->offset)
        ->limit($pagination->limit)
        ->all();

        return $this->render('dashboard',
            ['proyectos' => $proyectos]
        );
    }    

    public function actionTables()
    {
        $mensaje = "Hola Mundo";

        return $this->render('tables');
    }

    public function actionEntry()
    {
        $model = new EntryForm;

        if($model->load(Yii::$app->request->post()) && $model->validate())
        {
            return $this->render('entry-confirm', ['model' => $model]);
        }
        else
        {
            return $this->render('entry', ['model' => $model]);
        }
    }
    
    public function actionSay($message = "Hola")
    {
        return $this->render('say', ['message' => $message]);
    }

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
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
     * {@inheritdoc}
     */
    public function actions()
    {
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
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            
            //return $this->goBack();
            return $this->redirect(['dashboard']);
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLayoutstatic()
    {
        return $this->render('Layoutstatic');
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        //return $this->goHome();
        return $this->redirect(['login']);
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
}

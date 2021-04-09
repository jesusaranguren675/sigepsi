<?php

namespace app\controllers;

use Yii;
use app\models\Backenduser;
use app\models\BackenduserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\Pagination;
use yii\behaviors\TimestampBehavior;


/**
 * BackenduserController implements the CRUD actions for Backenduser model.
 */
class BackenduserController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Backenduser models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BackenduserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);


        $query = Backenduser::find();
                $query->select('*');
                $query->from('user');

        
        $pagination = new Pagination([
                    'defaultPageSize' => 5,
                    'totalCount' => $query->count(),
                ]);

                $user = $query->orderBy('username')
                ->offset($pagination->offset)
                ->limit($pagination->limit)
                ->all();

        return $this->render('index', [
            'searchModel'           => $searchModel,
            'dataProvider'          => $dataProvider,
            'pagination'            => $pagination,
            'user'                  => $user,
        ]);
    }

    /**
     * Displays a single Backenduser model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Backenduser model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Backenduser();
       
        if (Yii::$app->request->isAjax) 
        {

            $username           = $_POST['username'];
            $email              = $_POST['email'];
            $password           = Yii::$app->getSecurity()->generatePasswordHash($_POST['password']);
            $auth_key           = \Yii::$app->security->generateRandomString();

            $verificar_usuario = Yii::$app->db->createCommand("SELECT username, email FROM 
                                                               public.user 
                                                               WHERE username='$username' AND
                                                                     email='$email'")->queryAll();

            
            if(!empty($verificar_usuario))
            {
                Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

                return [
                    'data' => [
                        'success' => false,
                        'message' => 'Usuario duplicado.',
                    ],
                'code' => 1, // Some semantic codes that you know them for yourself
                ];

                exit;
            }




            $usuario = Yii::$app->db->createCommand("INSERT INTO public.user(
                                      username, auth_key, password_hash, 
                                      email, status)
                                      VALUES ('$username', '', '$password', '$email', 0);")->queryAll();
       
            if(empty($usuario))
            {
                $usuario = false;
            }

            Yii::$app->mailer->compose()
            ->setFrom('jesusaranguren675@gmail.com')
            ->setTo($email)
            ->setSubject('Bienvenido al Sistema de Gestión de Proyectos Socio Integradores')
            ->setTextBody('Ahora eres parte de SIGEPSI')
            ->setHtmlBody('<b>Contenido HTML</b>')
            ->send();



            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

            if($_POST != "")
            {
                return [
                    'data' => [
                        'success'                   => true,
                        'message'                   => 'El modelo ha sido guardado.',
                        'parroquia'               => $usuario,
                    ],
                    'code' => 0,
                ];
            }
            else
            {
                return [
                    'data' => [
                        'success' => false,
                        'message' => 'Ocurrió un error.',
                    ],
                'code' => 1, // Some semantic codes that you know them for yourself
                ];
            }

        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Backenduser model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionUpdateuser()
    {
        if (Yii::$app->request->isAjax) 
        {
            $user_id            = $_POST['user_id'];
            $username           = $_POST['username'];
            $email              = $_POST['email'];
            $password           = Yii::$app->getSecurity()->generatePasswordHash($_POST['password']);
            $auth_key           = \Yii::$app->security->generateRandomString();

            $usuario = Yii::$app->db->createCommand("UPDATE public.user
                                                     SET username='$username', password_hash='$password', email='$email'
                                                     WHERE id=$user_id")->queryAll();
            //var_dump($comunidades); die();
            // Se itera sobre el arreglo y se definen las variables a enviar por ajax

            if(empty($usuario))
            {
                $usuario = false;
            }



            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

            if($_POST != "")
            {
                return [
                    'data' => [
                        'success'                   => true,
                        'message'                   => 'El modelo ha sido guardado.',
                        'parroquia'               => $usuario,
                    ],
                    'code' => 0,
                ];
            }
            else
            {
                return [
                    'data' => [
                        'success' => false,
                        'message' => 'Ocurrió un error.',
                    ],
                'code' => 1, // Some semantic codes that you know them for yourself
                ];
            }

        }

    }

    /**
     * Deletes an existing Backenduser model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Backenduser model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Backenduser the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Backenduser::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

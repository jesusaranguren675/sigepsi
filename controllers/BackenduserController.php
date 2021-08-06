<?php

namespace app\controllers;

use Yii;
use app\models\BackendUser;
use app\models\BackenduserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * BackenduserController implements the CRUD actions for BackendUser model.
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
     * Lists all BackendUser models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BackenduserSearch();
        //$dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $usuarios = 
        Yii::$app->db->createCommand("
        SELECT id, username, email, status
        FROM public.user 
        AS usuario")->queryAll();


        return $this->render('index', [
            'searchModel' => $searchModel,
            'usuarios'    => $usuarios,
            //'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single BackendUser model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {

        $usuarios = 
        Yii::$app->db->createCommand("
        SELECT id, username, email, status
        FROM public.user 
        AS usuario
        WHERE id=$id")->queryAll();

        return $this->render('view', [
            'model' => $this->findModel($id),
            'usuarios' => $usuarios,
        ]);
    }

    /**
     * Creates a new BackendUser model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new BackendUser();

        //if ($model->load(Yii::$app->request->post()) && $model->save()) {
           // return $this->redirect(['view', 'id' => $model->id]);
        //}

        if (Yii::$app->request->isAjax) 
        {

            $username = $_POST['username'];
            $email = $_POST['email'];
            $password_hash = $_POST['password_hash'];
            $status = $_POST['status'];

            $usuario = Yii::$app->db->createCommand("INSERT INTO public.comunidades(
            username, email, password_hash, 
            status)
            VALUES ('$username', '$email', $password_hash, 
            '$status')")->queryAll();

            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

            if($usuario)
            {
                return [
                    'data' => [
                        'success' => true,
                        'message' => 'Usuario Registrado Exitosamente',
                    ],
                    'code' => 1, // Some semantic codes that you know them for yourself
                ];
            }
            else
            {
                return [
                    'data' => [
                        'success' => false,
                        'message' => 'Ocurrió un error al registrar el usuario',
                ],
                    'code' => 0, // Some semantic codes that you know them for yourself
                ];
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing BackendUser model.
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

    /**
     * Deletes an existing BackendUser model.
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
     * Finds the BackendUser model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return BackendUser the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = BackendUser::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

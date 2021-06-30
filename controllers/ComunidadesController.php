<?php

namespace app\controllers;

use Yii;
use app\models\Comunidades;
use app\models\ComunidadesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ComunidadesController implements the CRUD actions for Comunidades model.
 */
class ComunidadesController extends Controller
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
     * Lists all Comunidades models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ComunidadesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Comunidades model.
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
     * Creates a new Comunidades model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Comunidades();

        if (Yii::$app->request->isAjax) 
        {

            $rif = $_POST['rif'];
            $nombre = $_POST['nombre'];
            $id_tipo_comunidad = $_POST['id_tipo_comunidad'];
            $telefono_contacto = $_POST['telefono_contacto'];
            $persona_contacto = $_POST['persona_contacto'];
            $email = $_POST['email'];
            $id_parroquia = $_POST['id_parroquia'];
            $direccion = $_POST['direccion'];
            $id_user = Yii::$app->user->identity->id;
            $id_estatus = 1;

            $comunidad = Yii::$app->db->createCommand("INSERT INTO public.comunidades(
            rif, nombre, id_tipo_comunidad, 
            telefono_contacto, persona_contacto,
            email, id_parroquia, direccion, id_user, id_estatus)
            VALUES ('$rif', '$nombre', $id_tipo_comunidad, 
            '$telefono_contacto', '$persona_contacto', '$email',
            $id_parroquia, '$direccion', $id_user, $id_estatus) RETURNING true")->queryAll();

            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

            if($comunidad)
            {
                return [
                    'data' => [
                        'success' => true,
                        'message' => 'Comunidad Registrada Exitosamente',
                    ],
                    'code' => 1, // Some semantic codes that you know them for yourself
                ];
            }
            else
            {
                return [
                    'data' => [
                        'success' => false,
                        'message' => 'Ocurrió un error al registrar la comunidad',
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
     * Updates an existing Comunidades model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_comunidad]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Comunidades model.
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
     * Finds the Comunidades model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Comunidades the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Comunidades::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

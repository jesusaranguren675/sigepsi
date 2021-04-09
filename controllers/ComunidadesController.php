<?php

namespace app\controllers;

use Yii;
use app\models\Comunidades;
use app\models\BackendUser;
use app\models\ComunidadesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\widgets\LinkPager;
use yii\data\Pagination;
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

        if(\Yii::$app->user->can('comunidad'))
        {   
            $id_usuario = Yii::$app->user->identity->id;

            $searchModel = new ComunidadesSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            $sql = Comunidades::find();
            $sql->select('comunidad.id_comunidad, comunidad.nombre, estado.estado, municipio.municipio, parroquia.parroquia');
            $sql->from('comunidades as comunidad');
            $sql->leftJoin('parroquias AS parroquia', 'parroquia.id_parroquia=comunidad.id_parroquia');
            $sql->leftJoin('municipios AS municipio', 'parroquia.id_municipio=municipio.id_municipio');
            $sql->leftJoin('estados AS estado', 'municipio.id_municipio=estado.id_estado');
            $sql->leftJoin('user as usuario', 'comunidad.id_usuario=usuario.id');
            $sql->where(['comunidad.id_usuario' => $id_usuario]);



            $pagination = new Pagination([
                'defaultPageSize' => 5,
                'totalCount' => $sql->count(),
            ]);

            $comunidades = $sql->orderBy('')
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();
            //Proyectos por validar


            return $this->render('index', [
                'searchModel'       => $searchModel,
                'dataProvider'      => $dataProvider,
                'comunidades'       => $comunidades,
                'pagination'        => $pagination,
            ]);
        }
        else
        {
            $searchModel = new ComunidadesSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            $sql = Comunidades::find();
            $sql->select('comunidad.id_comunidad, comunidad.nombre, estado.estado, municipio.municipio, parroquia.parroquia');
            $sql->from('comunidades as comunidad');
            $sql->leftJoin('parroquias AS parroquia', 'parroquia.id_parroquia=comunidad.id_parroquia');
            $sql->leftJoin('municipios AS municipio', 'parroquia.id_municipio=municipio.id_municipio');
            $sql->leftJoin('estados AS estado', 'municipio.id_municipio=estado.id_estado');



            $pagination = new Pagination([
                'defaultPageSize' => 5,
                'totalCount' => $sql->count(),
            ]);

            $comunidades = $sql->orderBy('')
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();
            //Proyectos por validar


            return $this->render('index', [
                'searchModel'       => $searchModel,
                'dataProvider'      => $dataProvider,
                'comunidades'       => $comunidades,
                'pagination'        => $pagination,
            ]);
        }

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
        $model      = new Comunidades();

        if (Yii::$app->request->isAjax) 
        {

            //var_dump($_POST); die();

            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = Yii::$app->getSecurity()->generatePasswordHash($_POST['password']);

            $nombre = $_POST['nombre'];
            $tipo_comunidad = $_POST['tipo_comunidad'];
            $telefono = $_POST['telefono'];
            $parroquia = $_POST['parroquia'];
            $direccion = $_POST['direccion'];
            $persona_contacto = $_POST['persona_contacto'];



            $usuario = Yii::$app->db->createCommand("INSERT INTO public.user(
               username, auth_key, password_hash, 
               email, status)
               VALUES ('$username', '', '$password', 
               '$email', 0)")->queryAll();

            $id_usuario = Yii::$app->db->getLastInsertID();


            $comunidad = Yii::$app->db->createCommand("INSERT INTO comunidades(
            nombre, id_tipo_comunidad, direccion, telefono, 
            persona_contacto, id_parroquia, id_estatus, id_usuario)
            VALUES ('$nombre', $tipo_comunidad, '$direccion', '$telefono', 
            '$persona_contacto', $parroquia, 0, $id_usuario);")->queryAll();


           

            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

            if($_POST != "")
            {

                return [
                    'data' => [
                        'success'                   => true,
                        'message'                   => 'Usuario registrado exitosamente.',
                        'proyecto'                  => "",
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


    //Filtrar estado (comunidad)
    //--------------------------------------------------------------------
    public function actionFiltroestado()
    {

        if (Yii::$app->request->isAjax) 
        {
            $parametro = intval($_POST['estado_comunidad']);

            $estado = Yii::$app->db->createCommand("SELECT estado.estado, municipio.municipio, municipio.id_municipio  
                                                    FROM public.estados AS estado JOIN municipios AS municipio ON municipio.id_estado=estado.id_estado
                                                    WHERE estado.id_estado=$parametro")->queryAll();
            //var_dump($comunidades); die();
            // Se itera sobre el arreglo y se definen las variables a enviar por ajax

            if(empty($estado))
            {
                $estado = false;
            }



            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

            if($_POST != "")
            {
                return [
                    'data' => [
                        'success'                   => true,
                        'message'                   => 'El modelo ha sido guardado.',
                        'estado'               => $estado,
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
    //Fin Filtrar estado (comunidad)
    //--------------------------------------------------------------------


     //Filtrar parroquia mediante el municipio (comunidad)
    //--------------------------------------------------------------------
    public function actionFiltroparroquia()
    {

        if (Yii::$app->request->isAjax) 
        {
            $parametro = intval($_POST['municipio_comunidad']);

            $parroquia = Yii::$app->db->createCommand("SELECT municipio.municipio, parroquia.parroquia, parroquia.id_parroquia  
                                                    FROM public.parroquias AS parroquia JOIN municipios AS municipio ON municipio.id_municipio=parroquia.id_municipio
                                                    WHERE municipio.id_municipio=$parametro")->queryAll();
            //var_dump($comunidades); die();
            // Se itera sobre el arreglo y se definen las variables a enviar por ajax

            if(empty($parroquia))
            {
                $parroquia = false;
            }



            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

            if($_POST != "")
            {
                return [
                    'data' => [
                        'success'                   => true,
                        'message'                   => 'El modelo ha sido guardado.',
                        'parroquia'               => $parroquia,
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
    //Fin Filtrar parroquia mediante el municipio (comunidad)
    //--------------------------------------------------------------------

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

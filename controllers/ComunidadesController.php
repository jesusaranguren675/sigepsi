<?php

namespace app\controllers;

use Yii;
use app\models\Comunidades;
use app\models\ComunidadesSearch;
use yii\web\Controller;
use app\models\Parroquias;
use app\models\Municipios;
use app\models\Estados;
use yii\helpers\Html;
use Mpdf\Mpdf;

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

        $comunidades = 
        Yii::$app->db->createCommand("
        SELECT comunidad.id_comunidad, comunidad.nombre, comunidad.rif,
               tipo_comunidad.tipo_comunidad, comunidad.telefono_contacto,
               comunidad.id_estatus
        FROM public.comunidades 
        AS comunidad
        JOIN tipos_comunidades 
        AS tipo_comunidad  
        ON tipo_comunidad.id_tipo_comunidad=comunidad.id_tipo_comunidad")->queryAll();

        return $this->render('index', [
            'searchModel'   => $searchModel,
            'comunidades'   => $comunidades,
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
        $comunidades = 
        Yii::$app->db->createCommand("
        SELECT comunidad.id_comunidad, comunidad.nombre, comunidad.rif,
               tipo_comunidad.tipo_comunidad, comunidad.telefono_contacto,
               comunidad.id_estatus, parroquia.parroquia, usuario.username,
               comunidad.persona_contacto, comunidad.email, comunidad.direccion,
               comunidad.id_estatus
        FROM public.comunidades 
        AS comunidad
        JOIN tipos_comunidades 
        AS tipo_comunidad  
        ON tipo_comunidad.id_tipo_comunidad=comunidad.id_tipo_comunidad
        JOIN parroquias
        AS parroquia
        ON comunidad.id_parroquia=parroquia.id_parroquia
        JOIN public.user
        AS usuario
        ON usuario.id=comunidad.id_user
        WHERE comunidad.id_comunidad=$id")->queryAll();

        return $this->render('view', [
            'model'         => $this->findModel($id),
            'comunidades'   => $comunidades,
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
            $id_estatus = $_POST['id_estatus'];

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

        //var_dump($model); die();

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
            $id_estatus = $_POST['id_estatus'];

            //if ($model->load(Yii::$app->request->post()) && $model->save()) {
               // return $this->redirect(['view', 'id' => $model->id_comunidad]);
            //}

            $comunidad = Yii::$app->db->createCommand("UPDATE comunidades
            SET rif='$rif', 
                nombre='$nombre', 
                id_tipo_comunidad='$id_tipo_comunidad', 
                telefono_contacto='$telefono_contacto', 
                persona_contacto='$persona_contacto', 
                email='$email', 
                id_parroquia='$id_parroquia', 
                direccion='$direccion',
                id_estatus='$id_estatus' 
            WHERE id_comunidad=$id")->queryAll();

            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

            if($comunidad)
            {
                return [
                    'data' => [
                        'success' => true,
                        'message' => 'Comunidad Modificada Exitosamente',
                        'id'      => $id,
                    ],
                        'code' => 1, // Some semantic codes that you know them for yourself
                    ];
                }

            else
            {
                return [
                    'data' => [
                        'success' => false,
                        'message' => 'Ocurrió un error al modificar la comunidad',
                    ],
                    'code' => 0, // Some semantic codes that you know them for yourself
                ];
            }
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

    public function actionPdf()
    {

        $comunidades = 
        Yii::$app->db->createCommand("
        SELECT comunidad.id_comunidad, comunidad.nombre, comunidad.rif,
               tipo_comunidad.tipo_comunidad, comunidad.telefono_contacto,
               comunidad.id_estatus, parroquia.parroquia, usuario.username,
               comunidad.persona_contacto, comunidad.email, comunidad.direccion,
               comunidad.id_estatus
        FROM public.comunidades 
        AS comunidad
        JOIN tipos_comunidades 
        AS tipo_comunidad  
        ON tipo_comunidad.id_tipo_comunidad=comunidad.id_tipo_comunidad
        JOIN parroquias
        AS parroquia
        ON comunidad.id_parroquia=parroquia.id_parroquia
        JOIN public.user
        AS usuario
        ON usuario.id=comunidad.id_user")->queryAll();


        $mpdf = new mPDF();
        $mpdf->SetHeader(Html::img('@web/imagenes/cintillo.jpg')); 
        $mpdf->setFooter('{PAGENO}'); 
        $mpdf->WriteHTML($this->renderPartial('pdf', ['comunidades' => $comunidades]));
        $mpdf->Output();
        exit;
        //return $this->renderPartial('mpdf');
    }

    public function actionExcel($file_name = 'file.xls')
    {
         $fields = ["item_code", "description", "cost"];
 
         $data = [
               $fields,
               ["prod_Mazda", "Mazda", "26000"],
               ["prod_Toyota", "Toyota", "24000"],
         ];
 
         $path_parts = pathinfo($file_name);
         switch($path_parts['extension']) {
            default:
            case 'csv':
                //...
                break;
 
            case 'html':
                //...
                break;
 
            case 'xls':
                $this->actionOutputExcel($data, $file_name);
                break;
        }
    }
 
    function actionOutputExcel($data, $file_name = 'file.xls')
    {
        date_default_timezone_set('America/Los_Angeles');
 
        $docExcel = new \PHPExcel();  // requires \vendor\phpoffice\phpexcel\Classes\PHPExcel
        $docExcel->setActiveSheetIndex(0);
        $docExcel->getActiveSheet()->fromArray($data, null, 'A1');
 
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'.$file_name.'"');
        header('Cache-Control: max-age=0');
 
        // Output data
        $writer = \PHPExcel_IOFactory::createWriter($docExcel, 'Excel5');
        $writer->save('php://output');
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

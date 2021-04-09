<?php

namespace app\controllers;

use Yii;
use app\models\Estudiantes;
use app\models\EstudiantesSearch;
use app\models\Personas;
use app\models\BackendUser;
use app\models\AuthAssignment;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\Pagination;
use yii\web\ForbiddenHttpException;

/**
 * EstudiantesController implements the CRUD actions for Estudiantes model.
 */
class EstudiantesController extends Controller
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
     * Lists all Estudiantes models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new EstudiantesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        if(\Yii::$app->user->can('estudiante'))
        {
            $id_user = Yii::$app->user->identity->id;
            $query = Personas::find();
            $query->select('estudiante.id_persona, estudiante.id_carrera, persona.cedula, persona.primer_nombre,
             persona.segundo_nombre, persona.primer_apellido,
             persona.segundo_apellido, carrera.carrera, usuario.email, persona.fecha_nac, persona.telefono_celular, persona.telefono_local');
            $query->from('estudiantes as estudiante');
            $query->leftJoin('personas as persona', 'persona.id_persona=estudiante.id_persona');
            $query->leftJoin('carreras as carrera', 'estudiante.id_carrera=carrera.id_carrera');
            $query->leftJoin('public.user as usuario', 'usuario.id=persona.id_usuario');
            $query->where(['usuario.id' => $id_user]);

            $pagination = new Pagination([
                'defaultPageSize' => 10,
                'totalCount' => $query->count(),
            ]);

            $estudiantes = $query->orderBy('id_estudiante')
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'estudiantes'  => $estudiantes,
                'pagination'   => $pagination,
            ]);
        }
        else
        {
            $query = Personas::find();
            $query->select('estudiante.id_persona, estudiante.id_carrera, persona.cedula, persona.primer_nombre,
             persona.segundo_nombre, persona.primer_apellido,
             persona.segundo_apellido, carrera.carrera');
            $query->from('estudiantes as estudiante');
            $query->leftJoin('personas as persona', 'persona.id_persona=estudiante.id_persona');
            $query->leftJoin('carreras as carrera', 'estudiante.id_carrera=carrera.id_carrera');

            $pagination = new Pagination([
                'defaultPageSize' => 5,
                'totalCount' => $query->count(),
            ]);

            $estudiantes = $query->orderBy('id_estudiante')
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'estudiantes'  => $estudiantes,
                'pagination'   => $pagination,
            ]);
        }
    }

    /**
     * Displays a single Estudiantes model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
    

         $estudiante= Yii::$app->db->createCommand("SELECT persona.id_persona,
                                                           persona.cedula,
                                                           persona.primer_nombre,
                                                           persona.segundo_nombre, 
                                                           persona.primer_apellido, 
                                                           persona.segundo_apellido, 
                                                           carrera.carrera 
                                                   FROM estudiantes as estudiante
                                                   JOIN personas as persona ON persona.id_persona=estudiante.id_persona
                                                   JOIN carreras as carrera ON estudiante.id_carrera=carrera.id_carrera
                                                   WHERE persona.id_persona=$id")->queryAll();
         //var_dump($estudiante); die();

        return $this->render('view', [
            'estudiante'        => $estudiante,
        ]);
    }

    /**
     * Creates a new Estudiantes model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Estudiantes();

        if(Yii::$app->user->can('coordinador') || Yii::$app->user->can('comunidad') || Yii::$app->user->can('profesor') || Yii::$app->user->can('administrador'))
        {
                if (Yii::$app->request->isAjax) 
                {
                //var_dump($_POST); die();
                    $estudiantes_username = $_POST['estudiantes_username'];
                    $estudiantes_email = $_POST['estudiantes_email'];
                    $estudiantes_password = Yii::$app->getSecurity()->generatePasswordHash($_POST['estudiantes_password']);
                    $estudiantes_especialidad = $_POST['estudiantes_especialidad'];

                    $estudiantes_cedula = $_POST['estudiantes_cedula'];
                    $estudiantes_primer_nombre = $_POST['estudiantes_primer_nombre'];
                    $estudiantes_segundo_nombre = $_POST['estudiantes_segundo_nombre'];
                    $estudiantes_primer_apellido = $_POST['estudiantes_primer_apellido'];
                    $estudiantes_segundo_apellido = $_POST['estudiantes_segundo_apellido'];
                    $estudiantes_procedencia = $_POST['estudiantes_procedencia'];
                    $estudiantes_fecha_nac = $_POST['estudiantes_fecha_nac'];
                    $estudiantes_telefono_celular = $_POST['estudiantes_telefono_celular'];
                    $estudiantes_telefono_local = $_POST['estudiante_telefono_local'];
                    

                    $verificar_usuario = Yii::$app->db->createCommand("SELECT username, email FROM 
                     public.user 
                     WHERE username='$estudiantes_username'
                     OR email='$estudiantes_email'")->queryAll();

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
               VALUES ('$estudiantes_username', '', '$estudiantes_password', 
               '$estudiantes_email', 0) RETURNING true")->queryAll();

            $id_usuario = Yii::$app->db->getLastInsertID();


            $persona = Yii::$app->db->createCommand("INSERT INTO personas(
              cedula, primer_nombre, 
              segundo_nombre, primer_apellido, 
              segundo_apellido, fecha_nac, 
              telefono_celular, telefono_local, 
              id_usuario, id_estatus)
              VALUES ('$estudiantes_cedula',
              '$estudiantes_primer_nombre',
              '$estudiantes_segundo_nombre',   
              '$estudiantes_primer_apellido',
              '$estudiantes_segundo_apellido', 
              '$estudiantes_fecha_nac',
              '$estudiantes_telefono_celular',
              '$estudiantes_telefono_local',
              $id_usuario, 0) RETURNING true")->queryAll();
            $id_persona = Yii::$app->db->getLastInsertID();



            $rol = "estudiante";
            $perfil = Yii::$app->db->createCommand("INSERT INTO auth_assignment(
                item_name,
                user_id)
                VALUES ('$rol', $id_usuario) RETURNING true")->queryAll();

            $estudiante = Yii::$app->db->createCommand("INSERT INTO estudiantes(
                id_persona, 
                id_carrera)
                VALUES ($id_persona, 
                $estudiantes_especialidad
            ) RETURNING true")->queryAll();

            $especialidades = Yii::$app->db->createCommand("SELECT especialidad
               FROM especialidades 
               WHERE id_especialidad=$estudiantes_especialidad")->queryAll();


            foreach ($especialidades as $especialidades) 
            {
                $especialidades['especialidad'];
            }


            
                    //Envio de correo al estudiante registrado
                    //----------------------------------------
            Yii::$app->mailer->compose()
            ->setFrom('jesusaranguren675@gmail.com')
            ->setTo($estudiantes_email)
            ->setSubject('Bienvenido al Sistema de Gestión de Proyectos Socio Integradores (SIGEPSI)')
            ->setTextBody('Ahora eres parte de SIGEPSI')
            ->setHtmlBody('<b>'.$estudiantes_primer_nombre." ".$estudiantes_segundo_nombre." ".$estudiantes_primer_apellido." ".$estudiantes_segundo_apellido.' Usted ha sido registrado exitosamente en el SIGEPSI, con la especialidad '.$especialidades['especialidad'].'<b>')  
            ->send();

            
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

            if($_POST != "")
            {

                return [
                    'data' => [
                        'success'                   => true,
                        'message'                   => 'Usuario registrado exitosamente.',
                        'estudiante'                  => "",
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
        else
        {

            throw new ForbiddenHttpException("No tienes permitido acceder a esta vista.");
        }



        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Estudiantes model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_estudiante]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Estudiantes model.
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
     * Finds the Estudiantes model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Estudiantes the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Estudiantes::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

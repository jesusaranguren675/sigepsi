<?php

namespace app\controllers;

use Yii;
use app\models\Personas;
use app\models\BackendUser;
use app\models\PersonasSearch;
use app\models\AuthAssignment;
use app\models\AuthItem;
use app\models\CoordinadoresEspecialidades;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\Pagination;


/**
 * PersonasController implements the CRUD actions for Personas model.
 */
class PersonasController extends Controller
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
     * Lists all Personas models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PersonasSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $estudiante = 'estudiante';

        $query = Personas::find();
        $query->select('persona.id_persona, persona.cedula, persona.primer_nombre,
               persona.segundo_nombre, persona.primer_apellido,
               persona.segundo_apellido, perfil.item_name, usuario.username');
        $query->from('personas as persona');
                $query->leftJoin('user as usuario', 'usuario.id=persona.id_usuario');
                $query->leftJoin('auth_assignment as perfil', 'usuario.id=perfil.user_id::INTEGER');
                $query->where("perfil.item_name<>:estudiante", [':estudiante' => $estudiante]);

        $pagination = new Pagination([
                    'defaultPageSize' => 10,
                    'totalCount' => $query->count(),
                ]);

                $personas = $query->orderBy('id_persona')
                ->offset($pagination->offset)
                ->limit($pagination->limit)
                ->all();

        //var_dump($personas); die();

        return $this->render('index', [
            'searchModel'               => $searchModel,
            'dataProvider'              => $dataProvider,
            'personas'                  => $personas,
            'pagination'                => $pagination,
        ]);
    }

    /**
     * Displays a single Personas model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {

        

        $persona = Yii::$app->db->createCommand("SELECT  persona.id_persona, persona.fecha_nac,
                                                         persona.cedula, persona.primer_nombre,
                                                         persona.telefono_celular, persona.telefono_local,
                                                         usuario.username, usuario.email,
                                                         persona.segundo_nombre, persona.primer_apellido,
                                                         persona.segundo_apellido, perfil.item_name
                                                  FROM personas AS persona
                                                  JOIN public.user AS usuario ON usuario.id=persona.id_usuario
                                                  JOIN auth_assignment AS perfil ON usuario.id=perfil.user_id::INTEGER
                                                  WHERE persona.id_persona=$id")->queryAll();


        return $this->render('view', [
            'persona' => $persona,
        ]);
    }

    /**
     * Creates a new Personas model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Personas();

        if (Yii::$app->request->isAjax) 
        {


            $personas_username = $_POST['personas_username'];
            $personas_email = $_POST['personas_email'];
            $personas_password = Yii::$app->getSecurity()->generatePasswordHash($_POST['personas_password']);

            $perfil = $_POST['perfil'];
            $personas_id_especialidad = $_POST['personas_id_especialidad'];

            $personas_cedula = $_POST['personas_cedula'];
            $personas_primer_nombre = $_POST['personas_primer_nombre'];
            $personas_segundo_nombre = $_POST['personas_segundo_nombre'];
            $personas_primer_apellido = $_POST['personas_primer_apellido'];
            $personas_segundo_apellido = $_POST['personas_segundo_apellido'];
            $personas_fecha_nac = $_POST['personas_fecha_nac'];
            $personas_telefono_celular = $_POST['personas_telefono_celular'];
            $personas_telefono_local = $_POST['personas_telefono_local'];
            $personas_id_estatus = 0;


            

            $verificar_usuario = Yii::$app->db->createCommand("SELECT username, email FROM 
                                                               public.user 
                                                               WHERE username='$personas_username' OR
                                                                     email='$personas_email'")->queryAll();

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
            else
            {
                $usuario = Yii::$app->db->createCommand("INSERT INTO public.user(
                   username, auth_key, password_hash, 
                   email, status)
                   VALUES ('$personas_username', '', '$personas_password', 
                   '$personas_email', 0) RETURNING true")->queryAll();

                $id_usuario = Yii::$app->db->getLastInsertID();


                $persona = Yii::$app->db->createCommand("INSERT INTO personas(
                  cedula, primer_nombre, 
                  segundo_nombre, primer_apellido, 
                  segundo_apellido, fecha_nac, 
                  telefono_celular, telefono_local, 
                  id_usuario, id_estatus)
                  VALUES ('$personas_cedula', '$personas_primer_nombre', '$personas_segundo_nombre', 
                  '$personas_primer_apellido', '$personas_segundo_apellido', 
                  '$personas_fecha_nac', '$personas_telefono_celular', '$personas_telefono_local',
                  $id_usuario, $personas_id_estatus) RETURNING true")->queryAll();




                $perfill = Yii::$app->db->createCommand("INSERT INTO auth_assignment(
                    item_name, user_id)
                    VALUES ('$perfil', $id_usuario) RETURNING true")->queryAll();

                if($perfil == "profesor")
                {

                    $tutor = Yii::$app->db->createCommand("INSERT INTO tutores(
                        primer_nombre, segundo_nombre, primer_apellido, segundo_apellido, 
                        telefono_celular, email, cedula)
                        VALUES ('$personas_primer_nombre', '$personas_segundo_nombre', '$personas_primer_apellido', '$personas_segundo_apellido', '$personas_telefono_celular', '$personas_email', '$personas_cedula')")->queryAll();

                    $id_tutor = Yii::$app->db->getLastInsertID();

                    $tutor_especialidad = Yii::$app->db->createCommand("INSERT INTO tutores_especialidades(
                        id_tutor, id_especialidad)
                        VALUES ($id_tutor, $personas_id_especialidad)")->queryAll();

                }

                if($perfil == "coordinador")
                {
                    $especialidad = Yii::$app->db->createCommand("INSERT INTO coordinadores_especialidades(
                       id_user, id_especialidad)
                       VALUES ($id_usuario, $personas_id_especialidad) RETURNING true ")->queryAll();
                }

                Yii::$app->mailer->compose()
                ->setFrom('jesusaranguren675@gmail.com')
                ->setTo($personas_email)
                ->setSubject('Bienvenido al Sistema de Gestión de Proyectos Socio Integradores (SIGEPSI)')
                ->setTextBody('Ahora eres parte de SIGEPSI')
                ->setHtmlBody('<b>".$personas_primer_nombre." ".$personas_segundo_nombre."".$personas_primer_apellido."".$personas_segundo_apellido." Usted ha sido registrado en el SIGEPSI bajo el estatus de ".$perfil." y con la especialidad ". $personas_id_especialidad."</b>')
                ->send();


                Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

                if($_POST != "")
                {
                    if($usuario == true and $persona == true and $perfil == true)
                    {
                        return [
                            'data' => [
                                'success'                   => true,
                                'message'                   => 'Usuario registrado exitosamente.',
                                'proyecto'                  => $persona,
                            ],
                            'code' => 0,
                        ];
                    }

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




        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_persona]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Personas model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {

        $model = $this->findModel($id);
        $user = BackendUser::findOne($id);

        $username = Yii::$app->db->createCommand("SELECT usuario.username,
                                                         usuario.email
                                                  FROM personas AS persona
                                                  JOIN public.user AS usuario
                                                  ON persona.id_usuario=usuario.id
                                                  WHERE persona.id_persona=$id")->queryAll();

        foreach ($username as $username) 
        {
            $username['username'];
            $username['email'];
        }


        //var_dump($username); die();

        $model->username = $username['username'];;
        $model->email = $username['email'];


        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionUpdateuser()
    {
        if (Yii::$app->request->isAjax) 
        {


            $id_persona                     = $_POST['id_persona'];
            $id_usuario                     = $_POST['id_usuario'];
            $personas_cedula                = $_POST['personas_cedula'];
            $personas_primer_nombre         = $_POST['personas_primer_nombre'];
            $personas_segundo_nombre        = $_POST['personas_segundo_nombre'];
            $personas_primer_apellido       = $_POST['personas_primer_apellido'];
            $personas_segundo_apellido      = $_POST['personas_segundo_apellido'];
            $personas_fecha_nac             = $_POST['personas_fecha_nac'];
            $personas_telefono_celular      = $_POST['personas_telefono_celular'];
            $personas_telefono_local        = $_POST['personas_telefono_local'];
            $personas_username              = $_POST['personas_username'];
            $personas_email                 = $_POST['personas_email'];
            $perfil                         = $_POST['perfil'];
            $personas_id_especialidad       = $_POST['personas_id_especialidad'];

            
            $persona = Yii::$app->db->createCommand("UPDATE personas
                                                     SET cedula='$personas_cedula', 
                                                         primer_nombre='$personas_primer_nombre', 
                                                         segundo_nombre='$personas_segundo_nombre', 
                                                         primer_apellido='$personas_primer_apellido', 
                                                         segundo_apellido='$personas_segundo_apellido', 
                                                         fecha_nac='$personas_fecha_nac', 
                                                         telefono_celular='$personas_telefono_celular', 
                                                         telefono_local='$personas_telefono_local' 
                                                     WHERE id_persona=$id_persona RETURNING true")->queryAll();

            $usuario = Yii::$app->db->createCommand("UPDATE public.user
                                                         SET username='$personas_username',
                                                             email='$personas_email' WHERE id=$id_usuario RETURNING true")->queryAll();

            $perfil = Yii::$app->db->createCommand("UPDATE auth_assignment
                                                         SET item_name='$perfil'
                                                         WHERE user_id='$id_usuario' RETURNING true")->queryAll();
            
            if($persona == true and $usuario)
            {
                CoordinadoresEspecialidades::deleteAll(['id_user' => $id_usuario]);
                $modelCooEsp=new CoordinadoresEspecialidades;
                $modelCooEsp->id_user=$id_usuario;
                $modelCooEsp->id_especialidad=$personas_id_especialidad;
                $modelCooEsp->save();
            }

            
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

            if($_POST != "")
            {
                if($persona == true and $usuario)
                {
                    return [
                        'data' => [
                            'success'                 => true,
                            'message'                 => 'Usuario editado exitosamente.',
                            'parroquia'               => $persona,
                        ],
                        'code' => 0,
                    ];
                }
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
     * Deletes an existing Personas model.
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
     * Finds the Personas model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Personas the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Personas::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

<?php

namespace app\controllers;

use Yii;
use app\models\Proyectos;
use app\models\ProyectosSearch;
use app\models\BuscarProyectos;
use app\models\Integrantes;
use app\models\Comunidades;
use app\models\ProyectosEstudiantes;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\Pagination;
use yii\web\ForbiddenHttpException;
use app\models\ProyectosMotivosCorrecciones;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\db\Query;
use Mpdf\Mpdf;
use app\models\FormUpload;
use yii\web\UploadedFile;
/**
 * ProyectosController implements the CRUD actions for Proyectos model.
 */
class ProyectosController extends Controller
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
     * Lists all Proyectos models.
     * @return mixed
     */



    public function actionPanelproyectos()
    {
        $mensaje = "Hola Mundo";
    
        return $this->render('panelproyectos', [
            'mensaje'       => $mensaje,
            
        ]);
        
    }

    public function actionPdf()
    {
        $fecha_inicio = $_GET['fecha_inicio'];
        $fecha_fin = $_GET['fecha_fin'];
        $especialidad = $_GET['id_especialidad'];
        $linea_investigacion = $_GET['id_linea_investigacion'];
        $estado = $_GET['id_estado'];
        $estatus = $_GET['id_estatus'];

        $proyecto = Yii::$app->db->createCommand("SELECT p.titulo, pe.estatus, est.estado,
        com.nombre, esp.especialidad, lin.linea_investigacion, p.fecha_inicio, p.fecha_fin 
        FROM proyectos AS p 
        JOIN proyectos_estatus AS pe ON p.id_estatus=pe.id_estatus
        JOIN parroquias AS parr ON p.id_parroquia=parr.id_parroquia
        JOIN municipios AS mun ON parr.id_municipio=mun.id_municipio
        JOIN estados AS est ON mun.id_estado=est.id_estado
        JOIN comunidades AS com ON p.id_comunidad=com.id_comunidad
        JOIN especialidades AS esp ON p.id_especialidad=esp.id_especialidad
        JOIN lineas_investigacion AS lin ON p.id_linea_investigacion=lin.id_linea_investigacion
        WHERE fecha_inicio='$fecha_inicio' AND fecha_fin='$fecha_fin' AND
        p.id_especialidad=$especialidad AND p.id_linea_investigacion='$linea_investigacion' AND
        est.id_estado='$estado' AND p.id_estatus='$estatus'")->queryAll();
        $mpdf = new mPDF();
        $mpdf->SetHeader(Html::img('@web/imagenes/cintillo_pdf.jpg')); 
        $mpdf->setFooter('{PAGENO}'); 
        $mpdf->WriteHTML($this->renderPartial('pdf', ['proyecto' => $proyecto, 'fecha_inicio' => $fecha_inicio, 'fecha_fin', $fecha_fin, 'especialidad' => $especialidad, 'linea_investigacion' => $linea_investigacion, 'estado' => $estado, 'estatus' => $estatus]));
        $mpdf->Output();
        exit;
        //return $this->renderPartial('mpdf');
    }


    public function actionIndex()
    {
        //$searchModel = new ProyectosSearch();
        //$dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $model = new BuscarProyectos;

            if (Yii::$app->request->isAjax) 
            {

                $fecha_inicio = $_POST['fecha_inicio'];
                $fecha_fin = $_POST['fecha_fin'];
                $especialidad = $_POST['id_especialidad'];
                $linea_investigacion = $_POST['id_linea_investigacion'];
                $estado = $_POST['id_estado'];
                $estatus = $_POST['id_estatus'];

                $proyecto = Yii::$app->db->createCommand("SELECT p.titulo, pe.estatus, est.estado,
                                                                 com.nombre, esp.especialidad, lin.linea_investigacion,
                                                                 p.fecha_inicio, p.fecha_fin 
                                                          FROM proyectos AS p 
                                                          JOIN proyectos_estatus AS pe ON p.id_estatus=pe.id_estatus
                                                          JOIN parroquias AS parr ON p.id_parroquia=parr.id_parroquia
                                                          JOIN municipios AS mun ON parr.id_municipio=mun.id_municipio
                                                          JOIN estados AS est ON mun.id_estado=est.id_estado
                                                          JOIN comunidades AS com ON p.id_comunidad=com.id_comunidad
                                                          JOIN especialidades AS esp ON p.id_especialidad=esp.id_especialidad
                                                          JOIN lineas_investigacion AS lin ON p.id_linea_investigacion=lin.id_linea_investigacion
                                                          WHERE fecha_inicio='$fecha_inicio' AND fecha_fin='$fecha_fin' AND
                                                                p.id_especialidad=$especialidad AND p.id_linea_investigacion='$linea_investigacion' AND
                                                                est.id_estado='$estado' AND p.id_estatus='$estatus'
                                                                ")->queryAll();

                Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

                if($_POST != "")
                {
                    return [
                        'data' => [
                            'success'                   => true,
                            'message'                   => 'Proyectos encontrados.',
                            'proyecto'                  => $proyecto,
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
            else
            {
                //$fecha_inicio = $_POST['fecha_inicio'];

                //var_dump($fecha_inicio); die();

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

                
                return $this->render('index', [
                    //'searchModel'       => $searchModel,
                    //'dataProvider'      => $dataProvider,
                    'model'             => $model,
                    'query'             => $query,
                    'pagination'        => $pagination,
                    'proyectos'         => $proyectos,
                ]);
            }
    }

    /**
     * Displays a single Proyectos model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */



    public function actionView($id)
    {

        $proyecto = Yii::$app->db->createCommand("SELECT proyecto.id_proyecto, estatus.estatus, especialidad, trayecto.trayecto, linea_investigacion, titulo, problema, objetivo_general,
                  objetivos_especificos, sinopsis, nombre, estado, municipio, parroquia, proyecto.direccion,
                  proyecto.fecha_inicio, proyecto.fecha_fin, proyecto.formato_propuesta, tutor_comunitario, tutor.primer_nombre, tutor.primer_apellido
                            FROM proyectos as proyecto
                            JOIN proyectos_estatus AS estatus ON proyecto.id_estatus=estatus.id_estatus
                            JOIN especialidades AS especialidad ON proyecto.id_especialidad=especialidad.id_especialidad
                            JOIN trayectos AS trayecto ON proyecto.id_trayecto=trayecto.id_trayecto
                            JOIN lineas_investigacion AS linea_inv ON proyecto.id_linea_investigacion=linea_inv.id_linea_investigacion
                            JOIN comunidades AS comunidad ON proyecto.id_comunidad=comunidad.id_comunidad
                            JOIN parroquias AS parroquia ON proyecto.id_parroquia=parroquia.id_parroquia
                            JOIN municipios AS municipio ON municipio.id_municipio=parroquia.id_municipio
                            JOIN estados AS estado ON estado.id_estado=municipio.id_municipio
                            JOIN tutores AS tutor ON proyecto.id_tutor=tutor.id_tutor
                            where id_proyecto=$id")->queryAll();

        $integrantes = Yii::$app->db->createCommand("SELECT persona.cedula, persona.primer_nombre,
                                                            persona.segundo_nombre, persona.primer_apellido,
                                                            persona.segundo_apellido, carrera.carrera,
                                                            persona.telefono_celular, persona.telefono_local,
                                                            usuario.email, persona.id_estatus
                                                    FROM personas AS persona
                                                    JOIN proyectos_estudiantes AS proyecto_estudiante
                                                    ON persona.id_persona=proyecto_estudiante.id_persona
                                                    JOIN estudiantes AS estudiante
                                                    ON estudiante.id_persona=proyecto_estudiante.id_persona
                                                    JOIN carreras AS carrera
                                                    ON estudiante.id_carrera=carrera.id_carrera
                                                    JOIN public.user AS usuario
                                                    ON persona.id_usuario=usuario.id
                                                    WHERE proyecto_estudiante.id_proyecto=$id")->queryAll();

        $traza = Yii::$app->db->createCommand("SELECT estatus.estatus, traza.observaciones, traza.fecha_hora,
                                                       persona.primer_nombre, persona.primer_apellido,
                                                       mcorreccion.proyecto_motivo_correccion
                                                FROM proyectos_trazas AS traza
                                                JOIN proyectos_estatus as estatus
                                                ON traza.id_estatus=estatus.id_estatus
                                                JOIN personas AS persona
                                                ON persona.id_persona=traza.id_persona
                                                LEFT JOIN proyectos_correcciones AS correccion
                                                ON correccion.id_proyecto_traza=traza.id_proyecto_traza
                                                LEFT JOIN proyectos_motivos_correcciones AS mcorreccion
                                                ON correccion.id_proyecto_correccion=mcorreccion.id_proyecto_motivo_correccion
                                                WHERE traza.id_proyecto=$id ORDER BY traza.id_estatus DESC")->queryAll();

        return $this->render('view', [
            'model'         => $this->findModel($id),
            'proyecto'      => $proyecto,
            'integrantes'   => $integrantes,
            'traza'         => $traza,
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

        //Filtrar estado (proyecto)
    //--------------------------------------------------------------------
    public function actionFiltroestadoproyecto()
    {

        if (Yii::$app->request->isAjax) 
        {
            $parametro = intval($_POST['estado_proyecto']);

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
    //Fin Filtrar estado (proyecto)
    //--------------------------------------------------------------------

         //Filtrar parroquia mediante el municipio (proyecto)
    //--------------------------------------------------------------------
    public function actionFiltroparroquiaproyecto()
    {

        if (Yii::$app->request->isAjax) 
        {
            $parametro = intval($_POST['municipio_proyecto']);

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
    //Fin Filtrar parroquia mediante el municipio (proyecto)
    //--------------------------------------------------------------------




    public function actionComunidades()
    {
        $modelComunidades = new Comunidades();
        if (Yii::$app->request->isAjax) 
        {


            $parametro = intval($_POST['comunidad_id_parroquia']);

            $comunidades = Yii::$app->db->createCommand("SELECT comunidad.id_comunidad, 
                                                                comunidad.nombre, 
                                                                comunidad.direccion, 
                                                                comunidad.telefono, 
                                                                comunidad.persona_contacto, 
                                                                estado.estado,
                                                                municipio.municipio,
                                                                parroquia.parroquia
                                                         FROM 
                                                         comunidades AS comunidad JOIN
                                                         parroquias AS parroquia ON parroquia.id_parroquia=comunidad.id_parroquia 
                                                         JOIN municipios AS municipio ON municipio.id_municipio=parroquia.id_municipio
                                                         JOIN estados AS estado ON estado.id_estado=municipio.id_estado
                                                         WHERE comunidad.id_parroquia=$parametro")->queryAll();
            //var_dump($comunidades); die();
            // Se itera sobre el arreglo y se definen las variables a enviar por ajax

            if(empty($comunidades))
            {
                $comunidades = false;
            }



            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

            if($_POST != "")
            {
                return [
                    'data' => [
                        'success'                   => true,
                        'message'                   => 'El modelo ha sido guardado.',
                        'comunidades'               => $comunidades,
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

        return $this->render('integrantes', [
            'modelIntegrantes' => $modelIntegrantes,
        ]);
    }

    /**
     * Creates a new Proyectos model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionIntegrantes()
    {
        $modelIntegrantes = new Integrantes();
        if (Yii::$app->request->isAjax) 
        {

            
            $integrante = (new Query())
                            ->select('persona.cedula,
                                      persona.primer_nombre, 
                                      persona.segundo_nombre, 
                                      persona.primer_apellido,
                                      persona.segundo_apellido,
                                      especialidad.especialidad'
                                  )
                            ->from('personas as persona')
                            ->leftJoin('estudiantes as estudiante', 'persona.id_persona=estudiante.id_persona')
                            ->leftJoin('especialidades as especialidad', 'especialidad.id_especialidad=estudiante.id_carrera')
                            ->leftJoin('auth_assignment as rol', 'persona.id_usuario=rol.user_id::INTEGER')
                            ->where(['persona.cedula' => $_POST['cedula_integrante']])
                            ->andWhere(['rol.item_name' => 'estudiante']) 
                            ->all();

            // Se itera sobre el arreglo y se definen las variables a enviar por ajax
            foreach($integrante as $integrante)
            {
                //var_dump($integrante);
                $integrante['cedula'];
                $integrante['primer_nombre'];
                $integrante['segundo_nombre'];
                $integrante['primer_apellido'];
                $integrante['segundo_apellido'];
                $integrante['especialidad'];
            }

            if(empty($integrante))
            {
                $integrante=false;
            }

            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

            if($_POST != "")
            {
                return [
                    'data' => [
                        'success'                   => true,
                        'message'                   => 'El modelo ha sido guardado.',
                        'integrante'                => $integrante,
                        'cedula'                    => $integrante['cedula'],
                        'primer_nombre'             => $integrante['primer_nombre'],
                        'segundo_nombre'            => $integrante['segundo_nombre'],
                        'primer_apellido'           => $integrante['primer_apellido'],
                        'segundo_apellido'          => $integrante['segundo_apellido'],
                        'especialidad'              => $integrante['especialidad'],
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

        return $this->render('integrantes', [
            'modelIntegrantes' => $modelIntegrantes,
        ]);
    }


public function actionCreate()
{
    //if(\Yii::$app->user->can('action_create_proyect'))
    //{

        $model = new Proyectos();

        if (Yii::$app->request->isAjax) 
        {
                //var_dump($_POST); die();
                
                 Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;


                 //Registrar estudiantes en la tabla proyectos_estudiantes
                 //-------------------------------------------------------

                 $id_estatus = 1;
                 $contador = intval($_POST['contador']);

                $v=1;
                while($v <= $contador) 
                {
                    $cedula_integrante = "campo_integrante_".$v;

                    $personas = Yii::$app->db->createCommand("SELECT persona.id_persona,
                                                                     usuario.email
                                                              FROM personas AS persona
                                                              JOIN public.user AS usuario
                                                              ON persona.id_usuario=usuario.id 
                                                              WHERE cedula=$_POST[$cedula_integrante]")->queryAll();


                    foreach ($personas as $persona) 
                    {

                        $id_persona = $persona['id_persona'];
                        $persona['email'];
                        //Verificar que los estudiantes no se registran
                        //---------------------------------------------
                        $vpersonas = Yii::$app->db->createCommand("
                            SELECT * FROM proyectos_estudiantes AS p_estudiantes
                            JOIN proyectos as proyecto
                            ON p_estudiantes.id_proyecto=proyecto.id_proyecto
                            WHERE id_persona=$id_persona AND proyecto.id_estatus<>4 AND proyecto.id_estatus<>99 AND proyecto.id_estatus<>999")->queryAll();
                    }

                    $v = $v + 1;
                }

                if($vpersonas)
                {
                    return [
                        'data' => [
                            'repetido'                  => true,
                            'message'                   => 'Estudiante repetido.',
                        ],
                        'code' => 0,
                    ];

                    return;
                }
                else
                {
                    //Registrar proyecto en la tabla proyectos
                    //----------------------------------------
                       $formato_propuesta = "propuesta";   
                       $created_by = Yii::$app->user->identity->username;
                       $proyecto = Yii::$app->db->createCommand()->insert('proyectos', [
                        'id_necesidad'                  => 0,
                        'titulo'                        => $_POST['titulo'],
                        'problema'                      => $_POST['problema'],
                        'objetivo_general'              => $_POST['objetivo_general'],
                        'objetivos_especificos'         => $_POST['objetivos_especificos'],
                        'id_comunidad'                  => $_POST['id_comunidad'],
                        'id_estatus'                    => $_POST['id_estatus'],
                        'conclusiones'                  => $_POST['conclusiones'],
                        'recomendaciones'               => $_POST['recomendaciones'],
                        'fecha_inicio'                  => $_POST['fecha_inicio'],
                        'fecha_fin'                     => $_POST['fecha_fin'],
                        'id_especialidad'               => $_POST['id_especialidad'],
                        'id_parroquia'                  => $_POST['id_parroquia'],
                        'formato_informe_final'         => $_POST['formato_informe_final'],
                        'formato_propuesta'             => $formato_propuesta,
                        'direccion'                     => $_POST['direccion'],
                        'cedula_tutor_comunitario'      => $_POST['cedula_tutor_comunitario'],
                        'tutor_comunitario'             => $_POST['tutor_comunitario'],
                        'id_tutor'                      => $_POST['id_tutor'],
                        'sinopsis'                      => $_POST['sinopsis'],
                        'id_linea_investigacion'        => $_POST['id_linea_investigacion'],
                        'id_trayecto'                   => $_POST['id_trayecto'],
                        'created_by'                    => $created_by,
                    ])->execute();
                       $id_proyecto = Yii::$app->db->getLastInsertID();
                    //Fin Registrar proyecto en la tabla proyectos
                    //----------------------------------------
                }

                 $i=1;
                 while($i <= $contador) 
                 {

                    $cedula_integrante = "campo_integrante_".$i;

                    $id_user = Yii::$app->user->identity->id;
                    $personas = Yii::$app->db->createCommand("SELECT persona.id_persona,
                                                                     usuario.email
                                                              FROM personas AS persona
                                                              JOIN public.user AS usuario
                                                              ON persona.id_usuario=usuario.id 
                                                              WHERE cedula=$_POST[$cedula_integrante]")->queryAll();


                    foreach ($personas as $persona) 
                    {
                        $id_persona = $persona['id_persona'];
                        $persona['email'];
                    }

    
                    $ProyectosEstudiantes = Yii::$app->db->createCommand()->insert('proyectos_estudiantes', [
                         'id_proyecto'        => $id_proyecto,
                         'id_persona'         => $id_persona,
                         'id_estatus'         => $id_estatus,
                    ])->execute();

                    
                    //Enviar correo a los integrantes
                    //-----------------------------------
                    Yii::$app->mailer->compose()
                    ->setFrom('jesusaranguren675@gmail.com')
                    ->setTo($persona['email'])
                    ->setSubject('Proyecto Socio Tecnologico Registrado Exitosamente')
                    ->setTextBody('')
                    ->setHtmlBody('<b>La Universidad Politécnica Territorial de Caracas "Mariscal Sucre" informa que su proyecto ha sido registrado exitosamente bajo el número '.$id_proyecto.', y se encuentra a la espera de aprobación."</b></br>http://localhost:8080/sigepsi/web/index.php')
                    ->send();
                    //Fin enviar correo a los integrantes
                    //-----------------------------------
             
                    $i = $i + 1;
                 }
                 //Fin Registrar estudiantes en la tabla proyectos_estudiantes
                 //-----------------------------------------------------------



                 //Registrar la traza del proyecto
                 //-------------------------------

                 $id_user = Yii::$app->user->identity->id;
                 $fechaHora=date("Y-m-d H:i:s");


                 $consulta_id_persona = Yii::$app->db->createCommand("SELECT usuario.id, persona.id_usuario, 
                                                                             usuario.username, persona.primer_nombre, 
                                                                             persona.segundo_nombre, persona.primer_apellido, 
                                                                             persona.segundo_apellido,
                                                                             persona.id_persona
                                                                      FROM public.user AS usuario
                                                                      JOIN personas AS persona
                                                                      ON persona.id_usuario=usuario.id
                                                                      WHERE persona.id_usuario=$id_user")->queryAll();


                 foreach ($consulta_id_persona as $id_persona) 
                 {
                         $id_persona['id_persona'];
                 }


                 $traza = Yii::$app->db->createCommand()->insert('proyectos_trazas', [
                    'id_proyecto'                   => $id_proyecto,
                    'id_estatus'                    => $_POST['id_estatus'],
                    'id_persona'                    => $id_persona['id_persona'],
                    'fecha_hora'                    => $fechaHora,
                    'observaciones'                 => "Propuesta de proyecto registrada exitosamente"
                ])->execute();

                 //Fin Registrar la traza del proyecto
                 //-----------------------------------

            
                 if($_POST != "")
                 {
                    if($proyecto)
                    {
                        return [
                            'data' => [
                                'success'                   => true,
                                'message'                   => 'Proyecto guardado exitosamente.',
                                'id_proyecto'               => $id_proyecto,
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
            return $this->render('create', [
                'model'                 => $model,
            ]);
    //}
    //else
    //{
       // throw new ForbiddenHttpException;
    //}
}

    /**
     * Updates an existing Proyectos model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $estudiantes = 
        Yii::$app->db->createCommand("SELECT persona.cedula, persona.primer_nombre,
        persona.segundo_nombre, persona.primer_apellido, persona.segundo_apellido,
        carrera.carrera
        FROM proyectos_estudiantes 
        AS p_estudiante
        JOIN personas AS persona ON p_estudiante.id_persona=persona.id_persona
        JOIN estudiantes AS estudiante
        ON p_estudiante.id_persona=estudiante.id_persona
        JOIN carreras AS carrera
        ON estudiante.id_carrera=carrera.id_carrera
        WHERE p_estudiante.id_proyecto=$id")->queryAll();

        $id_proyecto = $model->id_proyecto;

        $comunidad = 
        Yii::$app->db->createCommand("SELECT proyecto.id_comunidad
        FROM proyectos AS proyecto WHERE id_proyecto=$id_proyecto")->queryAll();

        foreach ($comunidad as $comunidad) {
            $id_comunidad = $comunidad['id_comunidad'];
        }


        $comunidades = 
        Yii::$app->db->createCommand("SELECT comunidad.nombre, comunidad.direccion, comunidad.telefono, comunidad.persona_contacto, estado.estado, municipio.municipio, parroquia.parroquia 
        FROM comunidades AS comunidad
        JOIN parroquias AS parroquia ON parroquia.id_parroquia=comunidad.id_parroquia
        JOIN municipios AS municipio ON municipio.id_municipio=parroquia.id_municipio
        JOIN estados AS estado ON estado.id_estado=municipio.id_estado
        WHERE ID_COMUNIDAD=$id_comunidad")->queryAll();

        //var_dump($comunidades); die();

        return $this->render('update', [
            'model'             => $model,
            'estudiantes'       => $estudiantes,
            'comunidades'       => $comunidades,
        ]);
    }

    public function actionUpdateproyecto()
    {
        if (Yii::$app->request->isAjax) 
        {
            $formato_propuesta = "propuesta";   


            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

            $id_proyecto                   = $_POST['id_proyecto'];
            $id_necesidad                  = $_POST['id_necesidad'];
            $titulo                        = $_POST['titulo'];
            $problema                      = $_POST['problema'];
            $objetivo_general              = $_POST['objetivo_general'];
            $objetivos_especificos         = $_POST['objetivos_especificos'];
            $id_comunidad                  = $_POST['id_comunidad'];
            $conclusiones                  = $_POST['conclusiones'];
            $recomendaciones               = $_POST['recomendaciones'];
            $fecha_inicio                  = $_POST['fecha_inicio'];
            $fecha_fin                     = $_POST['fecha_fin'];
            $id_especialidad               = $_POST['id_especialidad'];
            $id_parroquia                  = $_POST['id_parroquia'];
            $formato_informe_final         = $_POST['formato_informe_final'];
            $formato_propuesta             = $formato_propuesta;
            $direccion                     = $_POST['direccion'];
            $cedula_tutor_comunitario      = $_POST['cedula_tutor_comunitario'];
            $tutor_comunitario             = $_POST['tutor_comunitario'];
            $id_tutor                      = $_POST['id_tutor'];
            $sinopsis                      = $_POST['sinopsis'];
            $id_linea_investigacion        = $_POST['id_linea_investigacion'];
            $id_trayecto                   = $_POST['id_trayecto'];
            $fechaHora                     = date("Y-m-d H:i:s");

        

            $proyecto = Yii::$app->db->createCommand("UPDATE proyectos
                                                      SET id_necesidad='$id_necesidad', titulo='$titulo',
                                                          problema='$problema', objetivo_general='$objetivo_general', 
                                                          objetivos_especificos='$objetivos_especificos',
                                                          id_comunidad=$id_comunidad,
                                                          conclusiones='$conclusiones', recomendaciones='$recomendaciones',
                                                          id_parroquia=$id_parroquia,
                                                          formato_informe_final='$formato_informe_final', 
                                                          direccion='$direccion',
                                                          cedula_tutor_comunitario='$cedula_tutor_comunitario',
                                                          tutor_comunitario='$tutor_comunitario', 
                                                          id_tutor=$id_tutor, sinopsis='$sinopsis',
                                                          id_linea_investigacion=$id_linea_investigacion,
                                                          id_trayecto=$id_trayecto
                                                      WHERE id_proyecto=$id_proyecto")->queryAll();

            $propuesta = 
            Yii::$app->db->createCommand("SELECT * FROM proyectos 
            WHERE id_proyecto=$id_proyecto")->queryAll();

            foreach ($propuesta as $propuesta) {
                $file = $propuesta['formato_propuesta'];
            }

            unlink(Yii::$app->basePath.'/web/archivos/'. $file);


            $proyecto_update = Yii::$app->db->createCommand("UPDATE proyectos
                                                      SET formato_propuesta=''
                                                      WHERE id_proyecto=$id_proyecto")->queryAll();

            $id_usuario = Yii::$app->user->identity->id;


            $estudiantes = Yii::$app->db->createCommand("SELECT
                                                        usuario.email
                                                        FROM proyectos_estudiantes AS pestudiantes
                                                        JOIN personas as persona
                                                        ON persona.id_persona=pestudiantes.id_persona
                                                        JOIN public.user AS usuario
                                                        ON persona.id_usuario=usuario.id
                                                        WHERE id_proyecto=$id_proyecto")->queryAll();

            foreach ($estudiantes AS $estudiante)
            {
                Yii::$app->mailer->compose()
                ->setFrom('jesusaranguren675@gmail.com')
                ->setTo($estudiante['email'])
                ->setSubject('Proyecto Socio Tecnologico Corregido Exitosamente')
                ->setTextBody('Ahora eres parte de SIGEPSI')
                ->setHtmlBody('<b>La Universidad Politécnica Territorial de Caracas "Mariscal Sucre" informa que su proyecto número '.$id_proyecto.' ha sido corregido exitosamente y esta a la espera de una nueva validación."</b>')
                    ->send();
            }



            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

            if($_POST != "")
            {
                if($proyecto)
                {
                    return [
                        'data' => [
                            'success'                   => true,
                            'message'                   => 'El proyecto ha sido modificado.',
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

    //Permite subir la propuesta de proyecto en formato pdf
    //-----------------------------------------------------
    public function actionUpload($id)
    {

        $model = $this->findModel($id);

        $modelUpload = new FormUpload;
        $msg = null;


        if ($modelUpload->load(Yii::$app->request->post()))
        {


            $modelUpload->file = UploadedFile::getInstances($modelUpload, 'file');
            

            if ($modelUpload->file && $modelUpload->validate())
            {

                

                //var_dump($modelUpload); die();

                foreach ($modelUpload->file as $file)
                {

                   $formato_propuesta = $file->baseName . '.' . $file->extension;

                   $proyecto = Yii::$app->db->createCommand("UPDATE proyectos
                                                           SET 
                                                           formato_propuesta='$formato_propuesta'
                                                           WHERE id_proyecto=$id")->queryAll();

                   $file->saveAs('archivos/' . $file->baseName . '.' . $file->extension);
                   $msg = "<div class='alert-success alert'><strong>Propuesta subida exitosamente</strong></div>";
                }
            }
        }

        return $this->render("upload", ["modelUpload" => $modelUpload, "model" => $model, "msg" => $msg]);
    }
    //Fin permite subir la propuesta de proyecto en formato pdf
    //-----------------------------------------------------

    public function actionValidarproyecto($id)
    {
        $model = $this->findModel($id);

        $correccion = Yii::$app->db->createCommand("SELECT 
                                                    id_proyecto_motivo_correccion,
                                                    proyecto_motivo_correccion
                                                    FROM proyectos_motivos_correcciones
                                                    WHERE accion=1")->queryAll();

        $rechazo = Yii::$app->db->createCommand("SELECT *
                                                    FROM proyectos_motivos_rechazos")->queryAll();

        $proyecto = Yii::$app->db->createCommand("SELECT proyecto.id_proyecto, estatus.estatus, especialidad, trayecto.trayecto, linea_investigacion, titulo, problema, formato_propuesta, objetivo_general,
                  objetivos_especificos, sinopsis, nombre, estado, municipio, parroquia, proyecto.direccion,
                  proyecto.fecha_inicio, proyecto.fecha_fin, tutor_comunitario, tutor.primer_nombre, tutor.primer_apellido
                            FROM proyectos as proyecto
                            JOIN proyectos_estatus AS estatus ON proyecto.id_estatus=estatus.id_estatus
                            JOIN especialidades AS especialidad ON proyecto.id_especialidad=especialidad.id_especialidad
                            JOIN trayectos AS trayecto ON proyecto.id_trayecto=trayecto.id_trayecto
                            JOIN lineas_investigacion AS linea_inv ON proyecto.id_linea_investigacion=linea_inv.id_linea_investigacion
                            JOIN comunidades AS comunidad ON proyecto.id_comunidad=comunidad.id_comunidad
                            JOIN parroquias AS parroquia ON proyecto.id_parroquia=parroquia.id_parroquia
                            JOIN municipios AS municipio ON municipio.id_municipio=parroquia.id_municipio
                            JOIN estados AS estado ON estado.id_estado=municipio.id_municipio
                            JOIN tutores AS tutor ON proyecto.id_tutor=tutor.id_tutor
                            where id_proyecto=$id")->queryAll();

        $integrantes = Yii::$app->db->createCommand("SELECT persona.cedula, persona.primer_nombre,
                                                            persona.segundo_nombre, persona.primer_apellido,
                                                            persona.segundo_apellido, carrera.carrera,
                                                            persona.telefono_celular, persona.telefono_local,
                                                            usuario.email, persona.id_estatus
                                                    FROM personas AS persona
                                                    JOIN proyectos_estudiantes AS proyecto_estudiante
                                                    ON persona.id_persona=proyecto_estudiante.id_persona
                                                    JOIN estudiantes AS estudiante
                                                    ON estudiante.id_persona=proyecto_estudiante.id_persona
                                                    JOIN carreras AS carrera
                                                    ON estudiante.id_carrera=carrera.id_carrera
                                                    JOIN public.user AS usuario
                                                    ON persona.id_usuario=usuario.id
                                                    WHERE proyecto_estudiante.id_proyecto=$id")->queryAll();

        $traza = Yii::$app->db->createCommand("SELECT estatus.estatus, traza.observaciones, traza.fecha_hora,
                                                       persona.primer_nombre, persona.primer_apellido,
                                                       mcorreccion.proyecto_motivo_correccion
                                                FROM proyectos_trazas AS traza
                                                JOIN proyectos_estatus as estatus
                                                ON traza.id_estatus=estatus.id_estatus
                                                JOIN personas AS persona
                                                ON persona.id_persona=traza.id_persona
                                                LEFT JOIN proyectos_correcciones AS correccion
                                                ON correccion.id_proyecto_traza=traza.id_proyecto_traza
                                                LEFT JOIN proyectos_motivos_correcciones AS mcorreccion
                                                ON correccion.id_proyecto_correccion=mcorreccion.id_proyecto_motivo_correccion
                                                WHERE traza.id_proyecto=$id")->queryAll();
            //var_dump($comunidades); die();

        return $this->render('validarproyecto', [
            'model'         => $model,
            'correccion'    => $correccion,
             'proyecto'      => $proyecto,
            'integrantes'   => $integrantes,
            'traza'         => $traza,
            'rechazo'       => $rechazo,
        ]);
    }

    //Permite que se validen los proyecto
    //Corrección realizada para poder validar una propuesta
    //Permite que el proyecto que esta a la espera de validación sea sometido a corrección.
    //-----------------------------------
    public function actionCorregir()
    {
        if (Yii::$app->request->isAjax) 
        {
            //var_dump($_POST); die();

            $id_proyecto        = $_POST['id_proyecto'];
            $estatus            = $_POST['estatus'];
            $motivo_correccion  = $_POST['motivo_correccion'];
            $observaciones      = $_POST['observaciones'];
            $fechaHora          = date("Y-m-d H:i:s");

            $id_usuario = Yii::$app->user->identity->id;
            $personas = Yii::$app->db->createCommand("SELECT persona.id_persona
                                                      FROM personas AS persona
                                                      WHERE id_usuario=$id_usuario")->queryAll();



            foreach ($personas AS $personas)
            {
                $personas['id_persona'];
            }

            $traza = Yii::$app->db->createCommand()->insert('proyectos_trazas', [
                         'id_proyecto'              => $id_proyecto,
                         'id_estatus'               => $estatus,
                         'id_persona'               => $personas['id_persona'],
                         'observaciones'            => $observaciones,
                         'fecha_hora'               => $fechaHora,
            ])->execute();
            $id_proyecto_traza = Yii::$app->db->getLastInsertID();

            $motivo_correccion = Yii::$app->db->createCommand()->insert('proyectos_correcciones', [
                         'id_proyecto_traza'                => $id_proyecto_traza,
                         'id_proyecto_motivo_correccion'    => $motivo_correccion,
            ])->execute();

            $proyecto = Yii::$app->db->createCommand("UPDATE proyectos SET id_estatus=$estatus
                                                      WHERE id_proyecto=$id_proyecto")->queryAll();

            $estudiantes = Yii::$app->db->createCommand("SELECT
                                                        usuario.email
                                                        FROM proyectos_estudiantes AS pestudiantes
                                                        JOIN personas as persona
                                                        ON persona.id_persona=pestudiantes.id_persona
                                                        JOIN public.user AS usuario
                                                        ON persona.id_usuario=usuario.id
                                                        WHERE id_proyecto=$id_proyecto")->queryAll();

            foreach ($estudiantes AS $estudiante)
            {
                Yii::$app->mailer->compose()
                ->setFrom('jesusaranguren675@gmail.com')
                ->setTo($estudiante['email'])
                ->setSubject('Proyecto Socio Tecnologico Sometido a Corrección')
                ->setTextBody('Ahora eres parte de SIGEPSI')
                ->setHtmlBody('<b>La Universidad Politécnica Territorial de Caracas "Mariscal Sucre" informa que su proyecto número '.$id_proyecto.' ha sido sometido a corrección. Por favor ingrese al sistema."</b><p>http://localhost:8080/sigepsi/web/index.php<p>')
                    ->send();
            }

            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

            if($_POST != "")
            {
                if($traza)
                {
                    return [
                        'data' => [
                            'success'                   => true,
                            'message'                   => 'El proyecto ha sido corregido exitosamente.',
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

    //Permite que el usuario pueda ver la vista para corregir la propuesta que aún no ha sido aprobada
    public function actionCorregirpropuesta($id)
    {
        $model = $this->findModel($id);

        return $this->render('corregirpropuesta', [
            'model'         => $model,
        ]);
    }


    //Permite corregir la propuesta que aún no ha sido aprobada
    public function actionCorreccionpropuesta()
    {
        //var_dump($_POST); die();
        if (Yii::$app->request->isAjax) 
        {


            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

            $id_proyecto                   = $_POST['id_proyecto'];
            $id_necesidad                  = $_POST['id_necesidad'];
            $titulo                        = $_POST['titulo'];
            $problema                      = $_POST['problema'];
            $objetivo_general              = $_POST['objetivo_general'];
            $objetivos_especificos         = $_POST['objetivos_especificos'];
            $id_comunidad                  = $_POST['id_comunidad'];
            $conclusiones                  = $_POST['conclusiones'];
            $recomendaciones               = $_POST['recomendaciones'];
            $fecha_inicio                  = $_POST['fecha_inicio'];
            $fecha_fin                     = $_POST['fecha_fin'];
            $id_especialidad               = $_POST['id_especialidad'];
            $id_parroquia                  = $_POST['id_parroquia'];
            $formato_informe_final         = $_POST['formato_informe_final'];
            $direccion                     = $_POST['direccion'];
            $cedula_tutor_comunitario      = $_POST['cedula_tutor_comunitario'];
            $tutor_comunitario             = $_POST['tutor_comunitario'];
            $id_tutor                      = $_POST['id_tutor'];
            $sinopsis                      = $_POST['sinopsis'];
            $id_linea_investigacion        = $_POST['id_linea_investigacion'];
            $id_trayecto                   = $_POST['id_trayecto'];
            $observaciones                 = $_POST['observaciones'];
            $fechaHora                     = date("Y-m-d H:i:s");


            $proyecto = Yii::$app->db->createCommand("UPDATE proyectos
                                                      SET id_necesidad='$id_necesidad', titulo='$titulo',
                                                          problema='$problema', objetivo_general='$objetivo_general', 
                                                          objetivos_especificos='$objetivos_especificos',
                                                          id_comunidad=$id_comunidad, id_estatus=1,
                                                          conclusiones='$conclusiones', recomendaciones='$recomendaciones',
                                                          id_parroquia=$id_parroquia,
                                                          formato_informe_final='$formato_informe_final',
                                                          direccion='$direccion',
                                                          cedula_tutor_comunitario='$cedula_tutor_comunitario',
                                                          tutor_comunitario='$tutor_comunitario', 
                                                          id_tutor=$id_tutor, sinopsis='$sinopsis',
                                                          id_linea_investigacion=$id_linea_investigacion,
                                                          id_trayecto=$id_trayecto
                                                      WHERE id_proyecto=$id_proyecto")->queryAll();

            $id_usuario = Yii::$app->user->identity->id;
            $personas = Yii::$app->db->createCommand("SELECT persona.id_persona
                                                      FROM personas AS persona
                                                      WHERE id_usuario=$id_usuario")->queryAll();



            foreach ($personas AS $personas)
            {
                $personas['id_persona'];
            }

            $traza = Yii::$app->db->createCommand()->insert('proyectos_trazas', [
                         'id_proyecto'              => $id_proyecto,
                         'id_estatus'               => 1,
                         'id_persona'               => $personas['id_persona'],
                         'observaciones'            => $observaciones,
                         'fecha_hora'               => $fechaHora,
            ])->execute();


            $estudiantes = Yii::$app->db->createCommand("SELECT
                                                        usuario.email
                                                        FROM proyectos_estudiantes AS pestudiantes
                                                        JOIN personas as persona
                                                        ON persona.id_persona=pestudiantes.id_persona
                                                        JOIN public.user AS usuario
                                                        ON persona.id_usuario=usuario.id
                                                        WHERE id_proyecto=$id_proyecto")->queryAll();

            foreach ($estudiantes AS $estudiante)
            {
                Yii::$app->mailer->compose()
                ->setFrom('jesusaranguren675@gmail.com')
                ->setTo($estudiante['email'])
                ->setSubject('Proyecto Socio Tecnologico Corregido Exitosamente')
                ->setTextBody('Ahora eres parte de SIGEPSI')
                ->setHtmlBody('<b>La Universidad Politécnica Territorial de Caracas "Mariscal Sucre" informa que su proyecto número '.$id_proyecto.' ha sido corregido exitosamente y esta a la espera de una nueva validación."</b>')
                    ->send();
            }



            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

            if($_POST != "")
            {
                if($traza)
                {
                    return [
                        'data' => [
                            'success'                   => true,
                            'message'                   => 'El proyecto ha sido corregido.',
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

    public function actionRechazo()
    {
        
        if (Yii::$app->request->isAjax) 
        {
            //var_dump($_POST); die();

            $id_proyecto        = $_POST['id_proyecto'];
            $estatus            = $_POST['estatus'];
            $motivo_rechazo  = $_POST['motivo_rechazo'];
            $observaciones      = $_POST['observaciones'];
            $fechaHora          = date("Y-m-d H:i:s");

            $id_usuario = Yii::$app->user->identity->id;
            $personas = Yii::$app->db->createCommand("SELECT persona.id_persona
                                                      FROM personas AS persona
                                                      WHERE id_usuario=$id_usuario")->queryAll();



            foreach ($personas AS $personas)
            {
                $personas['id_persona'];
            }

            $traza = Yii::$app->db->createCommand()->insert('proyectos_trazas', [
                         'id_proyecto'              => $id_proyecto,
                         'id_estatus'               => $estatus,
                         'id_persona'               => $personas['id_persona'],
                         'observaciones'            => $observaciones,
                         'fecha_hora'               => $fechaHora,
            ])->execute();
            $id_proyecto_traza = Yii::$app->db->getLastInsertID();

            $rechazo = Yii::$app->db->createCommand()->insert('proyectos_correcciones', [
                         'id_proyecto_traza'                => $id_proyecto_traza,
                         'id_proyecto_motivo_correccion'    => $motivo_rechazo,
            ])->execute();

            $proyecto = Yii::$app->db->createCommand("UPDATE proyectos SET id_estatus=$estatus
                                                      WHERE id_proyecto=$id_proyecto")->queryAll();

            $estudiantes = Yii::$app->db->createCommand("SELECT
                                                        usuario.email
                                                        FROM proyectos_estudiantes AS pestudiantes
                                                        JOIN personas as persona
                                                        ON persona.id_persona=pestudiantes.id_persona
                                                        JOIN public.user AS usuario
                                                        ON persona.id_usuario=usuario.id
                                                        WHERE id_proyecto=$id_proyecto")->queryAll();

            foreach ($estudiantes AS $estudiante)
            {
                Yii::$app->mailer->compose()
                ->setFrom('jesusaranguren675@gmail.com')
                ->setTo($estudiante['email'])
                ->setSubject('Proyecto Socio Tecnologico Corregido Exitosamente')
                ->setTextBody('Ahora eres parte de SIGEPSI')
                ->setHtmlBody('<b>La Universidad Politécnica Territorial de Caracas "Mariscal Sucre" informa que su proyecto número '.$id_proyecto.' ha sido rechazado, puede leer las observaciones en el sistema."</b>')
                    ->send();
            }

            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

            if($_POST != "")
            {
                if($traza)
                {
                    return [
                        'data' => [
                            'success'                   => true,
                            'message'                   => 'El proyecto ha sido rechazado.',
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

    public function actionAprobar()
    {
    
        if (Yii::$app->request->isAjax) 
        {
            //var_dump($_POST); die();

            $id_proyecto        = $_POST['id_proyecto'];
            $estatus            = $_POST['estatus'];
            $observaciones      = $_POST['observaciones'];
            $fechaHora          = date("Y-m-d H:i:s");

            $id_usuario = Yii::$app->user->identity->id;
            $personas = Yii::$app->db->createCommand("SELECT persona.id_persona
                                                      FROM personas AS persona
                                                      WHERE id_usuario=$id_usuario")->queryAll();



            foreach ($personas AS $personas)
            {
                $personas['id_persona'];
            }

            $traza = Yii::$app->db->createCommand()->insert('proyectos_trazas', [
                         'id_proyecto'              => $id_proyecto,
                         'id_estatus'               => $estatus,
                         'id_persona'               => $personas['id_persona'],
                         'observaciones'            => $observaciones,
                         'fecha_hora'               => $fechaHora,
            ])->execute();
            $id_proyecto_traza = Yii::$app->db->getLastInsertID();


            $proyecto = Yii::$app->db->createCommand("UPDATE proyectos SET id_estatus=$estatus
                                                      WHERE id_proyecto=$id_proyecto")->queryAll();

            $estudiantes = Yii::$app->db->createCommand("SELECT
                                                        usuario.email
                                                        FROM proyectos_estudiantes AS pestudiantes
                                                        JOIN personas as persona
                                                        ON persona.id_persona=pestudiantes.id_persona
                                                        JOIN public.user AS usuario
                                                        ON persona.id_usuario=usuario.id
                                                        WHERE id_proyecto=$id_proyecto")->queryAll();

             foreach ($estudiantes AS $estudiante)
             {
                 Yii::$app->mailer->compose()
                 ->setFrom('jesusaranguren675@gmail.com')
                 ->setTo($estudiante['email'])
                 ->setSubject('Proyecto Socio Tecnologico Aprobado')
                 ->setTextBody('Ahora eres parte de SIGEPSI')
                 ->setHtmlBody('<b>La Universidad Politécnica Territorial de Caracas "Mariscal Sucre" informa que su proyecto número '.$id_proyecto.' ha sido aprobado y ya se encuentra en estatus de ejecución.</b>')
                     ->send();
             }

            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

            if($_POST != "")
            {
                if($traza)
                {
                    return [
                        'data' => [
                            'success'                   => true,
                            'message'                   => 'El proyecto ha sido aprobado.',
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

    public function actionSocializar($id)
    {

        $model = $this->findModel($id);

        $correccion = Yii::$app->db->createCommand("SELECT 
                                                    id_proyecto_motivo_correccion,
                                                    proyecto_motivo_correccion
                                                    FROM proyectos_motivos_correcciones
                                                    WHERE accion=1")->queryAll();


        $rechazo = Yii::$app->db->createCommand("SELECT *
                                                    FROM proyectos_motivos_rechazos")->queryAll();

        $proyecto = Yii::$app->db->createCommand("SELECT proyecto.id_proyecto, estatus.estatus, especialidad, trayecto.trayecto, linea_investigacion, titulo, problema, formato_propuesta, objetivo_general,
                  objetivos_especificos, sinopsis, nombre, estado, municipio, parroquia, proyecto.direccion,
                  proyecto.fecha_inicio, proyecto.fecha_fin, tutor_comunitario, tutor.primer_nombre, tutor.primer_apellido
                            FROM proyectos as proyecto
                            JOIN proyectos_estatus AS estatus ON proyecto.id_estatus=estatus.id_estatus
                            JOIN especialidades AS especialidad ON proyecto.id_especialidad=especialidad.id_especialidad
                            JOIN trayectos AS trayecto ON proyecto.id_trayecto=trayecto.id_trayecto
                            JOIN lineas_investigacion AS linea_inv ON proyecto.id_linea_investigacion=linea_inv.id_linea_investigacion
                            JOIN comunidades AS comunidad ON proyecto.id_comunidad=comunidad.id_comunidad
                            JOIN parroquias AS parroquia ON proyecto.id_parroquia=parroquia.id_parroquia
                            JOIN municipios AS municipio ON municipio.id_municipio=parroquia.id_municipio
                            JOIN estados AS estado ON estado.id_estado=municipio.id_municipio
                            JOIN tutores AS tutor ON proyecto.id_tutor=tutor.id_tutor
                            where id_proyecto=$id")->queryAll();

        $integrantes = Yii::$app->db->createCommand("SELECT persona.cedula, persona.primer_nombre,
                                                            persona.segundo_nombre, persona.primer_apellido,
                                                            persona.segundo_apellido, carrera.carrera,
                                                            persona.telefono_celular, persona.telefono_local,
                                                            usuario.email, persona.id_estatus
                                                    FROM personas AS persona
                                                    JOIN proyectos_estudiantes AS proyecto_estudiante
                                                    ON persona.id_persona=proyecto_estudiante.id_persona
                                                    JOIN estudiantes AS estudiante
                                                    ON estudiante.id_persona=proyecto_estudiante.id_persona
                                                    JOIN carreras AS carrera
                                                    ON estudiante.id_carrera=carrera.id_carrera
                                                    JOIN public.user AS usuario
                                                    ON persona.id_usuario=usuario.id
                                                    WHERE proyecto_estudiante.id_proyecto=$id")->queryAll();

        $traza = Yii::$app->db->createCommand("SELECT estatus.estatus, traza.observaciones, traza.fecha_hora,
                                                       persona.primer_nombre, persona.primer_apellido,
                                                       mcorreccion.proyecto_motivo_correccion
                                                FROM proyectos_trazas AS traza
                                                JOIN proyectos_estatus as estatus
                                                ON traza.id_estatus=estatus.id_estatus
                                                JOIN personas AS persona
                                                ON persona.id_persona=traza.id_persona
                                                LEFT JOIN proyectos_correcciones AS correccion
                                                ON correccion.id_proyecto_traza=traza.id_proyecto_traza
                                                LEFT JOIN proyectos_motivos_correcciones AS mcorreccion
                                                ON correccion.id_proyecto_correccion=mcorreccion.id_proyecto_motivo_correccion
                                                WHERE traza.id_proyecto=$id")->queryAll();

        return $this->render('socializar', [
            'model'         => $model,
            'correccion'    => $correccion,
            'proyecto'      => $proyecto,
            'integrantes'   => $integrantes,
            'traza'         => $traza,
            'rechazo'       => $rechazo,
        ]);
    }

    public function actionSocializado()
    {
        if (Yii::$app->request->isAjax) 
        {
            //var_dump($_POST); die();

            $id_proyecto        = $_POST['id_proyecto'];
            $observaciones      = $_POST['observaciones'];
            $estatus = 3;
            $fechaHora          = date("Y-m-d H:i:s");
            $id_usuario = Yii::$app->user->identity->id;
            $personas = Yii::$app->db->createCommand("SELECT persona.id_persona
                                                      FROM personas AS persona
                                                      WHERE id_usuario=$id_usuario")->queryAll();



            foreach ($personas AS $personas)
            {
                $personas['id_persona'];
            }

            $traza = Yii::$app->db->createCommand()->insert('proyectos_trazas', [
                         'id_proyecto'              => $id_proyecto,
                         'id_estatus'               => $estatus,
                         'id_persona'               => $personas['id_persona'],
                         'observaciones'            => $observaciones,
                         'fecha_hora'               => $fechaHora,
            ])->execute();
            $id_proyecto_traza = Yii::$app->db->getLastInsertID();


            $proyecto = Yii::$app->db->createCommand("UPDATE proyectos SET id_estatus=$estatus
                                                      WHERE id_proyecto=$id_proyecto")->queryAll();

            $estudiantes = Yii::$app->db->createCommand("SELECT
                                                        usuario.email
                                                        FROM proyectos_estudiantes AS pestudiantes
                                                        JOIN personas as persona
                                                        ON persona.id_persona=pestudiantes.id_persona
                                                        JOIN public.user AS usuario
                                                        ON persona.id_usuario=usuario.id
                                                        WHERE id_proyecto=$id_proyecto")->queryAll();

             foreach ($estudiantes AS $estudiante)
             {
                 Yii::$app->mailer->compose()
                 ->setFrom('jesusaranguren675@gmail.com')
                 ->setTo($estudiante['email'])
                 ->setSubject('Proyecto Socio Tecnologico Marcado como Socializado')
                 ->setTextBody('Ahora eres parte de SIGEPSI')
                 ->setHtmlBody('<b>La Universidad Politécnica Territorial de Caracas "Mariscal Sucre" informa que su proyecto número '.$id_proyecto.' ha sido marcado como ejecutado. Se encuentra a la espera de la validación del coordinador.</b>')
                     ->send();
             }

            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

            if($_POST != "")
            {
                if($traza)
                {
                    return [
                        'data' => [
                            'success'                   => true,
                            'message'                   => 'El proyecto ha sido socializado.',
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

    public function actionCulminar($id)
    {
        $model = $this->findModel($id);

        $correccion = Yii::$app->db->createCommand("SELECT 
                                                    id_proyecto_motivo_correccion,
                                                    proyecto_motivo_correccion
                                                    FROM proyectos_motivos_correcciones
                                                    WHERE accion=2")->queryAll();

        $rechazo = Yii::$app->db->createCommand("SELECT *
                                                    FROM proyectos_motivos_rechazos")->queryAll();

        $proyecto = Yii::$app->db->createCommand("SELECT proyecto.id_proyecto, estatus.estatus, especialidad, trayecto.trayecto, linea_investigacion, titulo, problema, formato_propuesta, objetivo_general,
                  objetivos_especificos, sinopsis, nombre, estado, municipio, parroquia, proyecto.direccion,
                  proyecto.fecha_inicio, proyecto.fecha_fin, tutor_comunitario, tutor.primer_nombre, tutor.primer_apellido
                            FROM proyectos as proyecto
                            JOIN proyectos_estatus AS estatus ON proyecto.id_estatus=estatus.id_estatus
                            JOIN especialidades AS especialidad ON proyecto.id_especialidad=especialidad.id_especialidad
                            JOIN trayectos AS trayecto ON proyecto.id_trayecto=trayecto.id_trayecto
                            JOIN lineas_investigacion AS linea_inv ON proyecto.id_linea_investigacion=linea_inv.id_linea_investigacion
                            JOIN comunidades AS comunidad ON proyecto.id_comunidad=comunidad.id_comunidad
                            JOIN parroquias AS parroquia ON proyecto.id_parroquia=parroquia.id_parroquia
                            JOIN municipios AS municipio ON municipio.id_municipio=parroquia.id_municipio
                            JOIN estados AS estado ON estado.id_estado=municipio.id_municipio
                            JOIN tutores AS tutor ON proyecto.id_tutor=tutor.id_tutor
                            where id_proyecto=$id")->queryAll();

        $integrantes = Yii::$app->db->createCommand("SELECT persona.cedula, persona.primer_nombre,
                                                            persona.segundo_nombre, persona.primer_apellido,
                                                            persona.segundo_apellido, carrera.carrera,
                                                            persona.telefono_celular, persona.telefono_local,
                                                            usuario.email, persona.id_estatus
                                                    FROM personas AS persona
                                                    JOIN proyectos_estudiantes AS proyecto_estudiante
                                                    ON persona.id_persona=proyecto_estudiante.id_persona
                                                    JOIN estudiantes AS estudiante
                                                    ON estudiante.id_persona=proyecto_estudiante.id_persona
                                                    JOIN carreras AS carrera
                                                    ON estudiante.id_carrera=carrera.id_carrera
                                                    JOIN public.user AS usuario
                                                    ON persona.id_usuario=usuario.id
                                                    WHERE proyecto_estudiante.id_proyecto=$id")->queryAll();

        $traza = Yii::$app->db->createCommand("SELECT estatus.estatus, traza.observaciones, traza.fecha_hora,
                                                       persona.primer_nombre, persona.primer_apellido,
                                                       mcorreccion.proyecto_motivo_correccion
                                                FROM proyectos_trazas AS traza
                                                JOIN proyectos_estatus as estatus
                                                ON traza.id_estatus=estatus.id_estatus
                                                JOIN personas AS persona
                                                ON persona.id_persona=traza.id_persona
                                                LEFT JOIN proyectos_correcciones AS correccion
                                                ON correccion.id_proyecto_traza=traza.id_proyecto_traza
                                                LEFT JOIN proyectos_motivos_correcciones AS mcorreccion
                                                ON correccion.id_proyecto_correccion=mcorreccion.id_proyecto_motivo_correccion
                                                WHERE traza.id_proyecto=$id")->queryAll();

        return $this->render('culminar', [
            'model'         => $model,
            'correccion'    => $correccion,
            'proyecto'      => $proyecto,
            'integrantes'   => $integrantes,
            'traza'         => $traza,
            'rechazo'       => $rechazo,
        ]);
    }

    public function actionCulminado()
    {
        //var_dump($_POST); die();

        if (Yii::$app->request->isAjax) 
        {
            //var_dump($_POST); die();

            $id_proyecto        = $_POST['id_proyecto'];
            $observaciones      = $_POST['observaciones'];
            $estatus            = $_POST['estatus'];
            $fechaHora          = date("Y-m-d H:i:s");
            $id_usuario = Yii::$app->user->identity->id;
            $personas = Yii::$app->db->createCommand("SELECT persona.id_persona
                                                      FROM personas AS persona
                                                      WHERE id_usuario=$id_usuario")->queryAll();



            foreach ($personas AS $personas)
            {
                $personas['id_persona'];
            }

            $traza = Yii::$app->db->createCommand()->insert('proyectos_trazas', [
                         'id_proyecto'              => $id_proyecto,
                         'id_estatus'               => $estatus,
                         'id_persona'               => $personas['id_persona'],
                         'observaciones'            => $observaciones,
                         'fecha_hora'               => $fechaHora,
            ])->execute();
            $id_proyecto_traza = Yii::$app->db->getLastInsertID();


            $proyecto = Yii::$app->db->createCommand("UPDATE proyectos SET id_estatus=$estatus
                                                      WHERE id_proyecto=$id_proyecto")->queryAll();

            $estudiantes = Yii::$app->db->createCommand("SELECT
                                                        usuario.email
                                                        FROM proyectos_estudiantes AS pestudiantes
                                                        JOIN personas as persona
                                                        ON persona.id_persona=pestudiantes.id_persona
                                                        JOIN public.user AS usuario
                                                        ON persona.id_usuario=usuario.id
                                                        WHERE id_proyecto=$id_proyecto")->queryAll();

             foreach ($estudiantes AS $estudiante)
             {
                 Yii::$app->mailer->compose()
                 ->setFrom('jesusaranguren675@gmail.com')
                 ->setTo($estudiante['email'])
                 ->setSubject('Proyecto Socio Tecnologico Culminado')
                 ->setTextBody('Ahora eres parte de SIGEPSI')
                 ->setHtmlBody('<b>La Universidad Politécnica Territorial de Caracas "Mariscal Sucre" informa que su proyecto número '.$id_proyecto.' culminó exitosamente. Ya puede emitir su carta de culminación.</b>')
                     ->send();
             }

            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

            if($_POST != "")
            {
                if($traza)
                {
                    return [
                        'data' => [
                            'success'                   => true,
                            'message'                   => 'El proyecto ha sido culminado.',
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

    public function actionCancelar($id)
    {
        $model = $this->findModel($id);

        $cancelacion = Yii::$app->db->createCommand("SELECT *
                                                    FROM proyectos_motivos_cancelaciones")->queryAll();

        $proyecto = Yii::$app->db->createCommand("SELECT proyecto.id_proyecto, estatus.estatus, especialidad, trayecto.trayecto, linea_investigacion, titulo, problema, formato_propuesta, objetivo_general,
                  objetivos_especificos, sinopsis, nombre, estado, municipio, parroquia, proyecto.direccion,
                  proyecto.fecha_inicio, proyecto.fecha_fin, tutor_comunitario, tutor.primer_nombre, tutor.primer_apellido
                            FROM proyectos as proyecto
                            JOIN proyectos_estatus AS estatus ON proyecto.id_estatus=estatus.id_estatus
                            JOIN especialidades AS especialidad ON proyecto.id_especialidad=especialidad.id_especialidad
                            JOIN trayectos AS trayecto ON proyecto.id_trayecto=trayecto.id_trayecto
                            JOIN lineas_investigacion AS linea_inv ON proyecto.id_linea_investigacion=linea_inv.id_linea_investigacion
                            JOIN comunidades AS comunidad ON proyecto.id_comunidad=comunidad.id_comunidad
                            JOIN parroquias AS parroquia ON proyecto.id_parroquia=parroquia.id_parroquia
                            JOIN municipios AS municipio ON municipio.id_municipio=parroquia.id_municipio
                            JOIN estados AS estado ON estado.id_estado=municipio.id_municipio
                            JOIN tutores AS tutor ON proyecto.id_tutor=tutor.id_tutor
                            where id_proyecto=$id")->queryAll();

        $integrantes = Yii::$app->db->createCommand("SELECT persona.cedula, persona.primer_nombre,
                                                            persona.segundo_nombre, persona.primer_apellido,
                                                            persona.segundo_apellido, carrera.carrera,
                                                            persona.telefono_celular, persona.telefono_local,
                                                            usuario.email, persona.id_estatus
                                                    FROM personas AS persona
                                                    JOIN proyectos_estudiantes AS proyecto_estudiante
                                                    ON persona.id_persona=proyecto_estudiante.id_persona
                                                    JOIN estudiantes AS estudiante
                                                    ON estudiante.id_persona=proyecto_estudiante.id_persona
                                                    JOIN carreras AS carrera
                                                    ON estudiante.id_carrera=carrera.id_carrera
                                                    JOIN public.user AS usuario
                                                    ON persona.id_usuario=usuario.id
                                                    WHERE proyecto_estudiante.id_proyecto=$id")->queryAll();

        $traza = Yii::$app->db->createCommand("SELECT estatus.estatus, traza.observaciones, traza.fecha_hora,
                                                       persona.primer_nombre, persona.primer_apellido,
                                                       mcorreccion.proyecto_motivo_correccion
                                                FROM proyectos_trazas AS traza
                                                JOIN proyectos_estatus as estatus
                                                ON traza.id_estatus=estatus.id_estatus
                                                JOIN personas AS persona
                                                ON persona.id_persona=traza.id_persona
                                                LEFT JOIN proyectos_correcciones AS correccion
                                                ON correccion.id_proyecto_traza=traza.id_proyecto_traza
                                                LEFT JOIN proyectos_motivos_correcciones AS mcorreccion
                                                ON correccion.id_proyecto_correccion=mcorreccion.id_proyecto_motivo_correccion
                                                WHERE traza.id_proyecto=$id")->queryAll();

        return $this->render('cancelar', [
            'model'         => $model,
            'cancelacion'    => $cancelacion,
            'proyecto'      => $proyecto,
            'integrantes'   => $integrantes,
            'traza'         => $traza,
        ]);
    }

    public function actionCancelado()
    {

        if (Yii::$app->request->isAjax) 
        {

            $id_proyecto        = $_POST['id_proyecto'];
            $observaciones      = $_POST['observaciones'];
            $motivo_cancelacion = $_POST['motivo_cancelacion'];
            $estatus            = 999;
            $fechaHora          = date("Y-m-d H:i:s");

            $id_usuario = Yii::$app->user->identity->id;
            $personas = Yii::$app->db->createCommand("SELECT persona.id_persona
                                                      FROM personas AS persona
                                                      WHERE id_usuario=$id_usuario")->queryAll();



            foreach ($personas AS $personas)
            {
                $personas['id_persona'];
            }

            $traza = Yii::$app->db->createCommand()->insert('proyectos_trazas', [
                         'id_proyecto'              => $id_proyecto,
                         'id_estatus'               => $estatus,
                         'id_persona'               => $personas['id_persona'],
                         'observaciones'            => $observaciones,
                         'fecha_hora'               => $fechaHora,
            ])->execute();
            $id_proyecto_traza = Yii::$app->db->getLastInsertID();

            $cancelado = Yii::$app->db->createCommand()->insert('proyectos_cancelaciones', [
                         'id_proyecto_traza'                => $id_proyecto_traza,
                         'id_proyecto_motivo_cancelacion'   => $motivo_cancelacion,
            ])->execute();


            $proyecto = Yii::$app->db->createCommand("UPDATE proyectos SET id_estatus=$estatus
                                                      WHERE id_proyecto=$id_proyecto")->queryAll();

            $estudiantes = Yii::$app->db->createCommand("SELECT
                                                        usuario.email
                                                        FROM proyectos_estudiantes AS pestudiantes
                                                        JOIN personas as persona
                                                        ON persona.id_persona=pestudiantes.id_persona
                                                        JOIN public.user AS usuario
                                                        ON persona.id_usuario=usuario.id
                                                        WHERE id_proyecto=$id_proyecto")->queryAll();

             foreach ($estudiantes AS $estudiante)
             {
                 Yii::$app->mailer->compose()
                 ->setFrom('jesusaranguren675@gmail.com')
                 ->setTo($estudiante['email'])
                 ->setSubject('Proyecto Socio Tecnológico Cancelado')
                 ->setTextBody('Ahora eres parte de SIGEPSI')
                 ->setHtmlBody('<b>La Universidad Politécnica Territorial de Caracas "Mariscal Sucre" informa que su proyecto número '.$id_proyecto.' ha sido cancelado. Por favor ingrese al sistema.</b>')
                     ->send();
             }

            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

            if($_POST != "")
            {
                if($traza)
                {
                    return [
                        'data' => [
                            'success'                   => true,
                            'message'                   => 'El proyecto ha sido cancelado.',
                        ],
                        'code' => 0,
                    ];

                    Yii::$app->session->setFlash('success', "El proyecto fue cancelado.");
                    return $this->redirect(['view']);
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
     * Deletes an existing Proyectos model.
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
     * Finds the Proyectos model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Proyectos the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Proyectos::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    
}

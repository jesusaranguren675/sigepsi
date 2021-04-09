<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "proyectos".
 *
 * @property int $id_proyecto
 * @property int $id_necesidad
 * @property string $titulo
 * @property string $problema
 * @property string $objetivo_general
 * @property string $objetivos_especificos
 * @property int $id_comunidad
 * @property int $id_estatus
 * @property string|null $conclusiones
 * @property string|null $recomendaciones
 * @property string|null $fecha_inicio
 * @property string|null $fecha_fin
 * @property int $id_especialidad
 * @property int $id_parroquia
 * @property string|null $formato_informe_final
 * @property string $formato_propuesta
 * @property string $direccion
 * @property int $cedula_tutor_comunitario
 * @property string $tutor_comunitario
 * @property int $id_tutor
 * @property string $sinopsis
 * @property int $id_linea_investigacion
 * @property int $id_trayecto
 * @property string|null $created_by
 * @property string|null $created_at
 * @property string|null $updated_by
 * @property string|null $updated_at
 *
 * @property Comunidades $comunidad
 * @property Especialidades $especialidad
 * @property LineasInvestigacion $lineaInvestigacion
 * @property Parroquias $parroquia
 * @property ProyectosEstatus $estatus
 * @property Trayectos $trayecto
 * @property ProyectosEstudiantes[] $proyectosEstudiantes
 * @property ProyectosTrazas[] $proyectosTrazas
 */
class Proyectos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */

    //CAMPOS NOSQL//////////////
    ////////////////////////////
    public $estatus;

    public $estado;
    public $id_estado;
    public $nombre;
    public $especialidad;
    public $linea_investigacion;
    public $primer_nombre;
    public $primer_apellido;
    public $municipio;
    public $id_necesidad;
    public $id_municipio;
    public $id_parroquia;
    public $id_tutor;
    public $cedula_integrante;
    public $comunidad_id_estado;
    public $comunidad_id_municipio;
    public $comunidad_id_parroquia;
    public $validacion;
    public $motivo_correcion;
    //FIN CAMPOS NOSQL//////////////
    ////////////////////////////

    public static function tableName()
    {

        return 'proyectos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['titulo', 'problema', 'objetivo_general', 'objetivos_especificos', 'id_comunidad', 'id_especialidad', 'id_parroquia', 'direccion', 'cedula_tutor_comunitario', 'tutor_comunitario', 'sinopsis', 'id_linea_investigacion', 'id_trayecto'], 'required'],
            [['id_necesidad', 'id_comunidad', 'id_estatus', 'id_especialidad', 'id_parroquia', 'cedula_tutor_comunitario', 'id_tutor', 'id_linea_investigacion', 'id_trayecto'], 'default', 'value' => null],
            [['id_necesidad', 'id_comunidad', 'id_estatus', 'id_especialidad', 'id_parroquia', 'cedula_tutor_comunitario', 'id_tutor', 'id_linea_investigacion', 'id_trayecto'], 'integer'],
            [['titulo', 'problema', 'objetivo_general', 'objetivos_especificos', 'conclusiones', 'recomendaciones', 'formato_informe_final', 'formato_propuesta', 'direccion', 'tutor_comunitario', 'sinopsis', 'created_by', 'updated_by'], 'string'],
            [['fecha_inicio', 'fecha_fin', 'created_at', 'updated_at'], 'safe'],
            [['id_comunidad'], 'exist', 'skipOnError' => true, 'targetClass' => Comunidades::className(), 'targetAttribute' => ['id_comunidad' => 'id_comunidad']],
            [['id_especialidad'], 'exist', 'skipOnError' => true, 'targetClass' => Especialidades::className(), 'targetAttribute' => ['id_especialidad' => 'id_especialidad']],
            [['id_linea_investigacion'], 'exist', 'skipOnError' => true, 'targetClass' => LineasInvestigacion::className(), 'targetAttribute' => ['id_linea_investigacion' => 'id_linea_investigacion']],
            [['id_parroquia'], 'exist', 'skipOnError' => true, 'targetClass' => Parroquias::className(), 'targetAttribute' => ['id_parroquia' => 'id_parroquia']],
            [['id_estatus'], 'exist', 'skipOnError' => true, 'targetClass' => ProyectosEstatus::className(), 'targetAttribute' => ['id_estatus' => 'id_estatus']],
            [['id_trayecto'], 'exist', 'skipOnError' => true, 'targetClass' => Trayectos::className(), 'targetAttribute' => ['id_trayecto' => 'id_trayecto']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_proyecto' => 'Id Proyecto',
            'id_necesidad' => '',
            'titulo' => 'Título',
            'problema' => 'Problema',
            'objetivo_general' => 'Objetivo General',
            'objetivos_especificos' => 'Objetivos Especificos',
            'id_comunidad' => 'Comunidad',
            'id_estatus' => 'Id Estatus',
            'conclusiones' => 'Conclusiones',
            'recomendaciones' => 'Recomendaciones',
            'fecha_inicio' => 'Fecha Inicio',
            'fecha_fin' => 'Fecha Fin',
            'id_especialidad' => 'Especialidad',
            'id_estado' => 'Estado',
            'id_municipio' => 'Municipio',
            'id_parroquia' => 'Parroquia',
            'formato_informe_final' => 'Formato Informe Final',
            'formato_propuesta' => 'Formato Propuesta',
            'direccion' => 'Dirección',
            'cedula_tutor_comunitario' => 'Cédula Tutor Comunitario',
            'tutor_comunitario' => 'Nombre Tutor Comunitario',
            'id_tutor' => 'Tutor Académico',
            'sinopsis' => 'Sinopsis',
            'id_linea_investigacion' => 'Línea de Investigación',
            'id_trayecto' => 'Trayecto',
            'created_by' => 'Created By',
            'created_at' => 'Created At',
            'updated_by' => 'Updated By',
            'updated_at' => 'Updated At',
            'comunidad_id_estado' => 'Estado',
            'comunidad_id_municipio' => 'Municipio',
            'comunidad_id_parroquia' => 'Parroquia',
            'cedula_integrante'     => 'Cédula Integrante'
        ];
    }

    /**
     * Gets query for [[Comunidad]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComunidad()
    {
        return $this->hasOne(Comunidades::className(), ['id_comunidad' => 'id_comunidad']);
    }

    /**
     * Gets query for [[Especialidad]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEspecialidad()
    {
        return $this->hasOne(Especialidades::className(), ['id_especialidad' => 'id_especialidad']);
    }

    /**
     * Gets query for [[LineaInvestigacion]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLineaInvestigacion()
    {
        return $this->hasOne(LineasInvestigacion::className(), ['id_linea_investigacion' => 'id_linea_investigacion']);
    }

    /**
     * Gets query for [[Parroquia]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getParroquia()
    {
        return $this->hasOne(Parroquias::className(), ['id_parroquia' => 'id_parroquia']);
    }

    /**
     * Gets query for [[Estatus]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEstatus()
    {
        return $this->hasOne(ProyectosEstatus::className(), ['id_estatus' => 'id_estatus']);
    }

    /**
     * Gets query for [[Trayecto]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTrayecto()
    {
        return $this->hasOne(Trayectos::className(), ['id_trayecto' => 'id_trayecto']);
    }

    /**
     * Gets query for [[ProyectosEstudiantes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProyectosEstudiantes()
    {
        return $this->hasMany(ProyectosEstudiantes::className(), ['id_proyecto' => 'id_proyecto']);
    }

    /**
     * Gets query for [[ProyectosTrazas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProyectosTrazas()
    {
        return $this->hasMany(ProyectosTrazas::className(), ['id_proyecto' => 'id_proyecto']);
    }
}

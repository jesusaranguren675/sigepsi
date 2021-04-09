<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "proyectos_estudiantes".
 *
 * @property int $id_proyecto_estudiante
 * @property int $id_proyecto
 * @property int $id_persona
 * @property int $id_estatus
 * @property string|null $formato_horas_digital
 * @property string|null $observaciones
 *
 * @property Personas $persona
 * @property Proyectos $proyecto
 * @property ProyectosEstudiantesEstatus $estatus
 * @property ProyectosRetiros[] $proyectosRetiros
 */
class ProyectosEstudiantes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'proyectos_estudiantes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_proyecto', 'id_persona', 'id_estatus'], 'required'],
            [['id_proyecto', 'id_persona', 'id_estatus'], 'default', 'value' => null],
            [['id_proyecto', 'id_persona', 'id_estatus'], 'integer'],
            [['formato_horas_digital', 'observaciones'], 'string'],
            [['id_persona'], 'exist', 'skipOnError' => true, 'targetClass' => Personas::className(), 'targetAttribute' => ['id_persona' => 'id_persona']],
            [['id_proyecto'], 'exist', 'skipOnError' => true, 'targetClass' => Proyectos::className(), 'targetAttribute' => ['id_proyecto' => 'id_proyecto']],
            [['id_estatus'], 'exist', 'skipOnError' => true, 'targetClass' => ProyectosEstudiantesEstatus::className(), 'targetAttribute' => ['id_estatus' => 'id_estatus']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_proyecto_estudiante' => 'Id Proyecto Estudiante',
            'id_proyecto' => 'Id Proyecto',
            'id_persona' => 'Id Persona',
            'id_estatus' => 'Id Estatus',
            'formato_horas_digital' => 'Formato Horas Digital',
            'observaciones' => 'Observaciones',
        ];
    }

    /**
     * Gets query for [[Persona]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPersona()
    {
        return $this->hasOne(Personas::className(), ['id_persona' => 'id_persona']);
    }

    /**
     * Gets query for [[Proyecto]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProyecto()
    {
        return $this->hasOne(Proyectos::className(), ['id_proyecto' => 'id_proyecto']);
    }

    /**
     * Gets query for [[Estatus]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEstatus()
    {
        return $this->hasOne(ProyectosEstudiantesEstatus::className(), ['id_estatus' => 'id_estatus']);
    }

    /**
     * Gets query for [[ProyectosRetiros]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProyectosRetiros()
    {
        return $this->hasMany(ProyectosRetiros::className(), ['id_proyecto_estudiante' => 'id_proyecto_estudiante']);
    }
}

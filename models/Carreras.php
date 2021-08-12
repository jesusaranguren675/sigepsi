<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "carreras".
 *
 * @property int $id_carrera
 * @property string $carrera
 * @property int $id_procedencia
 * @property int $id_especialidad
 *
 * @property Especialidades $especialidad
 * @property Procedencias $procedencia
 * @property Estudiantes[] $estudiantes
 * @property EstudiantesSiace[] $estudiantesSiaces
 * @property LineasInvestigacion[] $lineasInvestigacions
 */
class Carreras extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'carreras';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['carrera', 'id_procedencia', 'id_especialidad'], 'required'],
            [['id_procedencia', 'id_especialidad'], 'default', 'value' => null],
            //[['id_procedencia', 'id_especialidad'], 'integer'],
            [['carrera'], 'string', 'max' => 250],
            [['id_especialidad'], 'exist', 'skipOnError' => true, 'targetClass' => Especialidades::className(), 'targetAttribute' => ['id_especialidad' => 'id_especialidad']],
            [['id_procedencia'], 'exist', 'skipOnError' => true, 'targetClass' => Procedencias::className(), 'targetAttribute' => ['id_procedencia' => 'id_procedencia']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_carrera' => 'Id Carrera',
            'carrera' => 'Carrera',
            'id_procedencia' => 'Id Procedencia',
            'id_especialidad' => 'Id Especialidad',
        ];
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
     * Gets query for [[Procedencia]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProcedencia()
    {
        return $this->hasOne(Procedencias::className(), ['id_procedencia' => 'id_procedencia']);
    }

    /**
     * Gets query for [[Estudiantes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEstudiantes()
    {
        return $this->hasMany(Estudiantes::className(), ['id_carrera' => 'id_carrera']);
    }

    /**
     * Gets query for [[EstudiantesSiaces]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEstudiantesSiaces()
    {
        return $this->hasMany(EstudiantesSiace::className(), ['id_carrera' => 'id_carrera']);
    }

    /**
     * Gets query for [[LineasInvestigacions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLineasInvestigacions()
    {
        return $this->hasMany(LineasInvestigacion::className(), ['id_carrera' => 'id_carrera']);
    }
}

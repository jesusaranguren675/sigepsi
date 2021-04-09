<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "especialidades".
 *
 * @property int $id_especialidad
 * @property string|null $especialidad
 * @property bool|null $mostrar
 *
 * @property Carreras[] $carreras
 * @property CoordinadoresEspecialidades[] $coordinadoresEspecialidades
 * @property Necesidades[] $necesidades
 * @property Proyectos[] $proyectos
 * @property TutoresEspecialidades[] $tutoresEspecialidades
 */
class Especialidades extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'especialidades';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_especialidad'], 'required'],
            [['id_especialidad'], 'default', 'value' => null],
            [['id_especialidad'], 'integer'],
            [['especialidad'], 'string'],
            [['mostrar'], 'boolean'],
            [['id_especialidad'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_especialidad' => 'Id Especialidad',
            'especialidad' => 'Especialidad',
            'mostrar' => 'Mostrar',
        ];
    }

    /**
     * Gets query for [[Carreras]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCarreras()
    {
        return $this->hasMany(Carreras::className(), ['id_especialidad' => 'id_especialidad']);
    }

    /**
     * Gets query for [[CoordinadoresEspecialidades]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCoordinadoresEspecialidades()
    {
        return $this->hasMany(CoordinadoresEspecialidades::className(), ['id_especialidad' => 'id_especialidad']);
    }

    /**
     * Gets query for [[Necesidades]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNecesidades()
    {
        return $this->hasMany(Necesidades::className(), ['id_especialidad' => 'id_especialidad']);
    }

    /**
     * Gets query for [[Proyectos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProyectos()
    {
        return $this->hasMany(Proyectos::className(), ['id_especialidad' => 'id_especialidad']);
    }

    /**
     * Gets query for [[TutoresEspecialidades]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTutoresEspecialidades()
    {
        return $this->hasMany(TutoresEspecialidades::className(), ['id_especialidad' => 'id_especialidad']);
    }
}

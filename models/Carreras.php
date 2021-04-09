<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "public.carreras".
 *
 * @property int $id_carrera
 * @property string $carrera
 * @property int $id_procedencia
 * @property int $id_especialidad
 */
class Carreras extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'public.carreras';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_carrera', 'carrera', 'id_procedencia'], 'required'],
            [['id_carrera', 'id_procedencia', 'id_especialidad'], 'default', 'value' => null],
            [['id_carrera', 'id_procedencia', 'id_especialidad'], 'integer'],
            [['carrera'], 'string'],
            [['id_carrera'], 'unique'],
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
}

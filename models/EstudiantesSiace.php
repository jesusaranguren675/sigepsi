<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "public.estudiantes_siace".
 *
 * @property int $id_estudiante
 * @property int $cedula
 * @property string $nombres
 * @property string $apellidos
 * @property int $id_carrera
 * @property int $id_turno
 * @property int $trayecto
 * @property int $trimestre
 */
class EstudiantesSiace extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'public.estudiantes_siace';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cedula', 'nombres', 'apellidos', 'id_carrera', 'id_turno', 'trayecto', 'trimestre'], 'required'],
            [['cedula', 'id_carrera', 'id_turno', 'trayecto', 'trimestre'], 'default', 'value' => null],
            [['cedula', 'id_carrera', 'id_turno', 'trayecto', 'trimestre'], 'integer'],
            [['nombres', 'apellidos'], 'string'],
            [['id_carrera'], 'exist', 'skipOnError' => true, 'targetClass' => Carreras::className(), 'targetAttribute' => ['id_carrera' => 'id_carrera']],
            [['id_turno'], 'exist', 'skipOnError' => true, 'targetClass' => Turnos::className(), 'targetAttribute' => ['id_turno' => 'id_turno']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_estudiante' => 'Id Estudiante',
            'cedula' => 'Cedula',
            'nombres' => 'Nombres',
            'apellidos' => 'Apellidos',
            'id_carrera' => 'Id Carrera',
            'id_turno' => 'Id Turno',
            'trayecto' => 'Trayecto',
            'trimestre' => 'Trimestre',
        ];
    }
}

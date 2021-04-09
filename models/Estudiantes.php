<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "public.estudiantes".
 *
 * @property int $id_estudiante
 * @property int $id_persona
 * @property int $id_carrera
 */
class Estudiantes extends \yii\db\ActiveRecord
{
    //CAMPOS NOSQL//////////////
    ////////////////////////////
    public $cedula;
    public $nombres;
    public $apellidos;
    public $especialidad;
    public $id_comunidad;
    public $nombre;
    public $estado;
    public $municipio;
    public $parroquia;
    public $primer_nombre;
    public $segundo_nombre;
    public $primer_apellido;
    public $segundo_apellido;
    public $procedencia;
    public $fecha_nac;
    public $telefono_celular;
    public $telefono_local;
    public $username;
    public $email;
    public $password;
    public $password_confirm;
    //FIN CAMPOS NOSQL//////////////
    ////////////////////////////
    /**

     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'public.estudiantes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_persona', 'id_carrera'], 'default', 'value' => null],
            [['id_persona', 'id_carrera'], 'integer'],
            [['id_carrera'], 'exist', 'skipOnError' => true, 'targetClass' => Carreras::className(), 'targetAttribute' => ['id_carrera' => 'id_carrera']],
            [['id_persona'], 'exist', 'skipOnError' => true, 'targetClass' => Personas::className(), 'targetAttribute' => ['id_persona' => 'id_persona']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_estudiante'     => 'Id Estudiante',
            'id_persona'        => 'Id Persona',
            'id_carrera'        => 'Id Carrera',
            'cedula'            => 'Cédula',
            'nombres'           => 'Nombres',
            'apellidos'          => 'Apellidos',
            'especialidad'      => 'Especialidad',
            'email'             => 'Correo Electrónico',
            'password'          => 'Contraseña',
            'password_confirm'  => 'Confirmar Contraseña',
            'telefono_local'    => 'Teléfono Local',
            'telefono_celular' => 'Teléfono Celular'
        ];
    }
}

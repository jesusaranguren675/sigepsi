<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "public.personas".
 *
 * @property int $id_persona
 * @property int $cedula
 * @property string $primer_nombre
 * @property string|null $segundo_nombre
 * @property string $primer_apellido
 * @property string|null $segundo_apellido
 * @property string $fecha_nac
 * @property string $telefono_celular
 * @property string $telefono_local
 * @property int $id_usuario
 * @property int|null $id_estatus
 */
class Personas extends \yii\db\ActiveRecord
{

    public $id;
    public $id_estudiante;
    public $nombres;
    public $apellidos;
    public $carrera;
    public $username;
    public $email;
    public $password;
    public $password_confirm;
    public $especialidad; 
    public $id_especialidad;
    public $item_name;


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'public.personas';
    }

    /**
     * {@inheritdoc}
     */
     public function rules()
     {
         return [
             [['id_persona', 'cedula', 'primer_nombre', 'primer_apellido', 'fecha_nac', 'telefono_celular', 'telefono_local', 'id_usuario'], 'required'],
             [['cedula', 'id_usuario', 'id_estatus'], 'default', 'value' => null],
             [['cedula', 'id_usuario', 'id_estatus'], 'integer'],
             [['primer_nombre', 'segundo_nombre', 'primer_apellido', 'segundo_apellido', 'telefono_celular', 'telefono_local'], 'string'],
             [['fecha_nac'], 'safe'],
         ];
     }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_persona' => 'Id Persona',
            'cedula' => 'Cedula',
            'primer_nombre' => 'Primer Nombre',
            'segundo_nombre' => 'Segundo Nombre',
            'primer_apellido' => 'Primer Apellido',
            'segundo_apellido' => 'Segundo Apellido',
            'fecha_nac' => 'Fecha de Nacimiento',
            'telefono_celular' => 'Teléfono Celular',
            'telefono_local' => 'Teléfono Local',
            'username' => 'Usuario',
            'email'     => 'Correo Electrónico',
            'password'  => 'Contraseña',
            'id_estatus' => 'Id Estatus',
            'password_confirm'  => 'Confirmar Contraseña',
            'id_especialidad'      => 'Especialidad',
        ];
    }
}

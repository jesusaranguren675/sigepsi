<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "public.comunidades".
 *
 * @property int $id_comunidad
 * @property string $nombre
 * @property int $id_tipo_comunidad
 * @property string $direccion
 * @property string $telefono
 * @property string $persona_contacto
 * @property int $id_parroquia
 * @property int $id_estatus
 * @property int|null $id_usuario
 */
class Comunidades extends \yii\db\ActiveRecord
{
    
    //CAMPOS NOSQL//////////////
    ////////////////////////////
    public $tipo_comunidad;
    public $estado;
    public $municipio;
    public $parroquia;
    public $estatus;
    public $username;
    public $email;
    public $password;
    public $password_confirm;
    //FIN CAMPOS NOSQL//////////////
    ////////////////////////////

    public static function tableName()
    {
        return 'public.comunidades';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'id_comunidad', 'id_tipo_comunidad', 'direccion', 'telefono', 'persona_contacto', 'id_parroquia'], 'required'],
            [['nombre', 'direccion', 'telefono', 'persona_contacto'], 'string'],
            [['id_tipo_comunidad', 'id_parroquia', 'id_estatus', 'id_usuario'], 'default', 'value' => null],
            [['id_tipo_comunidad', 'id_parroquia', 'id_estatus', 'id_usuario'], 'integer'],
            [['id_parroquia'], 'exist', 'skipOnError' => true, 'targetClass' => Parroquias::className(), 'targetAttribute' => ['id_parroquia' => 'id_parroquia']],
            [['id_tipo_comunidad'], 'exist', 'skipOnError' => true, 'targetClass' => TiposComunidades::className(), 'targetAttribute' => ['id_tipo_comunidad' => 'id_tipo_comunidad']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_comunidad' => 'Id Comunidad',
            'nombre' => 'Nombre de la comunidad',
            'id_tipo_comunidad' => 'Tipo de comunidad',
            'direccion' => 'Dirección',
            'telefono' => 'Teléfono',
            'persona_contacto' => 'Persona Contacto',
            'id_parroquia' => 'Id Parroquia',
            'id_estatus' => 'Id Estatus',
            'id_usuario' => 'Id Usuario',
            'estado'     => 'Estado',
            'municipio'  =>  'Municipio',
            'parroquia'  =>  'Parroquia',
            'email' => 'Correo electrónico',
            'username'  => 'Usuario',
            'password'  => 'Contraseña',
            'password_confirm'  => 'Confirme contraseña',
        ];
    }
}

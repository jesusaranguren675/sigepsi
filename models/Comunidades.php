<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "comunidades".
 *
 * @property int $id_comunidad
 * @property string $rif
 * @property string $nombre
 * @property int $id_tipo_comunidad
 * @property int $telefono_contacto
 * @property string $persona_contacto
 * @property string $email
 * @property int $id_parroquia
 * @property string $direccion
 * @property int $id_user
 * @property int $id_estatus
 *
 * @property Parroquias $parroquia
 * @property Proyectos $comunidad
 * @property TiposComunidades $tipoComunidad
 * @property Proyectos[] $proyectos
 * @property ProyectosNecesidades[] $proyectosNecesidades
 */
class Comunidades extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'comunidades';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['rif', 'nombre', 'id_tipo_comunidad', 'telefono_contacto', 'persona_contacto', 'email', 'id_parroquia', 'direccion', 'id_user', 'id_estatus'], 'required', 'message' => 'El campo es requerido'],
            [['id_tipo_comunidad', 'telefono_contacto', 'id_parroquia', 'id_user', 'id_estatus'], 'default', 'value' => null],
            [['id_tipo_comunidad', 'telefono_contacto', 'id_parroquia', 'id_user', 'id_estatus'], 'integer'],
            [['rif', 'nombre', 'persona_contacto', 'email', 'direccion'], 'string', 'max' => 100],
            [['id_parroquia'], 'exist', 'skipOnError' => true, 'targetClass' => Parroquias::className(), 'targetAttribute' => ['id_parroquia' => 'id_parroquia']],
            [['id_comunidad'], 'exist', 'skipOnError' => true, 'targetClass' => Proyectos::className(), 'targetAttribute' => ['id_comunidad' => 'id_proyectos']],
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
            'rif' => 'Rif',
            'nombre' => 'Nombre',
            'id_tipo_comunidad' => 'Tipo de Comunidad',
            'telefono_contacto' => 'Telefono de Contacto',
            'persona_contacto' => 'Persona de Contacto',
            'email' => 'Correo',
            'id_parroquia' => 'Parroquia',
            'direccion' => 'Dirección',
            'id_user' => 'Id User',
            'id_estatus' => 'Id Estatus',
        ];
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
     * Gets query for [[Comunidad]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComunidad()
    {
        return $this->hasOne(Proyectos::className(), ['id_proyectos' => 'id_comunidad']);
    }

    /**
     * Gets query for [[TipoComunidad]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTipoComunidad()
    {
        return $this->hasOne(TiposComunidades::className(), ['id_tipo_comunidad' => 'id_tipo_comunidad']);
    }

    /**
     * Gets query for [[Proyectos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProyectos()
    {
        return $this->hasMany(Proyectos::className(), ['id_comunidad' => 'id_comunidad']);
    }

    /**
     * Gets query for [[ProyectosNecesidades]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProyectosNecesidades()
    {
        return $this->hasMany(ProyectosNecesidades::className(), ['id_comunidad' => 'id_comunidad']);
    }
}

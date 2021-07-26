<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "personas".
 *
 * @property int $id_persona
 * @property int $cedula
 * @property string $primer_nombre
 * @property string|null $segundo_nombre
 * @property string $primer_apellido
 * @property string|null $segundo_apellido
 * @property string $fecha_nac
 * @property string|null $telefono_celular
 * @property string|null $telefono_local
 * @property int $id_user
 * @property int $id_estatus
 *
 * @property Estudiantes[] $estudiantes
 * @property ProyectosRetiros[] $proyectosRetiros
 */
class Personas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'personas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cedula', 'primer_nombre', 'primer_apellido', 'fecha_nac', 'id_user', 'id_estatus'], 'required'],
            [['cedula', 'id_user', 'id_estatus'], 'default', 'value' => null],
            [['cedula', 'id_user', 'id_estatus'], 'integer'],
            [['fecha_nac'], 'safe'],
            [['telefono_celular'], 'string'],
            [['primer_nombre', 'segundo_nombre', 'primer_apellido', 'segundo_apellido', 'telefono_local'], 'string', 'max' => 100],
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
            'fecha_nac' => 'Fecha Nac',
            'telefono_celular' => 'Telefono Celular',
            'telefono_local' => 'Telefono Local',
            'id_user' => 'Id User',
            'id_estatus' => 'Id Estatus',
        ];
    }

    /**
     * Gets query for [[Estudiantes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEstudiantes()
    {
        return $this->hasMany(Estudiantes::className(), ['id_persona' => 'id_persona']);
    }

    /**
     * Gets query for [[ProyectosRetiros]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProyectosRetiros()
    {
        return $this->hasMany(ProyectosRetiros::className(), ['id_persona' => 'id_persona']);
    }
}

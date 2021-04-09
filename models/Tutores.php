<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tutores".
 *
 * @property int $id_tutor
 * @property string $primer_nombre
 * @property string|null $segundo_nombre
 * @property string $primer_apellido
 * @property string|null $segundo_apellido
 * @property string $telefono_celular
 * @property string $email
 * @property int $cedula
 *
 * @property TutoresEspecialidades[] $tutoresEspecialidades
 */
class Tutores extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tutores';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['primer_nombre', 'primer_apellido', 'telefono_celular', 'email', 'cedula'], 'required'],
            [['primer_nombre', 'segundo_nombre', 'primer_apellido', 'segundo_apellido', 'telefono_celular', 'email'], 'string'],
            [['cedula'], 'default', 'value' => null],
            [['cedula'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_tutor' => 'Id Tutor',
            'primer_nombre' => 'Primer Nombre',
            'segundo_nombre' => 'Segundo Nombre',
            'primer_apellido' => 'Primer Apellido',
            'segundo_apellido' => 'Segundo Apellido',
            'telefono_celular' => 'Telefono Celular',
            'email' => 'Email',
            'cedula' => 'Cedula',
        ];
    }

    /**
     * Gets query for [[TutoresEspecialidades]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTutoresEspecialidades()
    {
        return $this->hasMany(TutoresEspecialidades::className(), ['id_tutor' => 'id_tutor']);
    }
}

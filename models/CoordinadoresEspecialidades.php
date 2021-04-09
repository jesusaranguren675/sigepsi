<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "coordinadores_especialidades".
 *
 * @property int $id_coordinador_especialidad
 * @property int $id_user
 * @property int|null $id_especialidad
 *
 * @property Especialidades $especialidad
 */
class CoordinadoresEspecialidades extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'coordinadores_especialidades';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_user'], 'required'],
            [['id_user', 'id_especialidad'], 'default', 'value' => null],
            [['id_user', 'id_especialidad'], 'integer'],
            [['id_especialidad'], 'exist', 'skipOnError' => true, 'targetClass' => Especialidades::className(), 'targetAttribute' => ['id_especialidad' => 'id_especialidad']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_coordinador_especialidad' => 'Id Coordinador Especialidad',
            'id_user' => 'Id User',
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
}

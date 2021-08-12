<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "trayectos".
 *
 * @property int $id_trayecto
 * @property int $trayecto
 *
 * @property EstudiantesSiace[] $estudiantesSiaces
 * @property Proyectos[] $proyectos
 */
class Trayectos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'trayectos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['trayecto'], 'required'],
            [['trayecto'], 'default', 'value' => null],
            [['trayecto'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_trayecto' => 'Id Trayecto',
            'trayecto' => 'Trayecto',
        ];
    }

    /**
     * Gets query for [[EstudiantesSiaces]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEstudiantesSiaces()
    {
        return $this->hasMany(EstudiantesSiace::className(), ['id_trayecto' => 'id_trayecto']);
    }

    /**
     * Gets query for [[Proyectos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProyectos()
    {
        return $this->hasMany(Proyectos::className(), ['id_trayecto' => 'id_trayecto']);
    }
}

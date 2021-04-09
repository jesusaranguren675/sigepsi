<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "trayectos".
 *
 * @property int $id_trayecto
 * @property string $trayecto
 * @property int $orden
 *
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
            [['trayecto', 'orden'], 'required'],
            [['trayecto'], 'string'],
            [['orden'], 'default', 'value' => null],
            [['orden'], 'integer'],
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
            'orden' => 'Orden',
        ];
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

<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "proyectos_estatus".
 *
 * @property int $id_estatus
 * @property string $estatus
 * @property string|null $observaciones
 *
 * @property Proyectos[] $proyectos
 * @property ProyectosTrazas[] $proyectosTrazas
 */
class ProyectosEstatus extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'proyectos_estatus';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_estatus', 'estatus'], 'required'],
            [['id_estatus'], 'default', 'value' => null],
            [['id_estatus'], 'integer'],
            [['estatus', 'observaciones'], 'string'],
            [['id_estatus'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_estatus' => 'Id Estatus',
            'estatus' => 'Estatus',
            'observaciones' => 'Observaciones',
        ];
    }

    /**
     * Gets query for [[Proyectos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProyectos()
    {
        return $this->hasMany(Proyectos::className(), ['id_estatus' => 'id_estatus']);
    }

    /**
     * Gets query for [[ProyectosTrazas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProyectosTrazas()
    {
        return $this->hasMany(ProyectosTrazas::className(), ['id_estatus' => 'id_estatus']);
    }
}

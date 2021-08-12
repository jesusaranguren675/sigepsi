<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "productos".
 *
 * @property int $id_producto
 * @property string $producto
 * @property int $id_carrera
 * @property int $id_trayecto
 *
 * @property Estructuras[] $estructuras
 */
class Productos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'productos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['producto', 'id_carrera', 'id_trayecto'], 'required'],
            [['id_carrera', 'id_trayecto'], 'default', 'value' => null],
            [['id_carrera', 'id_trayecto'], 'integer'],
            [['producto'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_producto' => 'Id Producto',
            'producto' => 'Producto',
            'id_carrera' => 'Id Carrera',
            'id_trayecto' => 'Id Trayecto',
        ];
    }

    /**
     * Gets query for [[Estructuras]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEstructuras()
    {
        return $this->hasMany(Estructuras::className(), ['id_producto' => 'id_producto']);
    }
}

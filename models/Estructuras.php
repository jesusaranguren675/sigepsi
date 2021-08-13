<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "estructuras".
 *
 * @property int $id_estructura
 * @property int $id_carrera
 * @property int $id_trayecto
 * @property int $id_linea_investigacion
 * @property int $id_producto
 * @property int $id_item_estructura
 * @property int $peso
 *
 * @property ItemsEstructuras $itemEstructura
 * @property Productos $producto
 * @property ProyectosEvaluaciones[] $proyectosEvaluaciones
 */
class Estructuras extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'estructuras';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_carrera', 'id_trayecto', 'id_linea_investigacion', 'id_producto', 'id_item_estructura', 'peso'], 'required'],
            [['id_carrera', 'id_trayecto', 'id_linea_investigacion', 'id_producto', 'id_item_estructura', 'peso'], 'default', 'value' => null],
            [['id_carrera', 'id_trayecto', 'id_linea_investigacion', 'id_producto', 'id_item_estructura', 'peso'], 'integer'],
            [['id_item_estructura'], 'exist', 'skipOnError' => true, 'targetClass' => ItemsEstructuras::className(), 'targetAttribute' => ['id_item_estructura' => 'id_item_estructura']],
            [['id_producto'], 'exist', 'skipOnError' => true, 'targetClass' => Productos::className(), 'targetAttribute' => ['id_producto' => 'id_producto']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_estructura' => 'Id Estructura',
            'id_carrera' => 'Carrera',
            'id_trayecto' => 'Trayecto',
            'id_linea_investigacion' => 'Linea de Investigacion',
            'id_producto' => 'Id Producto',
            'id_item_estructura' => 'Id Item Estructura',
            'peso' => 'Peso',
        ];
    }

    /**
     * Gets query for [[ItemEstructura]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getItemEstructura()
    {
        return $this->hasOne(ItemsEstructuras::className(), ['id_item_estructura' => 'id_item_estructura']);
    }

    /**
     * Gets query for [[Producto]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProducto()
    {
        return $this->hasOne(Productos::className(), ['id_producto' => 'id_producto']);
    }

    /**
     * Gets query for [[ProyectosEvaluaciones]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProyectosEvaluaciones()
    {
        return $this->hasMany(ProyectosEvaluaciones::className(), ['id_estructura' => 'id_estructura']);
    }
}

<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "items_estructuras".
 *
 * @property int $id_item_estructura
 * @property string $item
 * @property int $id_carrera
 * @property int $id_trayecto
 *
 * @property Estructuras[] $estructuras
 */
class Itemsestructuras extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'items_estructuras';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['item', 'id_carrera', 'id_trayecto'], 'required'],
            [['id_carrera', 'id_trayecto'], 'default', 'value' => null],
            [['id_carrera', 'id_trayecto'], 'integer'],
            [['item'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_item_estructura' => 'Id Item Estructura',
            'item' => 'Item',
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
        return $this->hasMany(Estructuras::className(), ['id_item_estructura' => 'id_item_estructura']);
    }
}

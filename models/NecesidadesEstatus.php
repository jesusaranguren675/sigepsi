<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "necesidades_estatus".
 *
 * @property int $id_estatus
 * @property string $estatus
 *
 * @property Necesidades[] $necesidades
 */
class NecesidadesEstatus extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'necesidades_estatus';
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
            [['estatus'], 'string'],
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
        ];
    }

    /**
     * Gets query for [[Necesidades]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNecesidades()
    {
        return $this->hasMany(Necesidades::className(), ['id_estatus' => 'id_estatus']);
    }
}

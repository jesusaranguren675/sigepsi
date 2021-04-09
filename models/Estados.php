<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "public.estados".
 *
 * @property string $estado
 * @property int $id_estado
 */
class Estados extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'public.estados';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['estado', 'id_estado'], 'required'],
            [['id_estado'], 'default', 'value' => null],
            [['id_estado'], 'integer'],
            [['estado'], 'string', 'max' => 50],
            [['id_estado'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'estado' => 'Estado',
            'id_estado' => 'Id Estado',
        ];
    }
}

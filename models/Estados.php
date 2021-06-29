<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "estados".
 *
 * @property string|null $estado
 * @property int|null $id_estado
 */
class Estados extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'estados';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_estado'], 'default', 'value' => null],
            [['id_estado'], 'integer'],
            [['estado'], 'string', 'max' => 30],
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

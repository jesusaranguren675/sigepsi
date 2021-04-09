<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "state".
 *
 * @property int $id_estate
 * @property string|null $state
 */
class State extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'state';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['state'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_estate' => 'Id Estate',
            'state' => 'State',
        ];
    }
}

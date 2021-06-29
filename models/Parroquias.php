<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "parroquias".
 *
 * @property int|null $id_municipio
 * @property string|null $parroquia
 * @property int|null $id_parroquia
 */
class Parroquias extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'parroquias';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_municipio', 'id_parroquia'], 'default', 'value' => null],
            [['id_municipio', 'id_parroquia'], 'integer'],
            [['parroquia'], 'string', 'max' => 38],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_municipio' => 'Id Municipio',
            'parroquia' => 'Parroquia',
            'id_parroquia' => 'Id Parroquia',
        ];
    }
}

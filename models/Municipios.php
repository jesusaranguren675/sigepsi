<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "municipios".
 *
 * @property int|null $id_estado
 * @property string|null $municipio
 * @property int|null $id_municipio
 */
class Municipios extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'municipios';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_estado', 'id_municipio'], 'default', 'value' => null],
            [['id_estado', 'id_municipio'], 'integer'],
            [['municipio'], 'string', 'max' => 33],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_estado' => 'Id Estado',
            'municipio' => 'Municipio',
            'id_municipio' => 'Id Municipio',
        ];
    }
}

<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "public.municipios".
 *
 * @property int $id_estado
 * @property string $municipio
 * @property int $id_municipio
 */
class Municipios extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'public.municipios';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_estado', 'municipio', 'id_municipio'], 'required'],
            [['id_estado', 'id_municipio'], 'default', 'value' => null],
            [['id_estado', 'id_municipio'], 'integer'],
            [['municipio'], 'string', 'max' => 50],
            [['id_municipio'], 'unique'],
            [['id_estado'], 'exist', 'skipOnError' => true, 'targetClass' => Estados::className(), 'targetAttribute' => ['id_estado' => 'id_estado']],
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

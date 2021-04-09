<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "public.parroquias".
 *
 * @property int $id_municipio
 * @property string $parroquia
 * @property int $id_parroquia
 */
class Parroquias extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'public.parroquias';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_municipio', 'parroquia', 'id_parroquia'], 'required'],
            [['id_municipio', 'id_parroquia'], 'default', 'value' => null],
            [['id_municipio', 'id_parroquia'], 'integer'],
            [['parroquia'], 'string', 'max' => 100],
            [['id_parroquia'], 'unique'],
            [['id_municipio'], 'exist', 'skipOnError' => true, 'targetClass' => Municipios::className(), 'targetAttribute' => ['id_municipio' => 'id_municipio']],
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

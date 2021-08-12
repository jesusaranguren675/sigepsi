<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "procedencias".
 *
 * @property int $id_procedencia
 * @property string $procedencia
 *
 * @property Carreras[] $carreras
 */
class Procedencias extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'procedencias';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['procedencia'], 'required'],
            [['procedencia'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_procedencia' => 'Id Procedencia',
            'procedencia' => 'Procedencia',
        ];
    }

    /**
     * Gets query for [[Carreras]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCarreras()
    {
        return $this->hasMany(Carreras::className(), ['id_procedencia' => 'id_procedencia']);
    }
}

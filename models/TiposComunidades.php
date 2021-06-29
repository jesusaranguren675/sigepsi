<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tipos_comunidades".
 *
 * @property int $id_tipo_comunidad
 * @property string $tipo_comunidad
 *
 * @property Comunidades[] $comunidades
 */
class TiposComunidades extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tipos_comunidades';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tipo_comunidad'], 'required'],
            [['tipo_comunidad'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_tipo_comunidad' => 'Id Tipo Comunidad',
            'tipo_comunidad' => 'Tipo Comunidad',
        ];
    }

    /**
     * Gets query for [[Comunidades]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComunidades()
    {
        return $this->hasMany(Comunidades::className(), ['id_tipo_comunidad' => 'id_tipo_comunidad']);
    }
}

<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "proyectos_motivos_rechazos".
 *
 * @property int $id_proyecto_motivo_rechazo
 * @property string $proyecto_motivo_rechazo
 *
 * @property ProyectosRechazos[] $proyectosRechazos
 */
class ProyectosMotivosRechazos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'proyectos_motivos_rechazos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['proyecto_motivo_rechazo'], 'required'],
            [['proyecto_motivo_rechazo'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_proyecto_motivo_rechazo' => 'Id Proyecto Motivo Rechazo',
            'proyecto_motivo_rechazo' => 'Proyecto Motivo Rechazo',
        ];
    }

    /**
     * Gets query for [[ProyectosRechazos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProyectosRechazos()
    {
        return $this->hasMany(ProyectosRechazos::className(), ['id_proyecto_motivo_rechazo' => 'id_proyecto_motivo_rechazo']);
    }
}

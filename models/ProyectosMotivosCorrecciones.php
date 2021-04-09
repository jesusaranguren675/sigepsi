<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "proyectos_motivos_correcciones".
 *
 * @property int $id_proyecto_motivo_correccion
 * @property string $proyecto_motivo_correccion
 * @property int $accion
 *
 * @property ProyectosCorrecciones[] $proyectosCorrecciones
 */
class ProyectosMotivosCorrecciones extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'proyectos_motivos_correcciones';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['proyecto_motivo_correccion', 'accion'], 'required'],
            [['proyecto_motivo_correccion'], 'string'],
            [['accion'], 'default', 'value' => null],
            [['accion'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_proyecto_motivo_correccion' => 'Id Proyecto Motivo Correccion',
            'proyecto_motivo_correccion' => 'Proyecto Motivo Correccion',
            'accion' => 'Accion',
        ];
    }

    /**
     * Gets query for [[ProyectosCorrecciones]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProyectosCorrecciones()
    {
        return $this->hasMany(ProyectosCorrecciones::className(), ['id_proyecto_motivo_correccion' => 'id_proyecto_motivo_correccion']);
    }
}

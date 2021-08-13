<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "lineas_investigacion".
 *
 * @property int $id_linea_investigacion
 * @property string $linea_investigacion
 * @property int|null $id_carrera
 *
 * @property BancoSituaciones[] $bancoSituaciones
 * @property Carreras $carrera
 * @property Proyectos[] $proyectos
 */
class Lineasinvestigacion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'lineas_investigacion';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['linea_investigacion'], 'required'],
            [['id_carrera'], 'default', 'value' => null],
            [['id_carrera'], 'integer'],
            [['linea_investigacion'], 'string', 'max' => 250],
            [['id_carrera'], 'exist', 'skipOnError' => true, 'targetClass' => Carreras::className(), 'targetAttribute' => ['id_carrera' => 'id_carrera']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_linea_investigacion' => 'Id Linea Investigacion',
            'linea_investigacion' => 'Linea Investigacion',
            'id_carrera' => 'Id Carrera',
        ];
    }

    /**
     * Gets query for [[BancoSituaciones]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBancoSituaciones()
    {
        return $this->hasMany(BancoSituaciones::className(), ['id_linea_investigacion' => 'id_linea_investigacion']);
    }

    /**
     * Gets query for [[Carrera]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCarrera()
    {
        return $this->hasOne(Carreras::className(), ['id_carrera' => 'id_carrera']);
    }

    /**
     * Gets query for [[Proyectos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProyectos()
    {
        return $this->hasMany(Proyectos::className(), ['id_linea_investigacion' => 'id_linea_investigacion']);
    }
}

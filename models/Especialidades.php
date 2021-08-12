<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "especialidades".
 *
 * @property int $id_especialidad
 * @property string $especialidad
 * @property bool $estatus
 *
 * @property AsesoresEspecialidades[] $asesoresEspecialidades
 * @property BancoSituaciones[] $bancoSituaciones
 * @property Carreras[] $carreras
 * @property CoordinadoresEspecialidades[] $coordinadoresEspecialidades
 * @property Proyectos[] $proyectos
 */
class Especialidades extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'especialidades';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['especialidad', 'estatus'], 'required'],
            [['estatus'], 'boolean'],
            [['especialidad'], 'string', 'max' => 250],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_especialidad' => 'Id Especialidad',
            'especialidad' => 'Especialidad',
            'estatus' => 'Estatus',
        ];
    }

    /**
     * Gets query for [[AsesoresEspecialidades]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAsesoresEspecialidades()
    {
        return $this->hasMany(AsesoresEspecialidades::className(), ['id_especialidad' => 'id_especialidad']);
    }

    /**
     * Gets query for [[BancoSituaciones]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBancoSituaciones()
    {
        return $this->hasMany(BancoSituaciones::className(), ['id_especialidad' => 'id_especialidad']);
    }

    /**
     * Gets query for [[Carreras]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCarreras()
    {
        return $this->hasMany(Carreras::className(), ['id_especialidad' => 'id_especialidad']);
    }

    /**
     * Gets query for [[CoordinadoresEspecialidades]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCoordinadoresEspecialidades()
    {
        return $this->hasMany(CoordinadoresEspecialidades::className(), ['id_especialidad' => 'id_especialidad']);
    }

    /**
     * Gets query for [[Proyectos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProyectos()
    {
        return $this->hasMany(Proyectos::className(), ['id_especialidad' => 'id_especialidad']);
    }
}

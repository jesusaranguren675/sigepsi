<?php

namespace app\models;

use yii\base\Model;

class BuscarProyectos extends Model
{
    public $fecha_inicio;
    public $fecha_fin;
    public $id_estado;
    public $id_estatus;
    public $id_especialidad;
    public $id_linea_investigacion;

    // public function rules()
    // {
    //     return [
    //         [['fecha_inicio', 'fecha_inicio'], 'required'],
    //         [['fecha_fin', 'fecha_fin'], 'required'],
    //         [['id_estado', 'id_estado'], 'required'],
    //         [['id_estatus', 'id_estatus'], 'required'],
    //         [['id_especialidad', 'id_especialidad'], 'required'],
    //         [['id_linea_investigacion', 'id_linea_investigacion'], 'required'],
    //     ];
    // }

    public function attributeLabels()
    {
        return [
            'fecha_inicio' => 'Fecha Inicio',
            'fecha_fin' => 'Fecha Fin',
            'id_estado' => 'Estado',
            'id_estatus' => 'Estatus',
            'id_especialidad' => 'Especialidad',
            'id_linea_investigacion' => 'Líneas de Investigación'
        ];
    }
}


?>
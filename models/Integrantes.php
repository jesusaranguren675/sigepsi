<?php
namespace app\models;

use yii\base\Model;

class Integrantes extends Model
{
    public $cedula_integrante;

    public function rules()
    {
         return [
            ["cedula_integrante", "match", "pattern" => "/^[0-9]+$/i", "message" => "Sólo se aceptan números"]
        ];
    }

    public function attributeLabels()
    {
        return [
            'cedula_integrante' => "Cédula del integrante:",
        ];
    }
}
?>
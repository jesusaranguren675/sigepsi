<?php

namespace app\models;

use yii\base\Model;
use yii\web\UploadedFile;

class UploadForm extends Model
{
    /**
     * @var UploadedFile
     */
    public $imageFile;

    public function rules()
    {
        return 
        [
           ['imageFile', 'imageFile', 
           'skipOnEmpty' => false,
           'uploadRequired' => 'No has seleccionado ningún archivo', //Error
           'maxSize' => 1024*1024*5, //5 MB
           'tooBig' => 'El tamaño máximo permitido es 5MB', //Error
           'minSize' => 10, //10 Bytes
           'tooSmall' => 'El tamaño mínimo permitido son 10 BYTES', //Error
           'extensions' => 'pdfc',
           'wrongExtension' => 'El archivo {file} no contiene una extensión permitida {extensions}', //Error
           'maxFiles' => 1,
           'tooMany' => 'El máximo de archivos permitidos son {limit}', //Error
            ],
        ]; 
    }
    
    public function upload()
    {
        if ($this->validate()) {
            $this->imageFile->saveAs('uploads/' . $this->imageFile->baseName . '.' . $this->imageFile->extension);
            return true;
        } else {
            return false;
        }
    }
}

?>
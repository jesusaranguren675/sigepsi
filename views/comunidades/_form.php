<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\assets\ComunidadesAsset;
ComunidadesAsset::register($this);

$tipos_comunidades = \app\models\TiposComunidades::find()->all();
$estados = \app\models\Estados::find()->all();
$municipios = \app\models\Municipios::find()->all();
$parroquias = \app\models\Parroquias::find()->all();
/* @var $this yii\web\View */
/* @var $model app\models\Comunidades */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="comunidades-form">

    <?php $form = ActiveForm::begin([
        //'enableClientValidation' => false,
        //'enableAjaxValidation' => false,
    ]); ?>
    <div class="row">
        <div class="col-sm-4">
            <?= $form->field($model, 'rif')->textInput(['maxlength' => true]) ?>
        </div>

        <div class="col-sm-4">
            <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>
        </div>

        <div class="col-sm-4">
            <?= $form->field($model, "id_tipo_comunidad")->dropDownList(
                             ArrayHelper::map($tipos_comunidades, 'id_tipo_comunidad', 'tipo_comunidad'),
                             ['prompt' => 'Seleccione']);?>         
        </div>
    </div>
    
    <div class="row">
        <div class="col-sm-4">
            <?= $form->field($model, 'telefono_contacto')->textInput() ?>
        </div>

        <div class="col-sm-4">
            <?= $form->field($model, 'persona_contacto')->textInput(['maxlength' => true]) ?>
        </div>

        <div class="col-sm-4">
            <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    
    <div class="row">
        <div class="col-sm-4">
            <?= $form->field($model, "id_estado")->dropDownList(
                             ArrayHelper::map($estados, 'id_estado', 'estado'),
                             ['prompt' => 'Seleccione']);?>
        </div>

        <div class="col-sm-4">
            <?= $form->field($model, "id_municipio")->dropDownList(
                             ArrayHelper::map($municipios, 'id_municipio', 'municipio'),
                             ['prompt' => 'Seleccione']);?>
        </div>

        <div class="col-sm-4">
            <?= $form->field($model, "id_parroquia")->dropDownList(
                             ArrayHelper::map($parroquias, 'id_parroquia', 'parroquia'),
                             ['prompt' => 'Seleccione']);?>
        </div>
    </div>
    
    <div class="row">
        <div class="col-sm-12">
            <?= $form->field($model, 'direccion')->textArea(['maxlength' => true]) ?>
        </div>
    </div>

    <!-- <?= $form->field($model, 'id_user')->textInput([]) ?>-->

    <!-- <?= $form->field($model, 'id_estatus')->textInput(['value' => 0]) ?> -->

    <div class="form-group">
        <button id="registrar_comunidad" class="btn btn-success"><i class="fas fa-save"></i> Guardar</button>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
$script = <<< JS
      
      $("#registrar_comunidad").click(function(event) {
            //document.querySelector(".preloader").setAttribute("style", "");
            event.preventDefault(); 
            

            var rif = document.getElementById("comunidades-rif").value;
            var nombre = document.getElementById("comunidades-nombre").value;
            var id_tipo_comunidad = document.getElementById("comunidades-id_tipo_comunidad").value;
            var telefono_contacto = document.getElementById("comunidades-telefono_contacto").value;
            var persona_contacto = document.getElementById("comunidades-persona_contacto").value;
            var email = document.getElementById("comunidades-email").value;
            var id_parroquia = document.getElementById("comunidades-id_parroquia").value;
            var direccion = document.getElementById("comunidades-direccion").value;
            
            var url = "sigepsi/web/index.php?r=comunidades/create";

            //Verificar validacion
            //---------------------
            
            if(rif == "" || nombre == "" || id_tipo_comunidad == "" || telefono_contacto == "" || persona_contacto == "" || email == "" || id_parroquia == "" || direccion == "")
            {
                Swal.fire(
                   'Completa los campos requeridos',
                   '',
                   'error'
                )

                return false;
            }
        
         $.ajax({
                url: url,
                type: 'post',
                dataType: 'json',
                data: {
                            rif                         : rif,
                            nombre                      : nombre,
                            id_tipo_comunidad           : id_tipo_comunidad,
                            telefono_contacto           : telefono_contacto,
                            persona_contacto            : persona_contacto,
                            email                       : email,
                            id_parroquia                : id_parroquia,
                            direccion                   : direccion,
                        
                }
            })
            .done(function(response) {

                if (response.data.success == true) 
                {
                    Swal.fire(
                    'Comunidad Registrada Exitosamente',
                    '<a href="http://localhost/sigepsi/web/index.php?r=comunidades/index">Visualizar comunidades registradas</a>',
                    'success'
                    )
                }
                else
                {
                   Swal.fire(
                   'Ocurrió un error al registrar la comunidad',
                   '<a href="http://localhost/sigepsi/web/index.php?r=comunidades/index">Enviar un email a soporte sigepsi</a>',
                   'error'
                   )
                }
             
            })
            .fail(function() {
                console.log("error");
            });
     });




JS;
$this->registerJs($script);
?>

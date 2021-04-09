<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
$Procedencias = \app\models\Procedencias::find()->all();
$Especialidad = \app\models\Especialidades::find()->all();

/* @var $this yii\web\View */
/* @var $model frontend\models\Estudiantes */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="estudiantes-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
    	<div class="col-sm-4">
    		<?= $form->field($model, 'cedula')->textInput() ?>
    	</div>

    	<div class="col-sm-4">
    		<?= $form->field($model, 'primer_nombre')->textInput() ?>
    	</div>

    	<div class="col-sm-4">
    		<?= $form->field($model, 'segundo_nombre')->textInput() ?>
    	</div>
    </div>

    <div class="row">
    	<div class="col-sm-4">
    		<?= $form->field($model, 'primer_apellido')->textInput() ?>
    	</div>

    	<div class="col-sm-4">
    		<?= $form->field($model, 'segundo_apellido')->textInput() ?>
    	</div>

    	<div class="col-sm-4">
    		<?= $form->field($model, "procedencia")->dropDownList(
                                               ArrayHelper::map($Procedencias, 'id_procedencia', 'procedencia'),
                                               ['prompt' => 'Seleccione']);?>
    	</div>
    </div>

    <div class="row">
    	<div class="col-sm-4">
    		<?= $form->field($model, "especialidad")->dropDownList(
                                               ArrayHelper::map($Especialidad, 'id_especialidad', 'especialidad'),
                                               ['prompt' => 'Seleccione']);?>
    	</div>

    	<div class="col-sm-4">
            <div class="form-group field-estudiantes-fecha_nac">
                <label class="control-label" for="estudiantes-fecha_nac">Fecha de Nacimiento</label>
                <input class="form-control" type="date" id="estudiantes-fecha_nac">
                <div class="help-block"></div>
            </div>
        </div>

        <div class="col-sm-4">
            <?= $form->field($model, 'telefono_celular')->textInput() ?>
        </div>
    </div>


    <div class="row">
        <div class="col-sm-4">
            <?= $form->field($model, 'telefono_local')->textInput() ?>
        </div>

        <div class="col-sm-4">
            <?= $form->field($model, 'username')->textInput() ?>
        </div>

        <div class="col-sm-4">
            <?= $form->field($model, 'email')->textInput() ?>
        </div>
    </div>

    <div class="row">
    	 <div class="col-sm-4">
            <?= $form->field($model, 'password')->passwordInput() ?>
        </div>

        <div class="col-sm-4">
            <?= $form->field($model, 'password_confirm')->passwordInput() ?>
        </div>
    </div>

    <div class="form-group">
        <button id="registrar_estudiante" class="btn btn-success">Guardar</button>
    </div>

    <?php ActiveForm::end(); ?>

</div>


<?php
$script = <<< JS
      
      //$("#estudiantes-fecha_nac").attr('readonly', "readonly");
      $("#registrar_estudiante").click(function(event) {
            document.querySelector(".preloader").setAttribute("style", "");
            event.preventDefault(); 
            

            var estudiantes_cedula = document.getElementById("estudiantes-cedula").value;
            var estudiantes_primer_nombre = document.getElementById("estudiantes-primer_nombre").value;
            var estudiantes_segundo_nombre = document.getElementById("estudiantes-segundo_nombre").value;
            var estudiantes_primer_apellido = document.getElementById("estudiantes-primer_apellido").value;
            var estudiantes_segundo_apellido = document.getElementById("estudiantes-segundo_apellido").value;
            var estudiantes_procedencia = document.getElementById("estudiantes-procedencia").value;
            var estudiantes_fecha_nac = document.getElementById("estudiantes-fecha_nac").value;
            var estudiantes_telefono_celular = document.getElementById("estudiantes-telefono_celular").value;
            var estudiante_telefono_local = document.getElementById("estudiantes-telefono_local").value;
            var estudiantes_username = document.getElementById("estudiantes-username").value;
            var estudiantes_email = document.getElementById("estudiantes-email").value;
            var estudiantes_password = document.getElementById("estudiantes-password").value;
            var estudiantes_password_confirm = document.getElementById("estudiantes-password_confirm").value;
            var estudiantes_especialidad = document.getElementById("estudiantes-especialidad").value;


            
            
             var url = "sigepsi/web/index.php?r=estudiantes/create";

             //Verificar validacion
             //---------------------
             var VerficarValidacion = [
                                         ValidateNumber('estudiantes-cedula'),
                                         ValidateInputText('estudiantes-primer_nombre'),
                                         ValidateInputText('estudiantes-segundo_nombre'),
                                         ValidateInputText('estudiantes-primer_apellido'),
                                         ValidateInputText('estudiantes-segundo_apellido'),
                                         ValidateInputText('estudiantes-procedencia'),
                                         ValidateDate('estudiantes-fecha_nac'),
                                         ValidateNumber('estudiantes-telefono_celular'),
                                         ValidateNumber('estudiantes-telefono_local'),
                                         ValidateInputText('estudiantes-username'),
                                         ValidateInputText('estudiantes-especialidad'),
                                     ];

             for (ver = 0; ver < VerficarValidacion.length; ver++) {
                     if(VerficarValidacion[ver] === false)
                     {
                         document.querySelector(".preloader").style.display = 'none';
                         event.preventDefault();  //stopping submitting
                         return false;
                     }
                     else
                     {

                     }
             }

             if(estudiantes_password != estudiantes_password_confirm)
             {
                document.querySelector(".preloader").style.display = 'none';
                AlertSigepsi("Las contraseñas no coinciden", "¡Intenta nuevamente!", "fas fa-times-circle", "warning");
                document.getElementById("estudiantes-password").style.border = "solid 1px red";
                document.getElementById("estudiantes-password_confirm").style.border = "solid 1px red";
                return false;
             }
             else
             {
                document.getElementById("estudiantes-password").style.border = "solid 1px #68ea17";
                document.getElementById("estudiantes-password_confirm").style.border = "solid 1px #68ea17";
             }



             //Fin Verificar validacion
             //---------------------
         $.ajax({
                url: url,
                type: 'post',
                dataType: 'json',
                data: {
                        	estudiantes_cedula			  	: estudiantes_cedula,
							estudiantes_primer_nombre	  	: estudiantes_primer_nombre,
							estudiantes_segundo_nombre	  	: estudiantes_segundo_nombre,
							estudiantes_primer_apellido	  	: estudiantes_primer_apellido,
							estudiantes_segundo_apellido  	: estudiantes_segundo_apellido,
							estudiantes_procedencia		  	: estudiantes_procedencia,
							estudiantes_fecha_nac		  	: estudiantes_fecha_nac,
							estudiantes_telefono_celular  	: estudiantes_telefono_celular,
							estudiante_telefono_local	  	: estudiante_telefono_local,
							estudiantes_username		  	: estudiantes_username,
							estudiantes_email			  	: estudiantes_email,
							estudiantes_password		  	: estudiantes_password,
							estudiantes_especialidad	  	: estudiantes_especialidad,
                        
                }
            })
            .done(function(response) {

                if (response.data.success == true) 
                {

                    document.querySelector(".preloader").style.display = 'none';
                    AlertSigepsi("Estudiante registrado exitosamente", "<a class='btn btn-primary' href='/sigepsi/web/index.php?r=estudiantes'>Para visualizar los estudiantes clickea aquí</a>", "fas fa-check", "success");
                  
                }
                else
                {
                   if(response.data.message == "Usuario duplicado.")
                   {
                    document.querySelector(".preloader").style.display = 'none';
                     AlertSigepsi("El estudiante ya existe", "¡Intenta nuevamente!", "fas fa-user-times", "warning");

                     return false;
                   }
                   
                }
             
            })
            .fail(function() {
                console.log("error");
                document.querySelector(".preloader").style.display = 'none';
                  AlertSigepsi("No se pudo registrar el estudiante", "¡Intenta nuevamente!", "fas fa-times-circle", "warning");  
            });
     });




JS;
$this->registerJs($script);
?>
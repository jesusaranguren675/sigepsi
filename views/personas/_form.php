<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
$Especialidades = \app\models\Especialidades::find()->all();
/* @var $this yii\web\View */
/* @var $model app\models\Personas */
/* @var $form yii\widgets\ActiveForm */
?>
<?= $this->render('../proyectos/alertsigepsi') ?>
<?= $this->render('../proyectos/alertconfirmation') ?>
<div class="personas-form">

    <?php $form = ActiveForm::begin(['enableClientValidation'=> false]); ?>

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

        <div class="col-sm-4">
            <?= $form->field($model, 'primer_apellido')->textInput() ?>
        </div>

        <div class="col-sm-4">
            <?= $form->field($model, 'segundo_apellido')->textInput() ?>
        </div>

        <div class="col-sm-4">
            <?= $form->field($model, 'fecha_nac')->widget(\yii\jui\DatePicker::className(), [
                        // if you are using bootstrap, the following line will set the correct style of the input field
                        'dateFormat' => 'yyyy-MM-dd',
                        'options' => ['class' => 'form-control'],
                        // ... you can configure more DatePicker properties here
                        ]) ?>   
        </div>

        <div class="col-sm-4">
            <?= $form->field($model, 'telefono_celular')->textInput() ?>
        </div>

        <div class="col-sm-4">
            <?= $form->field($model, 'telefono_local')->textInput() ?>
        </div>

        <div class="col-sm-4">
            <?= $form->field($model, 'username')->textInput() ?>
        </div>

        <div class="col-sm-4">
            <?= $form->field($model, 'email')->textInput() ?>
        </div>

        <div class="col-sm-4">
            <?= $form->field($model, 'password')->passwordInput() ?>
        </div>

        <div class="col-sm-4">
            <?= $form->field($model, 'password_confirm')->passwordInput() ?>
        </div>

        <div class="col-sm-4">
            <label for="perfil">Perfil</label>
            <select class="form-control" name="" id="perfil">
                <option selected="" value>Seleccione</option>
                <option value="profesor">Profesor</option>
                <option value="coordinador">Coordinador</option>
                <option value="director">Director</option>
                <option value="administrador">Administrador</option>
            </select>
        </div>

        <div class="col-sm-4">
             <?= $form->field($model, "id_especialidad")->dropDownList(
                                               ArrayHelper::map($Especialidades, 'id_especialidad', 'especialidad'),
                                               ['prompt' => 'Seleccione']);?>
        </div>
    </div>

    <div class="form-group">
        <button class="btn btn-success updateuser" type="button" id="registrar-persona">Guardar</button>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
$script = <<< JS

      
      $("#personas-fecha_nac").attr('readonly', "readonly");
      $(".updateuser").click(function(event) {
            document.querySelector(".preloader").setAttribute("style", "");
            event.preventDefault(); 

            var personas_cedula = document.getElementById("personas-cedula").value;
            var personas_primer_nombre = document.getElementById("personas-primer_nombre").value;
            var personas_segundo_nombre = document.getElementById("personas-segundo_nombre").value;
            var personas_primer_apellido = document.getElementById("personas-primer_apellido").value;
            var personas_segundo_apellido = document.getElementById("personas-segundo_apellido").value;
            var personas_fecha_nac = document.getElementById("personas-fecha_nac").value;
            var personas_telefono_celular = document.getElementById("personas-telefono_celular").value;
            var personas_telefono_local = document.getElementById("personas-telefono_local").value;
            var personas_username = document.getElementById("personas-username").value;
            var personas_email = document.getElementById("personas-email").value;
            var personas_password = document.getElementById("personas-password").value;
            var personas_password_confirm = document.getElementById("personas-password_confirm").value;
            var perfil = document.getElementById("perfil").value;
            var personas_id_especialidad = document.getElementById("personas-id_especialidad").value;


            
            
             var url = "sigepsi/web/index.php?r=personas/create";

             //Verificar validacion
             //---------------------
             var VerficarValidacion = [
                                         ValidateNumber('personas-cedula'),
                                         ValidateInputText('personas-primer_nombre'),
                                         //ValidateInputText('personas-segundo_nombre'),
                                         ValidateInputText('personas-primer_apellido'),
                                         //ValidateInputText('personas-segundo_apellido'),
                                         ValidateDate('personas-fecha_nac'),
                                         ValidateNumber('personas-telefono_celular'),
                                         ValidateNumber('personas-telefono_local'),
                                         ValidateInputText('personas-username'),
                                         ValidateInputText('perfil'),
                                         ValidateInputText('personas-id_especialidad'),
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

             if(personas_password != personas_password_confirm)
             {
                document.querySelector(".preloader").style.display = 'none';
                AlertSigepsi("Las contraseñas no coinciden", "¡Intenta nuevamente!", "fas fa-times-circle", "warning");
                document.getElementById("personas-password").style.border = "solid 1px red";
                document.getElementById("personas-password_confirm").style.border = "solid 1px red";
                return false;
             }
             else
             {
                document.getElementById("personas-password").style.border = "solid 1px #68ea17";
                document.getElementById("personas-password_confirm").style.border = "solid 1px #68ea17";
             }



             //Fin Verificar validacion
             //---------------------
         $.ajax({
                url: url,
                type: 'post',
                dataType: 'json',
                data: {
                        personas_cedula                 :    personas_cedula,       
                        personas_primer_nombre          :    personas_primer_nombre,
                        personas_segundo_nombre         :    personas_segundo_nombre,
                        personas_primer_apellido        :    personas_primer_apellido,          
                        personas_segundo_apellido       :    personas_segundo_apellido,  
                        personas_fecha_nac              :    personas_fecha_nac,
                        personas_telefono_celular       :    personas_telefono_celular,
                        personas_telefono_local         :    personas_telefono_local,
                        personas_username               :    personas_username,
                        personas_email                  :    personas_email,
                        personas_password               :    personas_password,
                        perfil                          :    perfil,
                        personas_id_especialidad        :    personas_id_especialidad,
                        
                }
            })
            .done(function(response) {

                if (response.data.success == true) 
                {

                   if(response.data.message == "Usuario registrado exitosamente.")
                   {
                     document.querySelector(".preloader").style.display = 'none';
                     AlertSigepsi("Usuario registrado exitosamente", "<a class='btn btn-primary' href='/sigepsi/web/index.php?r=personas%2Findex&page=1'>Para visualizar los usuarios internos clickea aquí</a>", "fas fa-check", "success");
                   }
                
                }
                else
                {
                   if(response.data.message == "Usuario duplicado.")
                   {
                     document.querySelector(".preloader").style.display = 'none';
                     AlertSigepsi("El usuario ya existe", "¡Intenta registrar otro usuario!", "fas fa-user-times", "warning");

                     return false;
                   }
                   
                }
             
            })
            .fail(function() {
                console.log("error");
                  document.querySelector(".preloader").style.display = 'none';
                  AlertSigepsi("No se pudo registrar el usuario", "¡Intenta nuevamente!", "fas fa-times-circle", "warning");  
            });
     });




JS;
$this->registerJs($script);
?>
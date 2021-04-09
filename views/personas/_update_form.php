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
<div class="personas-form">

    <?php $form = ActiveForm::begin(['enableClientValidation'=> false]); ?>

    <div class="row">
        <div class="col-sm-4">
            <input id="id_persona" type="hidden" value="<?= $model->id_persona?>">
            <input id="id_usuario" type="hidden" value="<?= $model->id_usuario?>">
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
        <button class="btn btn-success updateuser" type="button" id="update-persona">Guardar</button>
    </div>

    <?php ActiveForm::end(); ?>

</div>


<?php
$script = <<< JS
    document.querySelector(".field-personas-password").style.display = 'none';
    document.querySelector(".field-personas-password_confirm").style.display = 'none';
    $("#update-persona").click(function(event) {
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
           var perfil = document.getElementById("perfil").value;
           var personas_id_especialidad = document.getElementById("personas-id_especialidad").value;
           var id_persona = document.getElementById("id_persona").value;
           var id_usuario = document.getElementById("id_usuario").value;

      
           
            var url = "sigepsi/web/index.php?r=personas/updateuser";

             //Verificar validacion
             //---------------------
             var VerficarValidacion = [
                                         ValidateNumber('personas-cedula'),
                                         ValidateInputText('personas-primer_nombre'),
                                         ValidateInputText('personas-segundo_nombre'),
                                         ValidateInputText('personas-primer_apellido'),
                                         ValidateInputText('personas-segundo_apellido'),
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



            $.ajax({
                url: url,
                type: 'post',
                dataType: 'json',
                data: { 
                            id_persona                      : id_persona,
                            personas_cedula                 : personas_cedula,
                            personas_primer_nombre          : personas_primer_nombre,
                            personas_segundo_nombre         : personas_segundo_nombre,
                            personas_primer_apellido        : personas_primer_apellido,
                            personas_segundo_apellido       : personas_segundo_apellido,
                            personas_fecha_nac              : personas_fecha_nac,
                            personas_telefono_celular       : personas_telefono_celular,
                            personas_telefono_local         : personas_telefono_local,
                            personas_username               : personas_username,
                            personas_email                  : personas_email,
                            perfil                          : perfil,
                            personas_id_especialidad        : personas_id_especialidad,
                            id_usuario                      : id_usuario,
                }
            })
            .done(function(response) {

                if (response.data.success == true) 
                {
                    if(response.data.message == "Usuario editado exitosamente.")
                    {
                        document.querySelector(".preloader").style.display = 'none';
                        AlertSigepsi("Usuario editado exitosamente", "¡Se ha editado un usuario!", "fas fa-user-check", "success");
                    }
                    else
                    {
                        document.querySelector(".preloader").style.display = 'none';
                        AlertSigepsi("Ocurrió un error al editar el usuario", "¡Intenta nuevamente!", "fas fa-user-times", "warning");
                    }

                }
         
            })
            .fail(function() {
                console.log("error");
                document.querySelector(".preloader").style.display = 'none';
                AlertSigepsi("Ocurrió un error al editar el usuario", "¡Intenta nuevamente!", "fas fa-user-times", "warning");   
            });
    });

      


JS;
$this->registerJs($script);
?>

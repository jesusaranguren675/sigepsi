<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Backenduser */
/* @var $form yii\widgets\ActiveForm */
?>
<?= $this->render('/proyectos/alertsigepsi') ?>

<div class="backenduser-form">

    <?php $form = ActiveForm::begin(['enableClientValidation'=> false]); ?>

    <div class="row">
        <div class="col-sm-4">
            <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
        </div>

       <!--  <?= $form->field($model, 'auth_key')->textInput(['maxlength' => true]) ?> -->

        <div class="col-sm-4">
            <?= $form->field($model, 'password_hash')->passwordInput(['maxlength' => true]) ?>
        </div>

       <!--  <?= $form->field($model, 'password_reset_token')->textInput(['maxlength' => true]) ?> -->

        <div class="col-sm-4">
            <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
        </div>

        <!-- <?= $form->field($model, 'status')->textInput() ?> -->

        <!-- <?= $form->field($model, 'created_at')->textInput() ?> -->

        <!-- <?= $form->field($model, 'updated_at')->textInput() ?> -->

        <!-- <?= $form->field($model, 'verification_token')->textInput(['maxlength' => true]) ?> -->
    </div>

    <div class="form-group">
        <button id="registrar-usuario" class="btn btn-success" type="submit">Guardar</button>
    </div>

    <?php ActiveForm::end(); ?>

</div>


<?php
$script = <<< JS

    $("#registrar-usuario").click(function(event) {
            
           event.preventDefault(); 
           document.querySelector(".preloader").setAttribute("style", "");

           var username = document.getElementById("backenduser-username").value;
           var password = document.getElementById("backenduser-password_hash").value;
           var email = document.getElementById("backenduser-email").value;
         
            var url = "sigepsi/web/index.php?r=backenduser/create";

            //Verificar validacion
            //---------------------
            var VerficarValidacion = [
                                       
                                        ValidateInputText('backenduser-username'),
                                        ValidateInputText('backenduser-password_hash'),
                                        ValidateInputText('backenduser-email'),
                                    ];

            for (ver = 0; ver < VerficarValidacion.length; ver++) {
                    if(VerficarValidacion[ver] === false)
                    {
                        document.querySelector(".preloader").style.display = 'none';
                        event.preventDefault(); // stopping submitting
                        return false;
                    }
                    else
                    {

                    }
            }
            //Fin Verificar validacion
            //---------------------



            $.ajax({
                url: url,
                type: 'post',
                dataType: 'json',
                data: {
                        username                    :    username,       
                        password                    :    password,
                        email                       :    email,
                }
            })
            .done(function(response) {

                if (response.data.success == true) 
                {
                    if(response.data.usuario != false)
                    {
                        document.querySelector(".preloader").style.display = "none";
                        AlertSigepsi("Usuario registrado exitosamente", "Se ha enviado una notfificación a tu correo electrónico", "fas fa-user-check", "success");
                    }
                    else
                    {
                        AlertSigepsi("Ocurrió un error al registrar el usuario", "¡Intenta nuevamente!", "fas fa-user-times", "warning");
                    }

                }
                else if(response.data.message == "Usuario duplicado.")
                {
                    document.querySelector(".preloader").style.display = "none";
                    AlertSigepsi("El usuario ya existe en la base de datos", "¡Intenta nuevamente!", "fas fa-user-times", "warning");
                }
             
            })
            .fail(function() {
                console.log("error");
                document.querySelector(".preloader").style.display = "none";   
            });
    });

      


JS;
$this->registerJs($script);
?>


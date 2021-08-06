<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\BackendUser */
/* @var $form yii\widgets\ActiveForm */
?>

<!-- Cintillo -->
<div class="cintillo">
    <?php echo Html::img('@web/imagenes/cintillo.svg'); ?>
</div>
<!-- Fin Cintillo -->

<!-- Migas de pan -->
<nav style="--bs-breadcrumb-divider: '';" aria-label="breadcrumb">
    <ol class="breadcrumb alert alert-warning">
        <li class="breadcrumb-item"><a href="<?= Url::toRoute('backenduser/index')?>">Usuarios </a></li>

        <li class="breadcrumb-item active" aria-current="page">Listado de Usuarios</li>
    </ol>
</nav>
<!-- Fin Migas de Pan -->


<div class="backend-user-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
        </div>

        <div class="col-sm-6">
            <?= $form->field($model, 'password_hash')->passwordInput(['maxlength' => true, 'value' => '']) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
        </div>

        <div class="col-sm-6">
            <?php $estatus = [1 => 'Activo', 2 => 'Inactivo']; ?>

            <?= $form->field($model, 'status')->dropDownList($estatus, ['prompt' => 'Seleccione' ]); ?>
        </div>
    </div>

    

    <?php // $form->field($model, 'auth_key')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <button id="registrar_usuario" class="btn btn-success"><i class="fas fa-save"></i> Guardar</button>
    </div>

    <?php ActiveForm::end(); ?>

</div>


<?php
$script = <<< JS
      
      //Registrar Comunidad
      //-------------------

      $("#registrar_usuario").click(function(event) {

            //document.querySelector(".preloader").setAttribute("style", "");
            event.preventDefault(); 
            

            var username = document.getElementById("backenduser-username").value;
            var password_hash = document.getElementById("backenduser-password_hash").value;
            var email = document.getElementById("backenduser-email").value;
            var status = document.getElementById("backenduser-status").value;


            //Contiene la ruta del controlador que procesara los datos enviados mediante el formulario
            //Debemos tomar en cuenta que esta ruta la obtenemos del atributo action que corresponde al formulario
            //-----------------------------------------------------------------------------------------

            var url = document.getElementById("w0").getAttribute("action");

            //Verificar validacion
            //---------------------
            
            if(username == "" || password_hash == "" || email == "" || status == "")
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
                            username         : username,
                            password_hash    : password_hash,
                            email            : email,
                            status           : status,
                        
                }
            })
            .done(function(response) {

                if (response.data.success == true) 
                {
                    Swal.fire(
                    response.data.message,
                    '<a href="http://localhost/sigepsi/web/index.php?r=comunidades%2Fview&id='+response.data.id+'">Visualizar el registro modificado</a>',
                    'success'
                    )
                }
                else
                {
                   Swal.fire(
                   response.data.message,
                   '<a href="http://localhost/sigepsi/web/index.php?r=comunidades/index">Enviar un email a soporte sigepsi</a>',
                   'error'
                   )
                }
             
            })
            .fail(function() {
                console.log("error");
            });
     });

     //Fin registrar comunidad
     //-----------------------
JS;
$this->registerJs($script);
?>

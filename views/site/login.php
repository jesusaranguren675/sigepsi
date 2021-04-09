<?php

use yii\helpers\Html;
use yii\helpers\Url;
use app\assets\LoginAsset;
use yii\bootstrap\ActiveForm;
LoginAsset::register($this);

?>

<div class="contenedor">
    <div class="blue">

    </div>
    <div class="white">

        <footer class="py-4 bg-light mt-auto">
            <div class="container-fluid">
                <div class="info-footer">
                    <h6>Universidad Politécnica Territorial de Caracas "Mariscal Sucre"</h6>
                    <p>Sistema de Gestión de Proyectos Socio-integradores</p>
                </div>
            </div>
        </footer>
    </div>
    <div class="fixed">
        <div class="menu">
            <div class="logo">
                <div class="img-logo">
                    <?php echo Html::img('@web/imagenes/logo-iutoms2.png', ['width' => '15%']); ?>
                    <strong>SIGEPSI</strong>
                </div>
                <div class="siglas">

                </div>
            </div>
            <div class="opciones">
                <a href="<?= Url::toRoute('site/index');?>" class="btn btn-light"><i class="fa fa-home"></i> Inicio</a>
                <a href="#" class="btn btn-light"><i class="fas fa-book"></i> Biblioteca Digital</a>
                <a href="#" class="btn btn-success" style="color: #fff;"><i class="fas fa-sign-in-alt"></i> Iniciar Sesión</a>
            </div>
        </div>
        <div class="contenedor-form">
            <div class="title-form">
                <h4>Ingresa sus datos para iniciar sesión</h4>
            </div>
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                <?= $form->field($model, 'username')->textInput(['autofocus' => false]) ?>

                <?= $form->field($model, 'password')->passwordInput() ?>

                <?= Html::submitButton('Entrar', ['class' => 'btn btn-primary btn-login', 'name' => 'login-button']) ?>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>

<script type="text/javascript">
    //Se encarga de agregar el label a los input del login
    //----------------------------------------------------
    var username = document.querySelector("form .field-loginform-username label");

    username.innerHTML = "";
    username.style.color = 'rgba(0,0,0,.7)';

    document.querySelector("form .field-loginform-username input").setAttribute("placeholder", "Usuario...");

    document.querySelector("form .field-loginform-username p").style.display = "none";

    document.querySelector(".form-group").style.margin = "0px";

    var password = document.querySelector("form .field-loginform-password label");

     document.querySelector("form .field-loginform-password input").setAttribute("placeholder", "Contraseña...");


    password.innerHTML = "";
    password.style.color = 'rgba(0,0,0,.7)';

    document.querySelector(".form-group").style.margin = "0px";

    document.querySelector(".field-loginform-password").style.margin = "0px";
</script>
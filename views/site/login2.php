<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Inicio de sesión';
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
    .breadcrumb {
        display: none;
    }
</style>

<div class="row" style="display: flex; justify-content: center; align-items: center;">
	<div class="col-sm-6 site-login">
		<div class="title-icon">
			<i class="far fa-user-circle"></i>
			<h3 class="title-login">Iniciar Sesión</h3>
			<p class="subtitle-login alert alert-primary">
				Para ingresar al sistema se debe utilizar el usuario y contraseña asignados en el Sistema Integrado de Admisión y Control de Estudios de la UPTCMS (SIACE).
				Si tiene algún inconveniente con respecto al sistema puede plantear su problemática a través de la dirección de correo electrónico soporte.sigepsi@gmail.com
			</p><br>
		</div>
		<div class="row cont-inputs">
			<div class="col-lg-10">
				<?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

				<?= $form->field($model, 'username')->textInput(['autofocus' => false]) ?>

				<?= $form->field($model, 'password')->passwordInput() ?>

				<?= $form->field($model, 'rememberMe')->checkbox() ?>

				<div class="info-secondary" style="color:#999;margin:1em 0">
					¿Olvidaste tu contraseña? <?= Html::a('Recuperar', ['site/request-password-reset']) ?>.
					<br>
					¿Necesitas un nuevo correo electrónico de verificación? <?= Html::a('Reenviar', ['site/resend-verification-email']) ?>
				</div>

				<div class="form-group btn-sesion">
					<?= Html::submitButton('Inciar Sesión', ['class' => 'btn btn-info', 'name' => 'login-button']) ?>
				</div>

				<?php ActiveForm::end(); ?>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
    var username = document.querySelector(".site-login .cont-inputs .col-lg-10 form .field-loginform-username label");

    username.innerHTML = "Usuario";
    username.style.color = 'rgba(0,0,0,.7)';

    var password = document.querySelector(".site-login .cont-inputs .col-lg-10 form .field-loginform-password label");

    password.innerHTML = "Contraseña";
    password.style.color = 'rgba(0,0,0,.7)';

</script>

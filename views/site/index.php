<?php
use yii\helpers\Html;
use yii\helpers\Url;
/* @var $this yii\web\View */

$this->title = 'My Yii Application';
use app\assets\InicioAsset;
InicioAsset::register($this);
?>
<?php if (Yii::$app->session->hasFlash('success')): ?>
    
<?php endif; ?>

<div class="contenedor">
	<div class="blue">
		
	</div>
	<div class="white">
		
	</div>
	<div class="fixed">
		<header>
			<div class="menu">
				<div class="logo">
					<div class="img-logo">
						<?php echo Html::img('@web/imagenes/logo-iutoms2.png', ['width' => '15%']); ?>
						<strong><a href="<?= Url::toRoute('site/index');?>"></a>SIGEPSI</strong>
					</div>
					<div class="siglas">

					</div>
				</div>
				<div class="opciones">
					<a href="<?= Url::toRoute('site/index');?>" class="btn btn-success" style="color: #fff;"><i class="fas fa-home"></i> Inicio</a>
					<a href="<?= Url::toRoute('site/biblioteca');?>" class="btn btn-light"><i class="fas fa-book"></i> Biblioteca Digital</a>
					<a href="<?= Url::toRoute('site/login');?>" class="btn btn-light"><i class="fas fa-sign-in-alt"></i> Iniciar Sesión</a>
				</div>
			</div>
		</header>
		<div class="principal">
			<h2>
				<strong>Sistema de Gestión de Proyectos Socio-integradores de la Universidad Politécnica Territorial de Caracas "Mariscal Sucre".</strong>
			</h2>
			<p>
				La implementación de este sistema tiene como objetivo el control y seguimiento de los proyectos socio-integradores realizados en la UPTCMS. A su vez nos permitirá como institución tener un historial o banco de proyectos ejecutados.
			</p>
		</div>

		<div class="" style="display: flex; justify-content: center;">
			<div class="col-sm-4" style="display: flex; justify-content: center; ">
				<div class="card" style="box-shadow: 0 2px 2px 0 rgb(0 0 0 / 14%), 0 1px 5px 0 rgb(0 0 0 / 12%), 0 3px 1px -2px rgb(0 0 0 / 20%);">
					<div class="card-body" style="    display: flex !important;
					flex-direction: column !important;
					justify-content: center !important;
					align-items: center !important; background: #eeeeee;">
					<h5 class="card-title"><p class="alert alert-warning">Ingresar al sistema</p></h5>
					<p class="card-text">Para ingresar al sistema se debe utilizar el usuario y contraseña asignados en el Sistema Integrado de Admisión y Control de Estudios de la UPTCMS (SIACE).</p>
					<a style="color: rgba(0,0,0,.7);" href="<?= Url::toRoute('site/login');?>" class="btn btn-warning">Ingresar <i class="fas fa-sign-in-alt"></i></a>
					</div>
				</div>
			</div>
			<div class="col-sm-4" style="display: flex; justify-content: center;">
				<div class="card" style="box-shadow: 0 2px 2px 0 rgb(0 0 0 / 14%), 0 1px 5px 0 rgb(0 0 0 / 12%), 0 3px 1px -2px rgb(0 0 0 / 20%);">
					<div class="card-body" style="    display: flex !important;
					flex-direction: column !important;
					justify-content: center !important;
					align-items: center !important; background: #eeeeee;">
					<h5 class="card-title"><p class="alert alert-warning">Soporte sigepsi</h5>
						<p class="card-text"> Si tiene algún inconveniente con respecto al sistema puede plantear su problemática a través de la dirección de correo electrónico soporte.sigepsi@gmail.com</p>
						<a style="color: rgba(0,0,0,.7);" href="#" class="btn btn-warning">Crear solicitud <i class="fas fa-envelope"></i></a>
					</div>
				</div>
			</div>
		</div>

		<footer style="background: #eeeeee;" class="py-4 bg-light mt-auto">
			<div class="container-fluid">
				<div class="info-footer">
					<h6>Universidad Politécnica Territorial de Caracas "Mariscal Sucre"</h6>
					<p>Sistema de Gestión de Proyectos Socio-integradores</p>
				</div>
			</div>
		</footer>

	</div>
</div>
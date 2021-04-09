<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
?>

<style>
	form {
		display: flex;
	    justify-content: center;
	    align-items: center;
	    flex-direction: column;
	}

	.field-formupload-file {
		text-align: center;
	    display: flex;
	    justify-content: center;
	    align-items: center;
	    flex-direction: column;
	}
</style>

<div class="conten-crud">
	<div class="cintillo">
      <?php echo Html::img('@web/imagenes/cintillo.jpg'); ?>
  	</div>

  	<ol style="display: block;" class="breadcrumb">
  		<li><a href="<?= Url::to(['proyectos/admin']); ?>">Inicio</a></li>
  		<li><a href="#">subir propuesta</a></li>
  	</ol>

	<h5 style="text-align: center;" class="title-crud alert alert-primary">Subir Propuesta Para Proyecto: <?= $model->titulo ?></h5>

	<div>
		

		<?php $form = ActiveForm::begin([
			"method" => "post",
			"enableClientValidation" => true,
			"options" => ["enctype" => "multipart/form-data"],
		]);
		?>
		<?= $msg ?>
		<?= $form->field($modelUpload, "file[]")->fileInput(['multiple' => true]) ?>

		<i class="far fa-file-pdf" style="font-size: 70px; color: red;"></i><br>
		<h5>La propuesta de proyecto debe subirse en formato PDF</h5>


		<?= Html::submitButton("Subir propuesta", ["class" => "btn btn-success"]) ?>

		<?php $form->end() ?>

	</div>
</div>
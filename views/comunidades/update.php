<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Comunidades */

$this->title = 'Update Comunidades: ' . $model->id_comunidad;
$this->params['breadcrumbs'][] = ['label' => 'Comunidades', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_comunidad, 'url' => ['view', 'id' => $model->id_comunidad]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="comunidades-update">

	<!-- Cintillo -->
	<div class="cintillo">
		<?php echo Html::img('@web/imagenes/cintillo.svg'); ?>
	</div>
	<!-- Fin Cintillo -->

	<!-- Migas de pan -->
	<nav style="--bs-breadcrumb-divider: '';" aria-label="breadcrumb">
		<ol class="breadcrumb alert alert-warning">
			<li class="breadcrumb-item"><a href="<?= Url::toRoute('comunidades/index')?>">Comunidades </a></li>

			<li class="breadcrumb-item active" aria-current="page">Modificar Comunidad</li>
		</ol>
	</nav>
	<!-- Fin Migas de Pan -->

	<h3 class="title-dashboard">Modificar Comunidad</h3>

    <h1><!-- <?= Html::encode($this->title) ?> --></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Estructuras */

$this->title = 'Create Estructuras';
$this->params['breadcrumbs'][] = ['label' => 'Estructuras', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="estructuras-create">

	<!-- Cintillo -->
	<div class="cintillo">
		<?php echo Html::img('@web/imagenes/cintillo.svg'); ?>
	</div>
	<!-- Fin Cintillo -->

	<!-- Migas de pan -->
	<nav style="--bs-breadcrumb-divider: '';" aria-label="breadcrumb">
		<ol class="breadcrumb alert alert-warning">
			<li class="breadcrumb-item"><a href="<?= Url::toRoute('estructuras/index')?>">Estructuras </a></li>
			<li class="breadcrumb-item active" aria-current="page">Registrar Estructura</li>
		</ol>
	</nav>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

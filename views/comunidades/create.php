<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Comunidades */

$this->title = 'REGISTRAR COMUNIDADES';
$this->params['breadcrumbs'][] = ['label' => 'Comunidades', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comunidades-create">
	<div class="cintillo">
		<?php echo Html::img('@web/imagenes/cintillo.svg'); ?>
	</div>
	<nav style="--bs-breadcrumb-divider: '';" aria-label="breadcrumb">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="<?= Url::toRoute('comunidades/index')?>">Comunidades</a></li>
			<li class="breadcrumb-item active" aria-current="page">Registrar Comunidades</li>
		</ol>
	</nav>
	<h4 class="title-dashboard"><?= Html::encode($this->title) ?></h4>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

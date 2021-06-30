<?php

use yii\helpers\Html;

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
	<h3 class="title-dashboard"><?= Html::encode($this->title) ?></h3>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

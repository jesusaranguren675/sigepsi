<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Personas */

$this->title = 'Create Personas';
$this->params['breadcrumbs'][] = ['label' => 'Personas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="personas-create conten-crud">
	<div class="col-sm-12 cintillo-presentacion">
        <?php echo Html::img('@web/imagenes/cintillo.jpg'); ?>
    </div>

    <ol style="display: block;" class="breadcrumb">
    	<li><a href="<?= Url::to(['personas/index']); ?>">Inicio</a></li>
    	<li><a href="#">registrar usuario interno</a></li>
    </ol>

    <h1 style="margin-bottom: 0px;" class="title-crud">Registrar Usuarios Internos</h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

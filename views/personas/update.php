<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Personas */

$this->title = 'Update Personas: ' . $model->id_persona;
$this->params['breadcrumbs'][] = ['label' => 'Personas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_persona, 'url' => ['view', 'id' => $model->id_persona]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="personas-update conten-crud">
	<div class="cintillo">
        <?php echo Html::img('@web/imagenes/cintillo.jpg'); ?>
    </div>

    <ol style="display: block;" class="breadcrumb">
    	<li><a href="<?= Url::to(['personas/index']); ?>">Inicio</a></li>
    	<li><a href="#">modificar usuarios internos</a></li>
    </ol>

    <h1 style="margin-bottom: 0px;" class="title-crud">Modificar Usuarios Internos</h1>

    <?= $this->render('_update_form', [
        'model' => $model,
    ]) ?>

</div>




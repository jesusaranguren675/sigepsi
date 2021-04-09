<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\AuthAssignment */

$this->title = 'Crear Asignación de Rol';
$this->params['breadcrumbs'][] = ['label' => 'Assignación de Roles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="auth-assignment-create conten-crud">
	<div class="cintillo">
        <?php echo Html::img('@web/imagenes/cintillo.jpg'); ?>
    </div>

    <ol style="display: block;" class="breadcrumb">
    	<li><a href="<?= Url::to(['authassignment/index']); ?>">Inicio</a></li>
    	<li><a href="#">crear asignación de rol</a></li>
    </ol>


    <h1 class="title-crud"><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

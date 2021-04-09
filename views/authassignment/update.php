<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\AuthAssignment */

$this->title = 'Modificar Asignación de Rol: ' . $model->item_name;
$this->params['breadcrumbs'][] = ['label' => 'Asignación de Roles', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->item_name, 'url' => ['view', 'item_name' => $model->item_name, 'user_id' => $model->user_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="auth-assignment-update conten-crud">
	<div class="cintillo">
        <?php echo Html::img('@web/imagenes/cintillo.jpg'); ?>
    </div>

    <ol style="display: block;" class="breadcrumb">
        <li><a href="<?= Url::to(['authassignment/index']); ?>">Inicio</a></li>
        <li><a href="#">modificar asignación de roles</a></li>
    </ol>

    <h1 class="title-crud">Modificar asignación de roles</h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

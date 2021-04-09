<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\AuthAssignment */

$this->title = $model->item_name;
$this->params['breadcrumbs'][] = ['label' => 'Asignación de Roles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="auth-assignment-view conten-crud">
    <div class="cintillo">
        <?php echo Html::img('@web/imagenes/cintillo.jpg'); ?>
    </div>

    <ol style="display: block;" class="breadcrumb">
        <li><a href="<?= Url::to(['authassignment/index']); ?>">Inicio</a></li>
        <li><a href="#">consultar asignación de roles</a></li>
    </ol>

    <h1 class="title-crud">Consultar asignación de roles</h1>

    <?php foreach ($roles as $roles): ?>
        <div class="row">
            <div class="col-sm-2"><p class="alert alert-primary">Permiso</p></div>
            <div class="col-sm-10"><p style="background: #fff;"class="alert alert-info"><?= $roles['item_name'] ?></p></div>
        </div>
        <div class="row">
            <div class="col-sm-2"><p class="alert alert-primary">Usuario</p></div>
            <div class="col-sm-10"><p style="background: #fff;"class="alert alert-info"><?= $roles['username'] ?></p></div>
        </div>
    <?php endforeach; ?>

</div>

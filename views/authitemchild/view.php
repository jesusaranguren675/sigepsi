<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\AuthItemChild */

$this->title = $model->parent;
$this->params['breadcrumbs'][] = ['label' => 'Asignar Permisos a Role', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="auth-item-child-view conten-crud">
    <div class="cintillo">
        <?php echo Html::img('@web/imagenes/cintillo.jpg'); ?>
    </div>

    <ol style="display: block;" class="breadcrumb">
        <li><a href="<?= Url::to(['authitemchild/index']); ?>">Inicio</a></li>
        <li><a href="#">consultar asignación de permisos</a></li>
    </ol>

    <h1 class="title-crud">Consultar asignación de permisos</h1>

    <?php foreach ($roles as $roles): ?>
        <div class="row">
            <div class="col-sm-2"><p class="alert alert-primary">Rol</p></div>
            <div class="col-sm-10"><p style="background: #fff;"class="alert alert-info"><?= $roles['parent'] ?></p></div>
        </div>
        <div class="row">
            <div class="col-sm-2"><p class="alert alert-primary">Permiso</p></div>
            <div class="col-sm-10"><p style="background: #fff;"class="alert alert-info"><?= $roles['child'] ?></p></div>
        </div>
    <?php endforeach; ?>

</div>

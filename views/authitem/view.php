<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\AuthItem */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Permisos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="auth-item-view conten-crud">
    <div class="cintillo">
        <?php echo Html::img('@web/imagenes/cintillo.jpg'); ?>
    </div>

    <ol style="display: block;" class="breadcrumb">
        <li><a href="<?= Url::to(['authitem/index']); ?>">Inicio</a></li>
        <li><a href="#">consultar permisos</a></li>
    </ol>


    <h1 class="title-crud">Consultar permisos</h1>

<?php foreach ($roles as $roles): ?>
        <div class="row">
            <div class="col-sm-2"><p class="alert alert-primary">Nombre del permiso</p></div>
            <div class="col-sm-10"><p style="background: #fff;"class="alert alert-info"><?= $roles['name'] ?></p></div>
        </div>
        <div class="row">
            <div class="col-sm-2"><p class="alert alert-primary">Tipo</p></div>
            <div class="col-sm-10"><p style="background: #fff;"class="alert alert-info"><?= $roles['description'] ?></p></div>
        </div>
    <?php endforeach; ?>

</div>

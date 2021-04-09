<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model app\models\Backenduser */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Backendusers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="backenduser-view conten-crud">
    <div class="cintillo">
        <?php echo Html::img('@web/imagenes/cintillo.jpg'); ?>
    </div>

    <ol style="display: block;" class="breadcrumb">
        <li><a href="<?= Url::to(['backenduser/index']); ?>">Inicio</a></li>
        <li><a href="#">consultar usuarios</a></li>
    </ol>

    <h1 class="title-crud">Consultar usuarios</h1>

    <div class="row">
        <div class="col-sm-2"><p class="alert alert-primary">ID. Usuario</p></div>
        <div class="col-sm-10"><p style="background: #fff;"class="alert alert-info"><?= $model->username ?></p></div>
    </div>


    <div class="row">
        <div class="col-sm-2"><p class="alert alert-primary">Usuario</p></div>
        <div class="col-sm-10"><p style="background: #fff;"class="alert alert-info"><?= $model->username ?></p></div>
    </div>

    <div class="row">
        <div class="col-sm-2"><p class="alert alert-primary">Correo</p></div>
        <div class="col-sm-10"><p style="background: #fff;"class="alert alert-info"><?= $model->email ?></p></div>
    </div>

</div>

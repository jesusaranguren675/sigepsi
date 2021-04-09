<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model frontend\models\Estudiantes */

$this->params['breadcrumbs'][] = ['label' => 'Estudiantes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="estudiantes-view conten-crud">
     <div class="cintillo">
        <?php echo Html::img('@web/imagenes/cintillo.jpg'); ?>
    </div>

    <ol style="display: block;" class="breadcrumb">
        <li><a href="<?= Url::to(['estudiantes/index']); ?>">Inicio </a></li>
        <li><a href="#">consultar estudiantes</a></li>
    </ol>

    <h1 class="title-crud">Consultar Estudiantes</h1>

    <?php //var_dump($estudiante); die(); ?>



        <?php foreach ($estudiante as $estudiante): ?>
        <div class="row">
            <div class="col-sm-2"><p class="alert alert-primary">ID. Estudiante</p></div>
            <div class="col-sm-10"><p style="background: #fff;"class="alert alert-info"><?= $estudiante['id_persona'] ?></p></div>
        </div>
        <div class="row">
            <div class="col-sm-2"><p class="alert alert-primary">Cédula</p></div>
            <div class="col-sm-10"><p style="background: #fff;"class="alert alert-info"><?= $estudiante['cedula'] ?></p></div>
        </div>
        <div class="row">
            <div class="col-sm-2"><p class="alert alert-primary">Nombres</p></div>
            <div class="col-sm-10"><p style="background: #fff;"class="alert alert-info"><?= $estudiante['primer_nombre'] ?> <?= $estudiante['primer_apellido'] ?></p></div>
        </div>
        <div class="row">
            <div class="col-sm-2"><p class="alert alert-primary">Apellidos</p></div>
            <div class="col-sm-10"><p style="background: #fff;"class="alert alert-info"><?= $estudiante['primer_apellido'] ?> <?= $estudiante['segundo_apellido'] ?></p></div>
        </div>
        <div class="row">
            <div class="col-sm-2"><p class="alert alert-primary">Especialidad</p></div>
            <div class="col-sm-10"><p style="background: #fff;"class="alert alert-info"><?= $estudiante['carrera'] ?></p></div>
        </div>
        <?php endforeach; ?>


</div>

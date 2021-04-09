<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Personas */

$this->params['breadcrumbs'][] = ['label' => 'Personas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="personas-view conten-crud">
    <div class="col-sm-12 cintillo-presentacion">
        <?php echo Html::img('@web/imagenes/cintillo.jpg'); ?>
    </div>

    <ol style="display: block;" class="breadcrumb">
        <li><a href="<?= Url::to(['personas/index']); ?>">Inicio</a></li>
        <li><a href="#">consular usuarios internos</a></li>
    </ol>

    <h1 class="title-crud">Consultar Usuarios Internos</h1>

    <?php foreach ($persona as $persona): ?>
    <div class="row">
        <div class="col-sm-2">
            <p class="alert alert-primary">ID. Persona</p>
        </div>
        <div class="col-sm-10">
            <p style="background: #fff;"class="alert alert-info"><?= $persona['id_persona'] ?></p>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-2">
            <p class="alert alert-primary">Cédula</p>
        </div>
        <div class="col-sm-10">
            <p style="background: #fff;"class="alert alert-info"><?= $persona['cedula'] ?></p>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-2">
            <p class="alert alert-primary">Nombres y Apellidos</p>
        </div>
        <div class="col-sm-10">
            <p style="background: #fff;"class="alert alert-info"><?= $persona['primer_nombre'] ?> <?= $persona['segundo_nombre'] ?> <?= $persona['primer_apellido'] ?> <?= $persona['segundo_apellido'] ?></p>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-2">
            <p class="alert alert-primary">Fecha de Nacimiento</p>
        </div>
        <div class="col-sm-10">
            <p style="background: #fff;"class="alert alert-info"><?= $persona['fecha_nac'] ?></p>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-2">
            <p class="alert alert-primary">Teléfono Celular</p>
        </div>
        <div class="col-sm-10">
            <p style="background: #fff;"class="alert alert-info"><?= $persona['telefono_celular'] ?></p>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-2">
            <p class="alert alert-primary">Teléfono Local</p>
        </div>
        <div class="col-sm-10">
            <p style="background: #fff;"class="alert alert-info"><?= $persona['telefono_local'] ?></p>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-2">
            <p class="alert alert-primary">Usuario</p>
        </div>
        <div class="col-sm-10">
            <p style="background: #fff;"class="alert alert-info"><?= $persona['username'] ?></p>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-2">
            <p class="alert alert-primary">Correo</p>
        </div>
        <div class="col-sm-10">
            <p style="background: #fff;"class="alert alert-info"><?= $persona['email'] ?></p>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-2">
            <p class="alert alert-primary">Perfil</p>
        </div>
        <div class="col-sm-10">
            <p style="background: #fff;"class="alert alert-info">
                <button class="btn btn-primary btn-sm"><?= $persona['item_name'] ?></button>
            </p>
        </div>
    </div>
    <?php endforeach; ?>
</div>

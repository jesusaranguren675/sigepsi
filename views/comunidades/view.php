<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Comunidades */

$this->title = $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Comunidades', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="comunidades-view">

    <!-- Cintillo -->
    <div class="cintillo">
        <?php echo Html::img('@web/imagenes/cintillo.svg'); ?>
    </div>
    <!-- Fin Cintillo -->

    <!-- Migas de pan -->
    <nav style="--bs-breadcrumb-divider: '';" aria-label="breadcrumb">
        <ol class="breadcrumb alert alert-warning">
            <li class="breadcrumb-item"><a href="<?= Url::toRoute('comunidades/index')?>">Comunidades </a></li>

            <li class="breadcrumb-item active" aria-current="page">Listado de Comunidades</li>
        </ol>
    </nav>
    <!-- Fin Migas de Pan -->

    <a class="btn btn-success btn-sm" href="<?= Url::toRoute(['comunidades/update', 'id' => $model->id_comunidad]); ?>">
        Modificar <i class="fas fa-edit"></i>
    </a>

    <h3 class="title-dashboard">Listado de Comunidades</h3>
    <h6><!-- <?= Html::encode($this->title) ?>--></h6>

    <p>
        <?php // Html::a('Delete', ['delete', 'id' => $model->id_comunidad], [
            //'class' => 'btn btn-danger',
            //'data' => [
                //'confirm' => 'Are you sure you want to delete this item?',
                //'method' => 'post',
            //],
       // ]) ?>
    </p>

    <div class="row">
        <div class="col-sm-12">
            <ul class="list-group list-group-flush">
                <?php foreach ($comunidades as $comunidades): ?>
                    <li class="list-group-item active"><strong class="">Nombre:</strong> <?= $comunidades['nombre'] ?></li>
                    <li class="list-group-item"><strong class="">Id Comunidad:</strong> <?= $comunidades['id_comunidad'] ?></li>
                    <li class="list-group-item"><strong class="">RIF:</strong> <?= $comunidades['rif'] ?></li>
                    <li class="list-group-item"><strong class="">Tipo de comunidad:</strong> <?= $comunidades['tipo_comunidad'] ?></li>
                    <li class="list-group-item"><strong class="">Teléfono de Contacto:</strong> <?= $comunidades['telefono_contacto'] ?></li>
                    <li class="list-group-item"><strong class="">Persona Contacto:</strong> <?= $comunidades['persona_contacto'] ?></li>
                    <li class="list-group-item"><strong class="">Correo:</strong> <?= $comunidades['email'] ?></li>
                    <li class="list-group-item"><strong class="">Dirección:</strong> <?= $comunidades['direccion'] ?></li>
                    <li class="list-group-item">
                        <strong class="">Dirección:</strong>
                        <?php

                        if($comunidades['id_estatus'] == 1)
                        {
                            ?>
                            <button class="btn btn-success btn-sm">Activa</button>
                            <?php
                        }
                        else
                        {
                            ?>
                            <button class="btn btn-danger btn-sm">Inactiva</button>
                            <?php
                        }

                        ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>

    <?php //DetailView::widget([
        //'model' => $model,
        //'attributes' => [
            //'id_comunidad',
            //'rif',
            //'nombre',
            //'id_tipo_comunidad',
            //'telefono_contacto',
            //'persona_contacto',
            //'email:email',
            //'id_parroquia',
            //'direccion',
            //'id_user',
            //'id_estatus',
        //],
    //]) ?>

</div>

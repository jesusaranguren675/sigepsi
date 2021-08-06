<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\BackendUser */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Backend Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="backend-user-view">

    <!-- Cintillo -->
    <div class="cintillo">
        <?php echo Html::img('@web/imagenes/cintillo.svg'); ?>
    </div>
    <!-- Fin Cintillo -->

    <!-- Migas de pan -->
    <nav style="--bs-breadcrumb-divider: '';" aria-label="breadcrumb">
        <ol class="breadcrumb alert alert-warning">
            <li class="breadcrumb-item"><a href="<?= Url::toRoute('backenduser/index')?>">Usuarios </a></li>

            <li class="breadcrumb-item active" aria-current="page">Listado de Usuarios</li>
        </ol>
    </nav>
    <!-- Fin Migas de Pan -->

    <a class="btn btn-success btn-sm" href="<?= Url::toRoute(['backenduser/update', 'id' => $model->id]); ?>">
        Modificar <i class="fas fa-edit"></i>
    </a>
    <br><br>

    <div class="row">
        <div class="col-sm-12">
            <ul class="list-group list-group-flush">
                <?php foreach ($usuarios as $usuarios): ?>
                    <li class="list-group-item active"><strong class="">Usuario:</strong> <?= $usuarios['username'] ?></li>
                    <li class="list-group-item"><strong class="">Id Usuario:</strong> <?= $usuarios['id'] ?></li>
                    <li class="list-group-item"><strong class="">Correo:</strong> <?= $usuarios['email'] ?></li>
                    <li class="list-group-item">
                        <strong class="">Estatus:</strong>
                        <?php

                        if($usuarios['status'] == 1)
                        {
                            ?>
                            <button class="btn btn-success btn-sm">Activo</button>
                            <?php
                        }
                        else
                        {
                            ?>
                            <button class="btn btn-danger btn-sm">Inactivo</button>
                            <?php
                        }

                        ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>

</div>

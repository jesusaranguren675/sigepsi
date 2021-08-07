<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use app\assets\DatatableAsset;
DatatableAsset::register($this);

/* @var $this yii\web\View */
/* @var $searchModel app\models\ComunidadesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'COMUNIDADES';
$this->params['breadcrumbs'][] = $this->title;
?>

<!-- Cintillo -->
<div class="cintillo">
    <?php echo Html::img('@web/imagenes/cintillo.svg'); ?>
</div>
<!-- Fin Cintillo -->

<!-- Migas de pan -->
<nav style="--bs-breadcrumb-divider: '';" aria-label="breadcrumb">
    <ol class="breadcrumb alert alert-warning">
        <li class="breadcrumb-item"><a href="<?= Url::toRoute('comunidades/index')?>">Comunidades / </a></li>
    </ol>
</nav>
<!-- Fin Migas de Pan -->

<h4 class="title-dashboard"><?= Html::encode($this->title) ?></h4>


<div class="comunidades-index">

    <p>
        <a href="<?= Url::toRoute('comunidades/create')?>" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Crear</a>
        <!-- <button class="btn btn-primary btn-sm" type="button" data-toggle="collapse" data-target="#collapseSearch" aria-expanded="false" aria-controls="collapseSearch">
        <i class="fas fa-search"></i> Buscar
        </button> -->

        <a class="btn btn-danger btn-sm" href="<?= Url::toRoute(['comunidades/pdf']); ?>"><i class="fas fa-file-pdf"></i> pdf</a>
        <button class="btn btn-success btn-sm"><i class="fas fa-file-excel"></i> excel</button>
    </p>

    <div class="collapse" id="collapseSearch">
        <div class="alert alert-danger" role="alert">
            Rellena los siguientes campos para crear un <strong>filtro de datos.</strong>
        </div>
        <div class="card card-body">
            <?php //echo $this->render('_search', ['model' => $searchModel]); ?>
        </div><br>
    </div>

    <main>
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Id Comunidad</th>
                        <th>Nombre</th>
                        <th>RIF</th>
                        <th>Tipo de Comunidad</th>
                        <th>Teléfono de Contacto</th>
                        <th>Estatus</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($comunidades as $comunidades): ?>
                        <tr>
                            <td><?= $comunidades['id_comunidad'] ?></td>
                            <td><?= $comunidades['nombre'] ?></td>
                            <td><?= $comunidades['rif'] ?></td>
                            <td> <?= $comunidades['tipo_comunidad'] ?></td>
                            <td> <a href="tel:+58<?= $comunidades['telefono_contacto'] ?>"><i class="fas fa-phone"></i> <?= $comunidades['telefono_contacto'] ?></a></td>
                            <td>
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
                            </td>
                            <td>
                                <a href="<?= Url::to(['comunidades/view', 'id' => $comunidades['id_comunidad']]); ?>" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i></a>
                                <a href="<?= Url::to(['comunidades/update', 'id' => $comunidades['id_comunidad']]); ?>" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>   
                </tbody>
            </table>
        </div>
    </main>


     <?php // GridView::widget([
        //'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        //'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            //'id_comunidad',
            //'rif',
            //'nombre',
            //'tipo_comunidad',
            //'telefono_contacto',
            //'persona_contacto',
            //'email:email',
            //'id_parroquia',
            //'direccion',
            //'id_user',
            //'id_estatus',

            //['class' => 'yii\grid\ActionColumn'],
        //],
    //]); ?>


   

</div>

<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use app\assets\DatatableAsset;
DatatableAsset::register($this);

/* @var $this yii\web\View */
/* @var $searchModel app\models\BackenduserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Backend Users';
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


<div class="backend-user-index">

    <p>
        <a href="<?= Url::toRoute('backenduser/create')?>" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Crear</a>
        <!-- <button class="btn btn-primary btn-sm" type="button" data-toggle="collapse" data-target="#collapseSearch" aria-expanded="false" aria-controls="collapseSearch">
        <i class="fas fa-search"></i> Buscar
        </button> -->

        <button class="btn btn-danger btn-sm"><i class="fas fa-file-pdf"></i> pdf</button>
        <button class="btn btn-success btn-sm"><i class="fas fa-file-excel"></i> excel</button>
    </p>


    <main>
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Id Usuario</th>
                        <th>Usuario</th>
                        <th>Correo</th>
                        <th>Estatus</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($usuarios as $usuarios): ?>
                        <tr>
                            <td><?= $usuarios['id'] ?></td>
                            <td><?= $usuarios['username'] ?></td>
                            <td><?= $usuarios['email'] ?></td>
                            <td>
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
                            </td>
                            <td>
                                <a href="<?= Url::to(['backenduser/view', 'id' => $usuarios['id']]); ?>" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i></a>
                                <a href="<?= Url::to(['backenduser/update', 'id' => $usuarios['id']]); ?>" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>   
                </tbody>
            </table>
        </div>
    </main>


    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php //GridView::widget([
        //'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        //'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            //'id',
            //'username',
            //'auth_key',
            //'password_hash',
            //'email:email',
            //'status',

            //['class' => 'yii\grid\ActionColumn'],
       // ],
    //]); ?>


</div>

<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
  use yii\helpers\Url;
  use yii\widgets\LinkPager;
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\EstudiantesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Administrar Estudiantes';
$this->params['breadcrumbs'][] = $this->title;
?>

<br><br><br>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <h1 class="mt-4">Estudiantes</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="<?= Url::toRoute('site/dashboard')?>">Dashboard</a></li>
                <li class="breadcrumb-item active">Tables</li>
            </ol>
            <div class="card mb-4">
                <div class="card-header">
                    <?php echo Html::img('@web/imagenes/cintillo.jpg'); ?>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>ID. Estudiante</th>
                                    <th>Cédula</th>
                                    <th>Nombres</th>
                                    <th>Apellidos</th>
                                    <th>Especialidad</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>ID. Estudiante</th>
                                    <th>Cédula</th>
                                    <th>Nombres</th>
                                    <th>Apellidos</th>
                                    <th>Especialidad</th>
                                    <th>Acción</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <?php foreach ($estudiantes as $estudiantes): ?>
                                    <tr>
                                        <td><?= $estudiantes['id_persona'] ?></td>
                                        <td><?= $estudiantes['cedula'] ?></td>
                                        <td><?= $estudiantes['primer_nombre'] ?> <?= $estudiantes['segundo_nombre'] ?></td>
                                        <td> <?= $estudiantes['primer_apellido'] ?> <?= $estudiantes['segundo_apellido'] ?></td>
                                        <td><?= $estudiantes['carrera'] ?></td>
                                        <td style="text-align: center;"><a class="btn btn-primary" href="<?= Url::to(['estudiantes/view', 'id' => $estudiantes['id_persona']]); ?>"><i class="fas fa-search"></i></a></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <footer class="py-4 bg-light mt-auto">
        <div class="container-fluid">
            <div class="d-flex align-items-center justify-content-between small">
                <div class="text-muted">Copyright &copy; Your Website 2020</div>
                <div>
                    <a href="#">Privacy Policy</a>
                    &middot;
                    <a href="#">Terms &amp; Conditions</a>
                </div>
            </div>
        </div>
    </footer>
</div>

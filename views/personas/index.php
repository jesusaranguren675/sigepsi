<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\Pjax;
use yii\widgets\LinkPager;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PersonasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Personas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="personas-index conten-crud">
    <div class="col-sm-12 cintillo-presentacion">
        <?php echo Html::img('@web/imagenes/cintillo.jpg'); ?>
    </div>

    <ol style="display: block;" class="breadcrumb">
        <li ><a href="<?= Url::to(['backenduser/index']); ?>">Inicio</a></li>
        <li><a href="#">usuarios internos</a></li>
    </ol>

    <h1 class="title-crud">Administrar Usuarios Internos</h1>

    <p>
        <a class="btn btn-success" href="<?= Url::toRoute("personas/create") ?>">Agregar Usuario Interno</a>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

     <?php Pjax::begin(); ?>
    <table id="table_reportes" class="table table-bordered table-hover table-striped table_reportes">
        <tr id="encabezado">
            <th class="alert alert-info">ID. Persona</th>
            <th class="alert alert-info">Cédula</th>
            <th class="alert alert-info">Nombre Completo</th>
            <th class="alert alert-info">Usuario</th>
            <th class="alert alert-info">Perfil</th>
            <th class="alert alert-info" style="text-align: center;">Acción</th>
        </tr>
        <?php foreach ($personas as $personas): ?>
        <tr>
            <td><?= $personas['id_persona'] ?></td>
            <td><?= $personas['cedula'] ?></td>
            <td><?= $personas['primer_nombre'] ?> <?= $personas['segundo_nombre'] ?> <?= $personas['primer_apellido'] ?> <?= $personas['segundo_apellido'] ?></td>
            <td><?= $personas['username'] ?></td>
            <td>
                <button style="width: 90%;" class="btn btn-primary btn-sm">
                    <?= $personas['item_name'] ?>        
                </button>
            </td>
            <td style="text-align: center;">
                <div class="btn-group">
                <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-cogs"></i>
                </button>
              <div class="dropdown-menu">
                <a class="dropdown-item dropdown2" href="<?= Url::to(['personas/view', 'id' => $personas['id_persona']]) ?>">
                  <i class="fas fa-eye"></i> Ver
                </a>
                <a class="dropdown-item dropdown2" href="<?= Url::to(['personas/update', 'id' => $personas['id_persona']]) ?>">
                    <i class="fas fa-edit"></i> 
                    Modificar
                </a>
              </div>
            </div>
        </tr>
        <?php endforeach; ?>
    </table>
    <?php Pjax::end(); ?>
    <?= LinkPager::widget(['pagination' => $pagination]) ?>
    <?php
    if(empty($personas['id_persona']))
    {
        ?>
        <p style="text-align: center; font-size: 80px;"><i class="fas fa-user-alt-slash"></i></p>
        <h3 style="text-align: center;">No Hay Usuarios Registrados</h3>
        <h4 style="text-align: center; padding-bottom: 50px;">¡Intenta Agregar un Nuevo Usuario!</h4>
        <script>
            document.getElementById("encabezado").style.display = 'none';
        </script>
        <?php
    }
    ?>

</div>

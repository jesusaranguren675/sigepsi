<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\widgets\LinkPager;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel app\models\BackenduserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Backendusers';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="backenduser-index conten-crud">
    <div class="cintillo">
        <?php echo Html::img('@web/imagenes/cintillo.jpg'); ?>
    </div>

    <ol style="display: block;" class="breadcrumb">
        <li><a href="<?= Url::to(['backenduser/index']); ?>">Inicio</a></li>
        <li><a href="#">panel</a></li>
    </ol>

    <h1 class="title-crud">Administrar Usuarios</h1>

    <p>
        <a class="btn btn-success" href="<?= Url::to(['backenduser/create']); ?>"><i class="fas fa-plus"></i> Crear usuario</a>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>



    <?php Pjax::begin(); ?>
    <table class="table table-bordered table-striped table-hover">
        <tr>
            <th class="alert alert-info">Usuario</th>
            <th class="alert alert-info">Correo</th>
            <!--<th class="alert alert-info" style="text-align: center;">Estatus</th>-->
            <th class="alert alert-info" style="text-align: center;">Acción</th>
        </tr>
        <?php foreach ($user as $user): ?>
        <tr>
            <td><?= $user['username'] ?></td>
            <td><?= $user['email'] ?></td>
            <!--<td style="text-align: center;">
                <?php
                if($user['status'] == 0)
                {
                    ?>
                    <button class="btn btn-danger btn-sm">Cuenta Sin Activar</button>
                    <?php
                }
                else
                {
                     ?>
                    <button class="btn btn-success btn-sm">Cuenta Activada</button>
                    <?php
                }
                ?>
            </td>-->
            <td style="text-align: center;">
                <div class="btn-group">
                    <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-cogs"></i>
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item dropdown2" href="<?= Url::to(['backenduser/view', 'id' => $user['id']]); ?>">
                          <i class="fas fa-eye"></i> Ver
                      </a>
                      <a class="dropdown-item dropdown2" href="<?= Url::to(['backenduser/update', 'id' => $user['id']]); ?>">
                        <i class="fas fa-edit"></i> 
                        Modificar
                    </a>
                </div>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    <?php Pjax::end(); ?>
    <?= LinkPager::widget(['pagination' => $pagination]) ?>
    <?php
    if(empty($user['id']))
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



<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\widgets\LinkPager;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AuthassignmentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Asignación de Roles';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="auth-assignment-index conten-crud">
    <div class="cintillo">
        <?php echo Html::img('@web/imagenes/cintillo.jpg'); ?>
    </div>

    <ol style="display: block;" class="breadcrumb">
        <li><a href="<?= Url::to(['authassignment/index']); ?>">Inicio</a></li>
        <li><a href="#">panel</a></li>
    </ol>

    <h1 class="title-crud"><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Crear Asignación de Rol', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php Pjax::begin(); ?>
    <table id="table_reportes" class="table table-bordered table-hover table-striped table_reportes">
        <tr id="encabezado">
            <th class="alert alert-info">N°</th>
            <th class="alert alert-info">Nombre del permiso</th>
            <th class="alert alert-info">Usuario</th>
            <th style="text-align: center;" class="alert alert-info">Acción</th>
        </tr>
        <?php
        $contador = 1;
        foreach ($roles as $roles)
        {
            ?>
            <tr>
                <td><?= $contador ?></td>
                <td><?= $roles['item_name'] ?></td>
                <td><?= $roles['username'] ?></td>
                <td style="text-align: center;">
                    <div class="btn-group">
                        <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-cogs"></i>
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item dropdown2" href="index.php?r=authassignment/view&item_name=<?=$roles['item_name']?>&user_id=<?=$roles['user_id']?>">
                              <i class="fas fa-eye"></i> Ver
                          </a>
                          <a class="dropdown-item dropdown2" href="index.php?r=authassignment/update&item_name=<?=$roles['item_name']?>&user_id=<?=$roles['user_id']?>">
                            <i class="fas fa-edit"></i> 
                            Modificar
                        </a>
                    </div>
                </td>
            </tr>
            <?php
            $contador ++;
        }

        ?>


    </table>
    <?php Pjax::end(); ?>
    <?= LinkPager::widget(['pagination' => $pagination]) ?>
    <?php
    if(empty($roles['user_id']))
    {
        ?>
        <p style="text-align: center; font-size: 80px;"><i class="fas fa-user-alt-slash"></i></p>
        <h3 style="text-align: center;">No Hay Estudiantes Registrados</h3>
        <h4 style="text-align: center; padding-bottom: 50px;">¡Intenta Agregar un Nuevo Estudiante!</h4>
        <script>
            document.getElementById("encabezado").style.display = 'none';
        </script>
        <?php
    }
    ?>



</div>

<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
use yii\widgets\LinkPager;
/* @var $this yii\web\View */
/* @var $searchModel app\models\AuthitemchildSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Asignar Permisos a Roles';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="auth-item-child-index conten-crud">
    <div class="cintillo">
        <?php echo Html::img('@web/imagenes/cintillo.jpg'); ?>
    </div>

    <ol style="display: block;" class="breadcrumb">
        <li><a href="<?= Url::to(['authitemchild/index']); ?>">Inicio</a></li>
        <li><a href="#">panel</a></li>
    </ol>


    <h1 class="title-crud"><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Crear asignación de permiso', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

        <?php Pjax::begin(); ?>
        <table id="table_reportes" class="table table-bordered table-hover table-striped table_reportes">
            <tr id="encabezado">
                <th class="alert alert-info">Rol</th>
                <th class="alert alert-info">Permiso</th>
                <th style="text-align: center;" class="alert alert-info">Acción</th>
            </tr>
            <?php foreach ($roles as $roles): ?>
                <tr>
                    <td><?= $roles['parent'] ?></td>
                    <td><?= $roles['child'] ?></td>
                    <td style="text-align: center;">
     
                        <div class="btn-group">
                            <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-cogs"></i>
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item dropdown2" href="index.php?r=authitemchild/view&parent=<?=$roles['parent']?>&child=<?=$roles['child']?>">
                                  <i class="fas fa-eye"></i> Ver
                              </a>
                              <a class="dropdown-item dropdown2" href="index.php?r=authitemchild/update&parent=<?=$roles['parent']?>&child=<?=$roles['child']?>">
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
        if(empty($roles['parent']))
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

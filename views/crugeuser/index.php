<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\Pjax;
use yii\widgets\LinkPager;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\CrugeUserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Administrar Usuarios';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cruge-user-index conten-crud table-responsive">
    <div class="cintillo">
        <?php echo Html::img('@web/imagenes/cintillo.jpg'); ?>
    </div>
    <h1 class="title-crud"><?= Html::encode($this->title) ?></h1>

    
    <p>
        <a class="btn btn-success btn-sigepsi" href="<?= Url::toRoute("crugeuser/create") ?>"><i class="fas fa-plus"></i>  Crear usuario</a>
    </p>

     <?php Pjax::begin(); ?>
    <table id="table_reportes" class="table table-bordered table-hover table-striped table_reportes">
        <tr>
            <th>ID. usuario</th>
            <th>Usuario</th>
            <th>Correo</th>
            <th>Estado</th>
            <th style="text-align: center;">Acción</th>
        </tr>
        <?php foreach ($crugeuser as $crugeuser): ?>
        <tr>
            <td><?= $crugeuser['iduser'] ?></td>
            <td><?= $crugeuser['username'] ?></td>
            <td><?= $crugeuser['email'] ?></td>
            
            <?php
            if($crugeuser['state'] == 1)
            {
                echo "<td style='background:#daedd2;'>";
                    echo "Cuenta Activada";
                echo "</td>";
            }
            else
            {
                echo "<td style='background:#f1dada;'>";
                    echo "Cuenta sin Activar";
                echo "</td>";
            }
            ?>
            <td style="text-align: center;"><a href="<?= Url::to(['crugeuser/update', 'id' => $crugeuser['iduser']]); ?>"><i class="fas fa-user-edit"></i></a></td>
        </tr>
        <?php endforeach; ?>
    </table>
    <?php Pjax::end(); ?>
    <?= LinkPager::widget(['pagination' => $pagination]) ?>
</div>


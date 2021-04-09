<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
use yii\widgets\LinkPager;
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\ComunidadesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Administrar Comunidades';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comunidades-index conten-crud table-responsive">
    <div class="cintillo">
        <?php echo Html::img('@web/imagenes/cintillo.jpg'); ?>
    </div>
    <h1 class="title-crud"><?= Html::encode($this->title) ?></h1>
    <?php
    if(Yii::$app->user->can('comunidad'))
    {
        
    }
    else
    {
        ?>
         <p>
        <a class="btn btn-success" href="<?= Url::toRoute("comunidades/create") ?>"><i class="fas fa-plus"></i>  Agregar comunidad</a>
        </p>
        <?php
    }
    ?>
   

    <?php Pjax::begin(); ?>
    <table id="table_reportes" class="table table-bordered table-hover table-striped table_reportes">
        <tr id="encabezado">
            <th class="alert alert-info">ID. Comunidad</th>
            <th class="alert alert-info">Nombre</th>
            <th class="alert alert-info">Estado</th>
            <th class="alert alert-info">Municipio</th>
            <th class="alert alert-info">Parroquia</th>
            <th class="alert alert-info">Acción</th>
        </tr>
        <?php foreach ($comunidades as $comunidades): ?>
            <tr>
                <td><?= $comunidades->id_comunidad ?></td>
                <td><?= $comunidades->nombre ?></td>
                <td><?= $comunidades->estado ?></td>
                <td><?= $comunidades->municipio ?></td>
                <td><?= $comunidades->parroquia ?></td>
                <td style="text-align: center;"><a class="btn btn-primary btn-sm" href="<?= Url::to(['comunidades/update', 'id' => $comunidades->id_comunidad]); ?>"><i class="fas fa-edit"></i></a></td>
            </tr>
        <?php endforeach; ?>
    </table>
    <?php Pjax::end(); ?>
    <?= LinkPager::widget(['pagination' => $pagination]) ?>
    
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


    

</div>

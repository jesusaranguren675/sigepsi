<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ComunidadesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'COMUNIDADES';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="cintillo">
    <?php echo Html::img('@web/imagenes/cintillo.svg'); ?>
</div>
<h3 class="title-dashboard"><?= Html::encode($this->title) ?></h3>


<div class="comunidades-index">

    <p>
        <?= Html::a('Crear comunidad', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_comunidad',
            'rif',
            'nombre',
            'id_tipo_comunidad',
            'telefono_contacto',
            //'persona_contacto',
            //'email:email',
            //'id_parroquia',
            //'direccion',
            //'id_user',
            //'id_estatus',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <div class="container-fluid">
        <div class="card mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Título</th>
                                <th>Estatus</th>
                                <th>Estado</th>
                                <th>Nombre</th>
                                <th>Linea de Investigación</th>
                                <th>Fecha Inicio</th>
                                <th>Fecha Fin</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Título</th>
                                <th>Problema</th>
                                <th>Objetivo General</th>
                                <th>Objetivos Especificos</th>
                                <th>Fecha Inicio</th>
                                <th>Fecha Fin</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


</div>

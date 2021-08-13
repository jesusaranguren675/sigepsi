<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EstructurasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Estructuras';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="estructuras-index">

    <!-- Cintillo -->
    <div class="cintillo">
        <?php echo Html::img('@web/imagenes/cintillo.svg'); ?>
    </div>
    <!-- Fin Cintillo -->

    <!-- Migas de pan -->
    <nav style="--bs-breadcrumb-divider: '';" aria-label="breadcrumb">
        <ol class="breadcrumb alert alert-warning">
            <li class="breadcrumb-item"><a href="<?= Url::toRoute('estructuras/index')?>">Estructuras / </a></li>
        </ol>
    </nav>

    <a class="btn btn-primary" href="<?= Url::toRoute('estructuras/create')?>"><i class="fas fa-plus"></i> Crear</a>
    <!-- Fin Migas de Pan -->
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_estructura',
            'id_carrera',
            'id_trayecto',
            'id_linea_investigacion',
            'peso',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>

<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EstructurasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Estructuras';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="estructuras-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Estructuras', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

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
            'id_producto',
            //'id_item_estructura',
            //'peso',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>

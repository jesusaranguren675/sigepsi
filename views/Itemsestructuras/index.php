<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ItemsestructurasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Itemsestructuras';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="itemsestructuras-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Itemsestructuras', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_item_estructura',
            'item',
            'id_carrera',
            'id_trayecto',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>

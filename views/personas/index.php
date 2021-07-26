<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PersonasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Personas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="personas-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Personas', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_persona',
            'cedula',
            'primer_nombre',
            'segundo_nombre',
            'primer_apellido',
            //'segundo_apellido',
            //'fecha_nac',
            //'telefono_celular',
            //'telefono_local',
            //'id_user',
            //'id_estatus',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>

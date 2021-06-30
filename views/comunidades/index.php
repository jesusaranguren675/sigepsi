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

   

</div>

<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\CrugeUser */

$this->title = 'Usuario: '.$model->username;
$this->params['breadcrumbs'][] = ['label' => 'Administrar usuarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="cruge-user-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Editar', ['update', 'id' => $model->iduser], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Eliminar', ['delete', 'id' => $model->iduser], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'iduser',
            //'regdate',
            //'actdate',
            //'logondate',
            'username',
            'email:email',
            'password',
            //'authkey',
            //'state',
            //'totalsessioncounter',
            //'currentsessioncounter',
        ],
    ]) ?>

</div>

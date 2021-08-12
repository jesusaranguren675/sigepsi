<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Trayectos */

$this->title = 'Update Trayectos: ' . $model->id_trayecto;
$this->params['breadcrumbs'][] = ['label' => 'Trayectos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_trayecto, 'url' => ['view', 'id' => $model->id_trayecto]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="trayectos-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

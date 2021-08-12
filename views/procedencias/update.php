<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Procedencias */

$this->title = 'Update Procedencias: ' . $model->id_procedencia;
$this->params['breadcrumbs'][] = ['label' => 'Procedencias', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_procedencia, 'url' => ['view', 'id' => $model->id_procedencia]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="procedencias-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

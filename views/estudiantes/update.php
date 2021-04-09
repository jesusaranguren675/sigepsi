<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Estudiantes */

$this->title = 'Update Estudiantes: ' . $model->id_estudiante;
$this->params['breadcrumbs'][] = ['label' => 'Estudiantes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_estudiante, 'url' => ['view', 'id' => $model->id_estudiante]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="estudiantes-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

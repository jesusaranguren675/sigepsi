<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Comunidades */

$this->title = 'Update Comunidades: ' . $model->id_comunidad;
$this->params['breadcrumbs'][] = ['label' => 'Comunidades', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_comunidad, 'url' => ['view', 'id' => $model->id_comunidad]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="comunidades-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

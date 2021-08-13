<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Lineasinvestigacion */

$this->title = 'Update Lineasinvestigacion: ' . $model->id_linea_investigacion;
$this->params['breadcrumbs'][] = ['label' => 'Lineasinvestigacions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_linea_investigacion, 'url' => ['view', 'id' => $model->id_linea_investigacion]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="lineasinvestigacion-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

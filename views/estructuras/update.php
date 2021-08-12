<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Estructuras */

$this->title = 'Update Estructuras: ' . $model->id_estructura;
$this->params['breadcrumbs'][] = ['label' => 'Estructuras', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_estructura, 'url' => ['view', 'id' => $model->id_estructura]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="estructuras-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

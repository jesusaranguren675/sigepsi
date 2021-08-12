<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Itemsestructuras */

$this->title = 'Update Itemsestructuras: ' . $model->id_item_estructura;
$this->params['breadcrumbs'][] = ['label' => 'Itemsestructuras', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_item_estructura, 'url' => ['view', 'id' => $model->id_item_estructura]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="itemsestructuras-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

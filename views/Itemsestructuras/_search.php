<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ItemsestructurasSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="itemsestructuras-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_item_estructura') ?>

    <?= $form->field($model, 'item') ?>

    <?= $form->field($model, 'id_carrera') ?>

    <?= $form->field($model, 'id_trayecto') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

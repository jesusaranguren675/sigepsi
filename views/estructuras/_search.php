<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\EstructurasSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="estructuras-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_estructura') ?>

    <?= $form->field($model, 'id_carrera') ?>

    <?= $form->field($model, 'id_trayecto') ?>

    <?= $form->field($model, 'id_linea_investigacion') ?>

    <?= $form->field($model, 'id_producto') ?>

    <?php // echo $form->field($model, 'id_item_estructura') ?>

    <?php // echo $form->field($model, 'peso') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

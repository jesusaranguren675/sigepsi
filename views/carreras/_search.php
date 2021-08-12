<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CarrerasSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="carreras-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_carrera') ?>

    <?= $form->field($model, 'carrera') ?>

    <?= $form->field($model, 'id_procedencia') ?>

    <?= $form->field($model, 'id_especialidad') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

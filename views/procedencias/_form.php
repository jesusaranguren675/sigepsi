<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Procedencias */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="procedencias-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'procedencia')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

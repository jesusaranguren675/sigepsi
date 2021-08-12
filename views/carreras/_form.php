<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Carreras */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="carreras-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'carrera')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_procedencia')->textInput() ?>

    <?= $form->field($model, 'id_especialidad')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

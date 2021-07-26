<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Personas */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="personas-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'cedula')->textInput() ?>

    <?= $form->field($model, 'primer_nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'segundo_nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'primer_apellido')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'segundo_apellido')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fecha_nac')->textInput() ?>

    <?= $form->field($model, 'telefono_celular')->textInput() ?>

    <?= $form->field($model, 'telefono_local')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_user')->textInput() ?>

    <?= $form->field($model, 'id_estatus')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

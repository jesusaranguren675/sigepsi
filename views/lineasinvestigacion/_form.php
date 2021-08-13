<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Lineasinvestigacion */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="lineasinvestigacion-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'linea_investigacion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_carrera')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

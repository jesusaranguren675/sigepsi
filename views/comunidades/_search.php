<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ComunidadesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="comunidades-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_comunidad') ?>

    <?= $form->field($model, 'rif') ?>

    <?= $form->field($model, 'nombre') ?>

    <?= $form->field($model, 'id_tipo_comunidad') ?>

    <?= $form->field($model, 'telefono_contacto') ?>

    <?php // echo $form->field($model, 'persona_contacto') ?>

    <?php // echo $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'id_parroquia') ?>

    <?php // echo $form->field($model, 'direccion') ?>

    <?php // echo $form->field($model, 'id_user') ?>

    <?php // echo $form->field($model, 'id_estatus') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

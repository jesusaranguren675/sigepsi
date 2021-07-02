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

    <?php // $form->field($model, 'id_comunidad') ?>

    <div class="row">
        <div class="col-sm-4">
            <?= $form->field($model, 'rif') ?>
        </div>

        <div class="col-sm-4">
            <?= $form->field($model, 'nombre') ?>
        </div>

        <div class="col-sm-4">
            <?= $form->field($model, 'id_tipo_comunidad') ?>
        </div>

        <div class="col-sm-4">
            <?php echo $form->field($model, 'email') ?>
        </div>

        <div class="col-sm-4">
            <?= $form->field($model, 'telefono_contacto') ?>
        </div>

        <div class="col-sm-4">
            <?php echo $form->field($model, 'persona_contacto') ?>
        </div>
    </div>
    
    

    <?php // echo $form->field($model, 'id_parroquia') ?>

    <?php // echo $form->field($model, 'direccion') ?>

    <?php // echo $form->field($model, 'id_user') ?>

    <?php // echo $form->field($model, 'id_estatus') ?>

    <div class="form-group">
        <button class="btn btn-success"><i class="fas fa-search"></i> Buscar</button>
        <?= Html::resetButton('Reiniciar', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

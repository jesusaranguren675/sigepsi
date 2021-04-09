<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\ProyectosSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="proyectos-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_proyecto') ?>

    <?= $form->field($model, 'id_necesidad') ?>

    <?= $form->field($model, 'titulo') ?>

    <?= $form->field($model, 'problema') ?>

    <?= $form->field($model, 'objetivo_general') ?>

    <?php // echo $form->field($model, 'objetivos_especificos') ?>

    <?php // echo $form->field($model, 'id_comunidad') ?>

    <?php // echo $form->field($model, 'id_estatus') ?>

    <?php // echo $form->field($model, 'conclusiones') ?>

    <?php // echo $form->field($model, 'recomendaciones') ?>

    <?php // echo $form->field($model, 'fecha_inicio') ?>

    <?php // echo $form->field($model, 'fecha_fin') ?>

    <?php // echo $form->field($model, 'id_especialidad') ?>

    <?php // echo $form->field($model, 'id_parroquia') ?>

    <?php // echo $form->field($model, 'formato_informe_final') ?>

    <?php // echo $form->field($model, 'formato_propuesta') ?>

    <?php // echo $form->field($model, 'direccion') ?>

    <?php // echo $form->field($model, 'cedula_tutor_comunitario') ?>

    <?php // echo $form->field($model, 'tutor_comunitario') ?>

    <?php // echo $form->field($model, 'id_tutor') ?>

    <?php // echo $form->field($model, 'sinopsis') ?>

    <?php // echo $form->field($model, 'id_linea_investigacion') ?>

    <?php // echo $form->field($model, 'id_trayecto') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

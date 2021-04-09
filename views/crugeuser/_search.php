<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\CrugeUserSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cruge-user-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'iduser') ?>

    <?= $form->field($model, 'regdate') ?>

    <?= $form->field($model, 'actdate') ?>

    <?= $form->field($model, 'logondate') ?>

    <?= $form->field($model, 'username') ?>

    <?php // echo $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'password') ?>

    <?php // echo $form->field($model, 'authkey') ?>

    <?php // echo $form->field($model, 'state') ?>

    <?php // echo $form->field($model, 'totalsessioncounter') ?>

    <?php // echo $form->field($model, 'currentsessioncounter') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

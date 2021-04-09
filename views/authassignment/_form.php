<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

$AuthAssignment = \app\models\AuthAssignment::find()->all();
$BackendUser = \app\models\BackendUser::find()->all();

/* @var $this yii\web\View */
/* @var $model app\models\AuthAssignment */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="auth-assignment-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'item_name')->textInput(['maxlength' => true]) ?> 
    <!--<?= $form->field($model, "item_name")->dropDownList(
                                       ArrayHelper::map($AuthAssignment, 'user_id', 'item_name'),
                                       ['prompt' => 'Seleccione']);?> -->   

    <!-- <?= $form->field($model, 'user_id')->textInput(['maxlength' => true]) ?> -->

    <?= $form->field($model, "user_id")->dropDownList(
                                       ArrayHelper::map($BackendUser, 'id', 'username'),
                                       ['prompt' => 'Seleccione el usuario']);?>   

    <!-- <?= $form->field($model, 'created_at')->textInput() ?> -->

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

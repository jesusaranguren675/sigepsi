<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\State;
use yii\helpers\ArrayHelper;
$State = \app\models\State::find()->all();


/* @var $this yii\web\View */
/* @var $model frontend\models\CrugeUser */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cruge-user-form">
    <div class="row">
        <?php $form = ActiveForm::begin(); ?>

        <!-- <?= $form->field($model, 'regdate')->textInput() ?> -->

        <!--<?= $form->field($model, 'actdate')->textInput() ?>

       <?= $form->field($model, 'logondate')->textInput() ?> -->

        <div class="col-sm-3">
            <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>        
        </div>

        <div class="col-sm-3">
             <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>         
        </div>

        <div class="col-sm-3">
            <?= $form->field($model, 'password')->textInput(['maxlength' => true]) ?>        
        </div>
        <!--<?= $form->field($model, 'authkey')->textInput(['maxlength' => true]) ?> -->
        <!--<?= $form->field($model, 'totalsessioncounter')->textInput() ?> -->

        <!--<?= $form->field($model, 'currentsessioncounter')->textInput() ?> -->
    </div>

    <div class="row">
        <hr>
        <div class="col-sm-3">
            <h4>Opciones avanzadas:</h4>
             <?= $form->field($model, "state")->dropDownList(
                             ArrayHelper::map($State, 'id_estate', 'state'),
                             ['prompt' => 'Seleccione']);?> 
        </div>
    </div>
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
        <?php ActiveForm::end(); ?>
</div>

<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
$carreras = \app\models\Carreras::find()->all();
$trayectos = \app\models\Trayectos::find()->all();

/* @var $this yii\web\View */
/* @var $model app\models\Estructuras */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="estructuras-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, "id_carrera")->dropDownList(
                             ArrayHelper::map($carreras, 'id_carrera', 'carrera'),
                             ['prompt' => 'Seleccione']);?>

    <?= $form->field($model, "id_trayecto")->dropDownList(
                             ArrayHelper::map($trayectos, 'id_trayecto', 'trayecto'),
                             ['prompt' => 'Seleccione']);?>

    <?= $form->field($model, 'id_linea_investigacion')->textInput() ?>

    <?= $form->field($model, 'id_producto')->textInput() ?>

    <?= $form->field($model, 'id_item_estructura')->textInput() ?>

    <?= $form->field($model, 'peso')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

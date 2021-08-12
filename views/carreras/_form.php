<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
$procedencias = \app\models\Procedencias::find()->all();
$especialidades = \app\models\Especialidades::find()->all();
/* @var $this yii\web\View */
/* @var $model app\models\Carreras */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="carreras-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'carrera')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, "id_procedencia")->dropDownList(
                             ArrayHelper::map($procedencias, 'id_procedencia', 'procedencia'),
                             ['prompt' => 'Seleccione']);?>

    <?= $form->field($model, "id_especialidad")->dropDownList(
                             ArrayHelper::map($especialidades, 'id_especialidad', 'especialidad'),
                             ['prompt' => 'Seleccione']);?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

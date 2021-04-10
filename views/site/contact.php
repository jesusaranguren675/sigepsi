<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

use app\assets\FormulariosAsset;

FormulariosAsset::register($this);

$this->title = 'PROPUESTA';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contenedor-modulo">
    <h3 class="title-modulo"><strong><?= Html::encode($this->title) ?></strong></h3>
    <div class="row col-sm-12">
            <div class="col-sm-12">    
            <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>
                <div class="row">
                    <div class="col-sm-6">
                        <?= $form->field($model, 'name')->textInput(['autofocus' => true]) ?>
                    </div>

                    <div class="col-sm-6">
                        <?= $form->field($model, 'email') ?>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <?= $form->field($model, 'subject') ?>
                    </div>


                    <div class="col-sm-12">
                        <?= $form->field($model, 'body')->textarea() ?>
                    </div>



                </div>

                <div class="form-group">
                    <?= Html::submitButton('Enviar', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                </div>
                <hr>
            <?php ActiveForm::end(); ?>
            </div>
    </div>
</div>


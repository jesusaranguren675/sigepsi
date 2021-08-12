<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Procedencias */

$this->title = 'Create Procedencias';
$this->params['breadcrumbs'][] = ['label' => 'Procedencias', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="procedencias-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

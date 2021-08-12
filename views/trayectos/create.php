<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Trayectos */

$this->title = 'Create Trayectos';
$this->params['breadcrumbs'][] = ['label' => 'Trayectos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="trayectos-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

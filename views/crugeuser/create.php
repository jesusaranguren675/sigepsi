<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\CrugeUser */

$this->title = 'Crear Nuevo Usuario';
$this->params['breadcrumbs'][] = ['label' => 'Administrar usuarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cruge-user-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

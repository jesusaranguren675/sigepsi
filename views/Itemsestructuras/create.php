<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Itemsestructuras */

$this->title = 'Create Itemsestructuras';
$this->params['breadcrumbs'][] = ['label' => 'Itemsestructuras', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="itemsestructuras-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

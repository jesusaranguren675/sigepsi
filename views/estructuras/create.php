<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Estructuras */

$this->title = 'Create Estructuras';
$this->params['breadcrumbs'][] = ['label' => 'Estructuras', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="estructuras-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

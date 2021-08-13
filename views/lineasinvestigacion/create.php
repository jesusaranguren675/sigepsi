<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Lineasinvestigacion */

$this->title = 'Create Lineasinvestigacion';
$this->params['breadcrumbs'][] = ['label' => 'Lineasinvestigacions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lineasinvestigacion-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

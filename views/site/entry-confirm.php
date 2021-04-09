<?php
use yii\helpers\Html;
?>

<p>Tu has ingresado la siguiente información</p>

<p>Nombre: <?= Html::encode($model->$name) ?></p>
<p>Email: <?= Html::encode($model->email)?></p>

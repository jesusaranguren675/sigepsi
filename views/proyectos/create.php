<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model frontend\models\Proyectos */

$this->params['breadcrumbs'][] = ['label' => 'Proyectos', 'url' => ['admin']];
$this->params['breadcrumbs'][] = $this->title;
?>
  	
	

    <?= $this->render('_form', [
        'model' 			=> $model,
    ]) ?>
</div>

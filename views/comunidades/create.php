<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Comunidades */

$this->title = 'Create Comunidades';
$this->params['breadcrumbs'][] = ['label' => 'Comunidades', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comunidades-create conten-crud">
	<div class="cintillo">
        <?php echo Html::img('@web/imagenes/cintillo.jpg'); ?>
    </div>
    <h1 class="title-crud" style="margin: 0px;">Registro de Comunidades</h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

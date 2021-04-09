<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\CrugeUser */

$this->title = 'Editanto Usuario: ' . $model->username;
$this->params['breadcrumbs'][] = ['label' => 'Administrar usuarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->iduser, 'url' => ['view', 'id' => $model->iduser]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="cruge-user-update conten-crud">
	<div class="cintillo">
        <?php echo Html::img('@web/imagenes/cintillo.jpg'); ?>
    </div>
    <h1 class="title-crud"><?= Html::encode($this->title) ?></h1>
    <hr>
    <h4>Datos de la cuenta:</h4>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

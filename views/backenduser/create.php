<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Backenduser */

$this->title = 'Create Backenduser';
$this->params['breadcrumbs'][] = ['label' => 'Backendusers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="backenduser-create conten-crud">
	<div class="cintillo">
        <?php echo Html::img('@web/imagenes/cintillo.jpg'); ?>
    </div>
    <h1 class="title-crud">Crear Nuevo Usuario:</h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

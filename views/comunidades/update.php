<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Comunidades */

$this->title = 'Update Comunidades: ' . $model->id_comunidad;
$this->params['breadcrumbs'][] = ['label' => 'Comunidades', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_comunidad, 'url' => ['view', 'id' => $model->id_comunidad]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="conten-crud">

    <div class="cintillo">
        <?php echo Html::img('@web/imagenes/cintillo.jpg'); ?>
    </div>
    <h1 style="margin: 0px;" class="title-crud">Modificar comunidad</h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

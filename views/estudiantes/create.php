<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model frontend\models\Estudiantes */

$this->title = 'Create Estudiantes';
$this->params['breadcrumbs'][] = ['label' => 'Estudiantes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="estudiantes-create conten-crud">
	<div class="cintillo">
        <?php echo Html::img('@web/imagenes/cintillo.jpg'); ?>
    </div>

    <ol style="display: block;" class="breadcrumb">
    	<li><a href="<?= Url::to(['estudiantes/index']); ?>">Inicio</a></li>
    	<li><a href="#">registro estudiantes</a></li>
    </ol>
    
    <h1 style="margin: 0px;" class="title-crud">Registro Estudiante</h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

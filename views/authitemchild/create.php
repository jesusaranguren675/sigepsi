<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\AuthItemChild */

$this->title = 'Crear asignación de permisos';
$this->params['breadcrumbs'][] = ['label' => 'Asignar Permisos a Roles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="auth-item-child-create conten-crud">
	<div class="cintillo">
        <?php echo Html::img('@web/imagenes/cintillo.jpg'); ?>
    </div> 

    <ol style="display: block;" class="breadcrumb">
    	<li><a href="<?= Url::to(['authitemchild/index']); ?>">Inicio</a></li>
    	<li><a href="#">crear asignación de permisos</a></li>
    </ol>

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

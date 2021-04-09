<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Backenduser */

$this->title = 'Update Backenduser: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Backendusers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="backenduser-update conten-crud">
	 <div class="cintillo">
        <?php echo Html::img('@web/imagenes/cintillo.jpg'); ?>
    </div>

    <ol style="display: block;" class="breadcrumb">
    	<li ><a href="<?= Url::to(['backenduser/index']); ?>">Inicio</a></li>
    	<li><a href="#">Modificar perfil</a></li>
    </ol>


    <h1 class="title-crud">Editando Perfil</h1>

    <?= $this->render('_form_update', [
        'model' => $model,
    ]) ?>

</div>


<script>
	var password = document.getElementById("backenduser-password_hash").value = "";
</script>

<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Comunidades */

$this->title = $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Comunidades', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="comunidades-view">

    <!-- Cintillo -->
    <div class="cintillo">
        <?php echo Html::img('@web/imagenes/cintillo.svg'); ?>
    </div>
    <!-- Fin Cintillo -->

    <!-- Migas de pan -->
    <nav style="--bs-breadcrumb-divider: '';" aria-label="breadcrumb">
        <ol class="breadcrumb alert alert-warning">
            <li class="breadcrumb-item"><a href="<?= Url::toRoute('comunidades/index')?>">Comunidades </a></li>

            <li class="breadcrumb-item active" aria-current="page">Listado de Comunidades</li>
        </ol>
    </nav>
    <!-- Fin Migas de Pan -->

    <h3 class="title-dashboard">Listado de Comunidades</h3>
    <h6><!-- <?= Html::encode($this->title) ?>--></h6>

    <p>
        <a  href="<?= Url::toRoute(['comunidades/update', 'id' => $model->id_comunidad]) ?>" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i> Modificar</a>
        <?php // Html::a('Delete', ['delete', 'id' => $model->id_comunidad], [
            //'class' => 'btn btn-danger',
            //'data' => [
                //'confirm' => 'Are you sure you want to delete this item?',
                //'method' => 'post',
            //],
       // ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_comunidad',
            'rif',
            'nombre',
            'id_tipo_comunidad',
            'telefono_contacto',
            'persona_contacto',
            'email:email',
            'id_parroquia',
            'direccion',
            'id_user',
            'id_estatus',
        ],
    ]) ?>

</div>

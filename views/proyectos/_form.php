<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Trayectos;
use app\models\LineasInvestigacion;
use app\models\Estados;
use app\models\Municipios;
use app\models\Parroquias;
use app\models\Tutores;
use yii\widgets\DatePicker;
$Trayectos = \app\models\Trayectos::find()->all();
$LineasInvestigacion = \app\models\LineasInvestigacion::find()->all();
$Estados = \app\models\Estados::find()->all();
$Municipios = \app\models\Municipios::find()->all();
$Parroquias = \app\models\Parroquias::find()->all();
$Tutores = \app\models\Tutores::find()->all();
$Especialidades = \app\models\Especialidades::find()->all();

/* @var $this yii\web\View */
/* @var $model frontend\models\Proyectos */
/* @var $form yii\widgets\ActiveForm */
?>


<style type="text/css">.title-crud {margin-top: 20px;} .form-cedula-integrante {display: flex; 
    justify-content: center; align-items: center;}
</style>
<div class="proyectos-create conten-crud">
    <div class="cintillo">
        <?php echo Html::img('@web/imagenes/cintillo.jpg'); ?>
    </div>

    <ol style="display: block;" class="breadcrumb">
        <li><a href="<?= Url::to(['proyectos/admin']); ?>">Inicio</a></li>
        <li><a href="#">registrar proyecto</a></li>
    </ol>

    <div class="proyectos-form">
        <div class="rows">
            <?php $form = ActiveForm::begin(); ?>
                <div class="alert-sigepsi">
                    <p>
                        Este formulario le permitirá registrar su propuesta de proyecto para el servicio comunitario, antes de realizar el registro debe tomar en consideración los siguientes aspectos:
                    </p>
                    <p>
                        1. Conocer la ubicación exacta de la comunidad que desea beneficiar.<br>
                        2. Conocer el número de cédula y nombre de su tutor comunitario.<br>
                        3. Conocer el número de cédula y nombre de su tutor académico.<br> 
                    </p>
                </div>

                <div class="col-sm-6">
                    <?= $form->field($model, 'titulo')->textarea(['rows' => 6]) ?> 
                     <?= $form->field($model, 'id_necesidad')->textInput()->hiddenInput()->label(false)?>       
                </div>

                <div class="col-sm-6">
                    <?= $form->field($model, 'problema')->textarea(['rows' => 6]) ?>        
                </div>

                <div class="col-sm-6">
                    <?= $form->field($model, 'objetivo_general')->textarea(['rows' => 6]) ?>        
                </div>

                <div class="col-sm-6">
                    <?= $form->field($model, 'objetivos_especificos')->textarea(['rows' => 6]) ?>        
                </div>

                <div class="col-sm-12">
                    <?= $form->field($model, 'sinopsis')->textarea(['rows' => 6]) ?>        
                </div>

                <div class="alert-sigepsi">
                    <p>
                       Para ingresar la comunidad debe presionar el icono <i class="fas fa-search" ></i>  que se encuentra ubicado en la parte derecha del campo de texto. Debe ubicarla por estado, municipio y parroquia si la misma no se encuentra en el listado debe registrarla.
                    </p>
                </div>

                
                <?= $form->field($model, 'id_estatus')->textInput()->hiddenInput()->label(false) ?>

                <div class="con">
                     <?= $form->field($model, 'id_comunidad')->textInput() ?>
                     <i data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample" style="margin-left: 10px; cursor: pointer;" class="fas fa-search"></i>
                </div>

                <div style="display: none;" class="datos-comunidades">
                      
                </div>

                <div class="collapse" id="collapseExample">
                    <hr style="border-color: #ebccd1;">
                    <div class="card card-body">
                        <h3>Seleccionar o registrar comunidad</h3>
                        <div style="background-color: #f2dede;border-color: #ebccd1;color: #a94442;" class="alert-sigepsi">
                            <p>
                             Antes de registrar una comunidad por favor verifique si ya existe en la base de datos, buscando por Estado, Municipio y Parroquia. Si la misma no existe presione el botón Registrar comunidad. <a class="btn btn-primary" href="<?= Url::toRoute("comunidades/create") ?>" target="_blank"><i class="fas fa-hotel"></i> Registrar comunidad</a>
                            </p>
                        </div>
                        <div class="col-sm-3">
                            <?= $form->field($model, "comunidad_id_estado")->dropDownList(
                             ArrayHelper::map($Estados, 'id_estado', 'estado'),
                             ['prompt' => 'Seleccione']);?>         
                         </div>

                         <div class="col-sm-3">
                            <?= $form->field($model, "comunidad_id_municipio")->dropDownList(
                             ArrayHelper::map($Municipios, 'id_municipio', 'municipio'),
                             ['prompt' => 'Seleccione']);?>         
                         </div>

                         <div class="col-sm-3">
                            <?= $form->field($model, "comunidad_id_parroquia")->dropDownList(
                             ArrayHelper::map($Parroquias, 'id_parroquia', 'parroquia'),
                             ['prompt' => 'Seleccione']);?>         
                         </div>
                         <p>
                             <button id="button_buscar_comunidad" style="margin-top: 25px;" class="btn btn-primary" type="button"><i class="fas fa-search"></i> Buscar comunidad</button>
                         </p>
                         <div id="cont-table-comunidades" class="cont-table-comunidades">
                             <table class="table-comunidades table table-bordered table-striped table-hover" id="table-comunidades" style="display: none;">
                                 <tr id="encabezado-table-comunidades">
                                     <th>Nombre</th>
                                     <th>Dirección</th>
                                     <th>Teléfono</th>
                                     <th>Persona de contacto</th>
                                     <th style="text-align: center;">Acciones</th>
                                 </tr>
                             </table>
                         </div>  
                     </div><br><hr style="border-color: #ebccd1;"><br><br>
                </div>
                
                <div class="col-sm-4">
                    <div class="form-group field-proyectos-fecha_inicio">
                        <label class="control-label" for="proyectos-fecha_inicio">Fecha Inicio</label>
                        <input class="form-control" type="date" id="proyectos-fecha_inicio">
                        <div class="help-block"></div>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="form-group field-proyectos-fecha_fin">
                        <label class="control-label" for="proyectos-fecha_fin">Fecha Fin</label>
                        <input class="form-control" type="date" id="proyectos-fecha_fin">
                        <div class="help-block"></div>
                    </div>   
                </div>

                <div class="col-sm-4">
                    <?= $form->field($model, "id_especialidad")->dropDownList(
                                               ArrayHelper::map($Especialidades, 'id_especialidad', 'especialidad'),
                                               ['prompt' => 'Seleccione']);?>        
                </div>

                <div class="col-sm-4">
                    <?= $form->field($model, "id_trayecto")->dropDownList(
                                               ArrayHelper::map($Trayectos, 'id_trayecto', 'trayecto'),
                                               ['prompt' => 'Seleccione']);?>        
                </div>

                <div class="col-sm-8">
                    <?= $form->field($model, "id_linea_investigacion")->dropDownList(
                                               ArrayHelper::map($LineasInvestigacion, 'id_linea_investigacion', 'linea_investigacion'),
                                               ['prompt' => 'Seleccione']);?>        
                </div>

                <div class="alert-sigepsi">
                    <p>
                       Los siguientes datos solicitados(Estado, Municipio, Parroquia y Dirección) son referentes al sitio donde será ejecutado el proyecto. Se repiten estos datos ya que pudiera darse el caso en que el desarrollo del proyecto sea en una direción distinta de la comunidad.
                    </p>
                </div>

                <div class="col-sm-4">
                    <?= $form->field($model, "id_estado")->dropDownList(
                                               ArrayHelper::map($Estados, 'id_estado', 'estado'),
                                               ['prompt' => 'Seleccione']);?>         
                </div>

                <div class="col-sm-4">
                    <?= $form->field($model, "id_municipio")->dropDownList(
                                               ArrayHelper::map($Municipios, 'id_municipio', 'municipio'),
                                               ['prompt' => 'Seleccione']);?>         
                </div>

                <div class="col-sm-4">
                    <?= $form->field($model, "id_parroquia")->dropDownList(
                                               ArrayHelper::map($Parroquias, 'id_parroquia', 'parroquia'),
                                               ['prompt' => 'Seleccione']);?>         
                </div>

                 <div class="col-sm-12">
                    <?= $form->field($model, 'direccion')->textarea(['rows' => 6]) ?>       
                 </div>

                 <div class="col-sm-4">
                    <?= $form->field($model, 'cedula_tutor_comunitario')->textInput(['rows' => 6]) ?>       
                 </div>

                 <div class="col-sm-4">
                    <?= $form->field($model, 'tutor_comunitario')->textInput(['rows' => 6]) ?>       
                 </div>

                 <div class="col-sm-4">
                    <?= $form->field($model, "id_tutor")->dropDownList(ArrayHelper::map(
                                                        app\models\Tutores::find()->asArray()->all(),
                                                        'id_tutor',
                                                        function($model) {
                                                            return $model['primer_nombre'].' '.$model['primer_apellido'];
                                                        }))?> 
                </div>

                <input type="hidden" id="campo_integrante_1" class="campo_integrante_1" value="">
                <input type="hidden" id="campo_integrante_2" class="campo_integrante_2" value="">
                <input type="hidden" id="campo_integrante_3" class="campo_integrante_3" value="">
                <input type="hidden" id="campo_integrante_4" class="campo_integrante_4" value="">
                <input type="hidden" id="campo_integrante_5" class="campo_integrante_5" value="">
                <input type="hidden" id="contador" class="contador" value="">

                <?= $form->field($model, 'conclusiones')->textarea(['rows' => 6])->hiddenInput()->label(false) ?>

                <?= $form->field($model, 'recomendaciones')->textarea(['rows' => 6])->hiddenInput()->label(false) ?>

                <?= $form->field($model, 'formato_informe_final')->textInput()->hiddenInput()->label(false) ?>

                <?php $propuesta = "Propuesta"; ?>

                <!-- <?= $form->field($model, 'formato_propuesta')->textInput(['value' => $propuesta])->hiddenInput()->label(false) ?> -->

                <?php $created_by = Yii::$app->user->identity->username ?>

                <?= $form->field($model, 'created_by')->textInput(['value' => $created_by])->hiddenInput()->label(false) ?>

                <?= $form->field($model, 'created_at')->textInput()->hiddenInput()->label(false) ?>

                <?= $form->field($model, 'updated_by')->textInput()->hiddenInput()->label(false) ?>

                <?= $form->field($model, 'updated_at')->textInput()->hiddenInput()->label(false) ?>
        </div>
    
    
<?= $this->render('integrantes', [
        'model'             => $model,
    ]) ?>
<?= $this->render('script') ?>
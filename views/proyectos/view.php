<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Proyectos */

$this->title = $model->id_proyecto;
$this->params['breadcrumbs'][] = ['label' => 'Proyectos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="proyectos-view conten-crud">

    <div class="cintillo">
        <?php echo Html::img('@web/imagenes/cintillo.jpg'); ?>
    </div>

    <ol style="display: block;" class="breadcrumb">
        <li><a href="<?= Url::to(['proyectos/admin']); ?>">Inicio</a></li>
        <li><a href="#">consultar proyectos</a></li>
    </ol>

    <h1 class="title-crud">Consultar Proyectos</h1>

    <?php foreach ($proyecto as $proyecto): ?>
    <?php 
    if($proyecto["formato_propuesta"] == "propuesta" || $proyecto["formato_propuesta"] == "")
    {
        ?>
        <div style="display: flex; justify-content: center; align-items: center; flex-direction: column;">
            <p class="alert alert-primary" style="font-size: 50px; width: 10%;margin: 0px; display: flex; justify-content: center;"><i class="fas fa-file-upload"></i></p>
            <h3>Aún no has registrado tu propuesta de proyecto</h3>
            <h4>Clickea el botón para registrar tu propuesta de proyecto</h4>
            <a class="btn btn-success" href="<?= Url::to(['proyectos/upload', 'id' => $proyecto['id_proyecto']]); ?>">Registar Propuesta</a>
        </div>
        <?php
    }
    else
    {
        ?>
        <div class="row">
            <div class="col-sm-12">
                <p style="text-align: center;" class="alert alert-primary"><strong>DATOS DEl PROYECTO</strong></p>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-3">
                <p class="alert alert-primary"><strong>Id. Proyecto</strong></p>
            </div>
            <div class="col-sm-9">
                <p style="background: #FFF;" class="alert alert-info"><?= $proyecto['id_proyecto'] ?></p>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-3">
                <p class="alert alert-primary"><strong>Estatus del Proyecto</strong></p>
            </div>

            <div class="col-sm-9">
                <p style="background: #FFF;" class="alert alert-info"><?= $proyecto['estatus'] ?></p>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-3">
                <p class="alert alert-primary"><strong>Especialidad</strong></p>
            </div>

            <div class="col-sm-3">
                <p style="background: #FFF;" class="alert alert-info"><?= $proyecto['especialidad'] ?></p>
            </div>

            <div class="col-sm-3">
                <p class="alert alert-primary"><strong>Trayecto</strong></p>
            </div>

            <div class="col-sm-3">
                <p style="background: #FFF;" class="alert alert-info"><?= $proyecto['trayecto'] ?></p>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-3">
                <p class="alert alert-primary"><strong>Línea de Investigación</strong></p>
            </div>

            <div class="col-sm-9">
                <p style="background: #FFF;" class="alert alert-info"><?= $proyecto['linea_investigacion'] ?></p>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-3">
                <p class="alert alert-primary"><strong>Título</strong></p>
            </div>

            <div class="col-sm-9">
                <p style="background: #FFF;" class="alert alert-info"><?= $proyecto['titulo'] ?></p>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-3">
                <p class="alert alert-primary"><strong>Problema</strong></p>
            </div>

            <div class="col-sm-9">
                <p style="background: #FFF;" class="alert alert-info"><?= $proyecto['problema'] ?></p>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-3">
                <p class="alert alert-primary"><strong>Objetivo General</strong></p>
            </div>

            <div class="col-sm-9">
                <p style="background: #FFF;" class="alert alert-info"><?= $proyecto['objetivo_general'] ?></p>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-3">
                <p class="alert alert-primary"><strong>Objetivos Especificos</strong></p>
            </div>

            <div class="col-sm-9">
                <p style="background: #FFF;" class="alert alert-info"><?= $proyecto['objetivos_especificos'] ?></p>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-3">
                <p class="alert alert-primary"><strong>Sinopsis</strong></p>
            </div>

            <div class="col-sm-9">
                <p style="background: #FFF;" class="alert alert-info"><?= $proyecto['sinopsis'] ?></p>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-3">
                <p class="alert alert-primary"><strong>Comunidad</strong></p>
            </div>

            <div class="col-sm-9">
                <div style="background: #FFF;" class="alert alert-info">
                    <p><strong>Nombre: </strong><?= $proyecto['nombre'] ?></p>
                    <p><strong>Estado: </strong><?= $proyecto['estado'] ?></p>
                    <p><strong>Municipio: </strong><?= $proyecto['municipio'] ?></p>
                    <p><strong>Parroquia: </strong><?= $proyecto['parroquia'] ?></p>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-3">
                <p class="alert alert-primary"><strong>Fecha Inicio</strong></p>
            </div>

            <div class="col-sm-4">
                <p style="background: #FFF;" class="alert alert-info"><?= $proyecto['fecha_inicio'] ?></p>
            </div>

            <div class="col-sm-3">
                <p class="alert alert-primary"><strong>Fecha Inicio</strong></p>
            </div>

            <div class="col-sm-2">
                <p style="background: #FFF;" class="alert alert-info"><?= $proyecto['fecha_fin'] ?></p>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-2">
                <p class="alert alert-primary"><strong>Estado</strong></p>
            </div>

            <div class="col-sm-2">
                <p style="background: #FFF;" class="alert alert-info"><?= $proyecto['estado'] ?></p>
            </div>

            <div class="col-sm-2">
                <p class="alert alert-primary"><strong>Municipio</strong></p>
            </div>

            <div class="col-sm-2">
                <p style="background: #FFF;" class="alert alert-info"><?= $proyecto['municipio'] ?></p>
            </div>

            <div class="col-sm-2">
                <p class="alert alert-primary"><strong>Parroquia</strong></p>
            </div>

            <div class="col-sm-2">
                <p class="alert alert-info"><?= $proyecto['parroquia'] ?></p>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-3">
                <p class="alert alert-primary"><strong>Dirección</strong></p>
            </div>

            <div class="col-sm-9">
                <p style="background: #FFF;" class="alert alert-info"><?= $proyecto['direccion'] ?></p>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-3">
                <p class="alert alert-primary"><strong>Tutor Comunitario</strong></p>
            </div>

            <div class="col-sm-9">
                <p style="background: #FFF;" class="alert alert-info"><?= $proyecto['tutor_comunitario'] ?></p>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-3">
                <p class="alert alert-primary"><strong>Tutor Académico</strong></p>
            </div>

            <div class="col-sm-9">
                <p style="background: #FFF;" class="alert alert-info"><?= $proyecto['primer_nombre'] ?> <?= $proyecto['primer_apellido'] ?></p>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-3">
                <p class="alert alert-primary"><strong>Propuesta de Proyecto</strong></p>
            </div>

            <div class="col-sm-9">
                <p style="background: #FFF;" class="alert alert-info"><?= Html::a($proyecto['formato_propuesta'], Url::base()."/archivos/".$proyecto['formato_propuesta'], 
                ['class' => 'enlace', 'target' => '_blank']); //render  ?></p>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="alert alert-primary">
                    <p style="text-align: center;"><strong>INTEGRANTES</strong></p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-1">
                <p style="display: flex; justify-content: center;" class="alert alert-primary"><strong>Cédula</strong></p>
            </div>
            <div class="col-sm-3">
                <p class="alert alert-primary"><strong>Nombres y Apellidos</strong></p>
            </div>
            <div class="col-sm-2">
                <p class="alert alert-primary"><strong>Especialidad</strong></p>
            </div>
            <div class="col-sm-3">
                <p class="alert alert-primary"><strong>Teléfonos</strong></p>
            </div>
            <div class="col-sm-3">
                <p class="alert alert-primary"><strong>Correo Electrónico</strong></p>
            </div>
<!--             <div class="col-sm-1">
                <p style="display: flex; justify-content: center;" class="alert alert-primary"><strong>Estatus</strong></p>
            </div> -->
        </div>

        <div class="row">
            <?php foreach ($integrantes as $integrantes): ?>
                <div class="col-sm-1">
                    <p><?= $integrantes['cedula'] ?></p>
                </div>
                <div class="col-sm-3">
                    <p><?= $integrantes['primer_nombre'] ?> <?= $integrantes['segundo_nombre'] ?> <?= $integrantes['primer_apellido'] ?> <?= $integrantes['segundo_apellido'] ?></p>
                </div>
                <div class="col-sm-2">
                    <p><?= $integrantes['carrera'] ?></p>
                </div>
                <div class="col-sm-3">
                    <p><?= $integrantes['telefono_celular'] ?> / <?= $integrantes['telefono_local'] ?></p>
                </div>
                <div class="col-sm-3">
                    <p><?= $integrantes['email'] ?></p>
                </div>
               <!--  <div class="col-sm-1">
                    <p><span class="label label-success"><?= $integrantes['id_estatus'] ?></span></p>
                </div> -->
            <?php endforeach; ?>
        </div>
        <?php
        if(empty($integrantes))
        {
            ?>

            <p style="width: 100%; display: flex; justify-content: center;">
                <?php echo Html::img('@web/imagenes/estudiante.png', ['style' => 'width:10%;']); ?>
            </p>
            <p>
                <h3 style="text-align: center;">No existen estudiantes registrados en este proyecto.</h3>
                <h4 style="text-align: center;">Modifica tu proyecto y agrega los integrantes correspondientes.</h4>
            </p>
            <?php
        }

        ?>

        <div class="row">
            <div class="col-sm-12">
                <div class="alert alert-primary">
                    <p style="text-align: center;"><strong>TRAZA</strong></p>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-2">
                <p class="alert alert-primary"><strong>Estatus</strong></p>
            </div>
            <div class="col-sm-3">
                <p class="alert alert-primary"><strong>Motivo</strong></p>
            </div>
            <div class="col-sm-3">
                <p class="alert alert-primary"><strong>Observaciones</strong></p>
            </div>
            <div class="col-sm-1">
                <p class="alert alert-primary"><strong>Fecha</strong></p>
            </div>
            <div class="col-sm-1">
                <p class="alert alert-primary"><strong>Hora</strong></p>
            </div>
            <div class="col-sm-2">
                <p class="alert alert-primary"><strong>Usuario</strong></p>
            </div>
        </div>

        <?php foreach ($traza as $traza): ?>
            <?php
            if($traza['estatus'] == "Culminado")
            {
                ?>
                <div class="alert alert-success" style="background: #81F781;">
                    <div class="row">
                        <div class="col-sm-2"><?= $traza['estatus'] ?></div>
                        <div class="col-sm-3">
                            <?php
                            if($traza['proyecto_motivo_correccion'] == "")
                            {
                                echo "N/A";
                            }
                            else
                            {
                                echo $traza['proyecto_motivo_correccion'];
                            }
                            ?>
                        </div>
                        <div class="col-sm-3"><?= $traza['observaciones'] ?></div>
                        <div class="col-sm-1"><?= date("d/m/Y",strtotime($traza['fecha_hora'])) ?></div>
                        <div class="col-sm-1"><?= date("h:i A",strtotime($traza['fecha_hora'])) ?></div>
                        <div class="col-sm-2"><?= $traza['primer_nombre'] ?> <?= $traza['primer_apellido'] ?></div>
                    </div>
                </div>
                <?php 
            }
            else if($traza['estatus'] == "En Desarrollo")
            {
                ?>
                <div class="alert alert-info" style="background: #FFFFFF;">
                    <div class="row">
                        <div class="col-sm-2"><?= $traza['estatus'] ?></div>
                        <div class="col-sm-3">
                            <?php
                            if($traza['proyecto_motivo_correccion'] == "")
                            {
                                echo "N/A";
                            }
                            else
                            {
                                echo $traza['proyecto_motivo_correccion'];
                            }
                            ?>
                        </div>
                        <div class="col-sm-3"><?= $traza['observaciones'] ?></div>
                        <div class="col-sm-1"><?= date("d/m/Y",strtotime($traza['fecha_hora'])) ?></div>
                        <div class="col-sm-1"><?= date("h:i A",strtotime($traza['fecha_hora'])) ?></div>
                        <div class="col-sm-2"><?= $traza['primer_nombre'] ?> <?= $traza['primer_apellido'] ?></div>
                    </div>
                </div>
                <?php 
            }
            else if($traza['estatus'] == "En Corrección")
            {
                ?>
                <div class="alert alert-warning" style="background: #F3F781;">
                    <div class="row">
                        <div class="col-sm-2"><?= $traza['estatus'] ?></div>
                        <div class="col-sm-3">
                            <?php
                            if($traza['proyecto_motivo_correccion'] == "")
                            {
                                echo "N/A";
                            }
                            else
                            {
                                echo $traza['proyecto_motivo_correccion'];
                            }
                            ?>
                        </div>
                        <div class="col-sm-3"><?= $traza['observaciones'] ?></div>
                        <div class="col-sm-1"><?= date("d/m/Y",strtotime($traza['fecha_hora'])) ?></div>
                        <div class="col-sm-1"><?= date("h:i A",strtotime($traza['fecha_hora'])) ?></div>
                        <div class="col-sm-2"><?= $traza['primer_nombre'] ?> <?= $traza['primer_apellido'] ?></div>
                    </div>
                </div>
                <?php 
            }
            else if($traza['estatus'] == "Rechazado")
            {
                ?>
                <div class="alert alert-danger" style="background: #F5A9A9;">
                    <div class="row">
                        <div class="col-sm-2"><?= $traza['estatus'] ?></div>
                        <div class="col-sm-3">
                            <?php
                            if($traza['proyecto_motivo_correccion'] == "")
                            {
                                echo "N/A";
                            }
                            else
                            {
                                echo $traza['proyecto_motivo_correccion'];
                            }
                            ?>
                        </div>
                        <div class="col-sm-3"><?= $traza['observaciones'] ?></div>
                        <div class="col-sm-1"><?= date("d/m/Y",strtotime($traza['fecha_hora'])) ?></div>
                        <div class="col-sm-1"><?= date("h:i A",strtotime($traza['fecha_hora'])) ?></div>
                        <div class="col-sm-2"><?= $traza['primer_nombre'] ?> <?= $traza['primer_apellido'] ?></div>
                    </div>
                </div>
                <?php 
            }
            else if($traza['estatus'] == "Cancelado")
            {
                ?>
                <div class="alert alert-danger" style="background: #F5A9A9;">
                    <div class="row">
                        <div class="col-sm-1"><?= $traza['estatus'] ?></div>
                        <div class="col-sm-3">
                            <?php
                            if($traza['proyecto_motivo_correccion'] == "")
                            {
                                echo "N/A";
                            }
                            else
                            {
                                echo $traza['proyecto_motivo_correccion'];
                            }
                            ?>
                        </div>
                        <div class="col-sm-3"><?= $traza['observaciones'] ?></div>
                        <div class="col-sm-1"><?= date("d/m/Y",strtotime($traza['fecha_hora'])) ?></div>
                        <div class="col-sm-1"><?= date("h:i A",strtotime($traza['fecha_hora'])) ?></div>
                        <div class="col-sm-3"><?= $traza['primer_nombre'] ?> <?= $traza['primer_apellido'] ?></div>
                    </div>
                </div>
                <?php  
            }
            else
            {
                ?>
                <div class="alert alert-info" style="background: #FFF;">
                    <div class="row">
                        <div class="col-sm-2"><?= $traza['estatus'] ?></div>
                        <div class="col-sm-3">
                            <?php
                            if($traza['proyecto_motivo_correccion'] == "")
                            {
                                echo "N/A";
                            }
                            else
                            {
                                echo $traza['proyecto_motivo_correccion'];
                            }
                            ?>
                        </div>
                        <div class="col-sm-3"><?= $traza['observaciones'] ?></div>
                        <div class="col-sm-1"><?= date("d/m/Y",strtotime($traza['fecha_hora'])) ?></div>
                        <div class="col-sm-1"><?= date("h:i A",strtotime($traza['fecha_hora'])) ?></div>
                        <div class="col-sm-2"><?= $traza['primer_nombre'] ?> <?= $traza['primer_apellido'] ?></div>
                    </div>
                </div>
                <?php  
            }
            ?>
        <?php endforeach; ?>

        <?php
    }
    
    ?>
    <?php endforeach; ?>
    





    


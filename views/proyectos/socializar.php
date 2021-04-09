<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

?>

<?= $this->render('alertsigepsi') ?>
<?= $this->render('alertconfirmation') ?>

<div class="conten-crud">
	<div class="cintillo">
      <?php echo Html::img('@web/imagenes/cintillo.jpg'); ?>
  	</div>

    <ol style="display: block;" class="breadcrumb">
        <li><a href="<?= Url::to(['proyectos/admin']); ?>">Inicio</a></li>
        <li><a href="#">marcar proyecto como socializado</a></li>
    </ol>

	<h1 class="title-crud">Marcar Proyecto Como Socializado</h1>

	<div class="alert-sigepsi">
		<p>
			Una vez presentada la socialización final de su proyecto usted podrá marcarlo como socializado a través del siguiente formulario, el paso siguiente lo realizará el profesor de proyecto indicando que su proyecto fue culminado de manera exitosa.
			<p>
				<strong>
				Nota: El profesor de proyecto puede solicitar cualquier corrección después de la socialización final. Recomendamos estar atentos al estatus de su proyecto en el sistema.
				</strong>
			</p>
		</p>
	</div><br>

    <?php
    if($model->id_estatus == 97)
    {
        ?>
        <div class="alert-sigepsi" style="background: #fcf8e3; color: #8a6d3b;">
            <p>
               Este proyecto está siendo sometido a corrección antes de ser culminado, por esta razón el sistema solicita al estudiante marcarlo como socializado nuevamente.
            </p>
        </div>
        <?php
    }
    ?>



	<div class="col-sm-12">
		<label for="titulo-proyecto">Título del proyecto</label>
		<div class=" form-control" id="titulo-proyecto">
			<?= $model->titulo ?>
		</div>
	</div><br><br><br><br>

	<?php $form = ActiveForm::begin(); ?>
        <div class="row">
            <div class="col-sm-6">
                <input id="id_proyecto" type="hidden" value="<?= $model->id_proyecto ?>">
            </div>
        </div>


		<div class="col-sm-12">
			<label for="observaciones">Observaciones</label>
			<textarea placeholder="Coloca una observación..." id="observaciones"  class="form-control" id="" cols="30" rows="10"></textarea>
		</div>
    	
        <div class="form-group">
        	<button id="validar_proyecto" style="margin-top: 20px;" class="btn btn-success" type="button">Validar proyecto</button>
        </div>

	<?php ActiveForm::end(); ?>

	<?php foreach ($proyecto as $proyecto): ?>
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
                                ['class' => 'enlace']); //render  ?></p>
        </div>
    </div>
    <?php endforeach; ?>
    

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
        <div class="col-sm-2">
            <p class="alert alert-primary"><strong>Correo Electrónico</strong></p>
        </div>
        <div class="col-sm-1">
            <p style="display: flex; justify-content: center;" class="alert alert-primary"><strong>Estatus</strong></p>
        </div>
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
        <div class="col-sm-2">
            <p><?= $integrantes['email'] ?></p>
        </div>
        <div class="col-sm-1">
            <p><span class="label label-success"><?= $integrantes['id_estatus'] ?></span></p>
        </div>
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

</div>

<?php
$script = <<< JS

    $("#validar_proyecto").click(function(event) {
            
           event.preventDefault(); 

           
           var observaciones = document.getElementById("observaciones").value;
           var id_proyecto = document.getElementById("id_proyecto").value;

           AlertSigepsiConfirm("¿Estas seguro que deseas marcar este proyecto como socializado?", "¡El proyecto se marcara como socializado!", "fas fa-exclamation-circle", "", "Cancelar", "Socializar");

            $("#no").click(function(event) {
                alerta_sigepsi_confirm.style.display = 'none';
                return false;
            });

            $("#si").click(function(event) {
                alerta_sigepsi_confirm.style.display = 'none';
                document.querySelector(".preloader").setAttribute("style", "");
                var url = "sigepsi/web/index.php?r=proyectos/socializado";

                //Verificar validacion
                //---------------------
                var VerficarValidacion = [
                                           
                                            ValidateInputText('observaciones'),
                                            
                                        ];

                for (ver = 0; ver < VerficarValidacion.length; ver++) {
                        if(VerficarValidacion[ver] === false)
                        {
                            event.preventDefault(); // stopping submitting
                            document.querySelector(".preloader").style.display = 'none';
                            return false;
                        }
                        else
                        {

                        }
                }
                //Fin Verificar validacion
                //---------------------


                $.ajax({
                    url: url,
                    type: 'post',
                    dataType: 'json',
                    data: {
                            id_proyecto                :    id_proyecto,
                            observaciones              :    observaciones,
                    }
                })
                .done(function(response) {

                    
                    if(response.data.message == "El proyecto ha sido socializado.")
                    {
                        document.querySelector(".preloader").style.display = "none";
                        AlertSigepsi("El proyecto ha sido socializado", "¡Se ha enviado un correo a cada integrante del proyecto para que esten al tanto de los cambios!", "fas fa-check", "success", "http://localhost:8080/sigepsi/web/index.php?r=proyectos%2Fview&id="+id_proyecto+"");
                    }
                 
                })
                .fail(function() {
                    console.log("error");
                    AlertSigepsi("Ocurrió un error al socializar el proyecto", "¡Intenta nuevamente!", "fas fa-times-circle", "warning");
                    document.querySelector(".preloader").style.display = "none";   
                });
            });

           		
           
    });

      


JS;
$this->registerJs($script);
?>


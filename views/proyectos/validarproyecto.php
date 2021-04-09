<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
$Correcciones = \app\models\ProyectosMotivosCorrecciones::find('accion=:accion', array(':accion'=>2))->all();

$Rechazos = \app\models\ProyectosMotivosRechazos::find()->all();
?>

<?= $this->render('alertsigepsi') ?>
<?= $this->render('alertconfirmation') ?>

<div class="conten-crud">
	<div class="cintillo">
      <?php echo Html::img('@web/imagenes/cintillo.jpg'); ?>
  	</div>

    <ol style="display: block;" class="breadcrumb">
        <li><a href="<?= Url::to(['proyectos/admin']); ?>">Inicio</a></li>
        <li><a href="#">validar proyectos</a></li>
    </ol>

	<h1 class="title-crud">Validar Proyectos</h1>

	<div class="alert-sigepsi">
		<p>
			Este formulario le permitirá aprobar o rechazar el proyecto seleccionado. En la parte inferior podrá observar los datos del proyecto para validar alguna información que considere necesaria.
		</p>
	</div>

	<div class="col-sm-12">
		<label for="titulo-proyecto">Título del proyecto</label>
		<div class=" form-control" id="titulo-proyecto">
			<?= $model->titulo ?>
		</div>
	</div><br><br><br><br>

	<?php $form = ActiveForm::begin(); ?>
		<div class="col-sm-6">
			<input id="id_proyecto" type="hidden" value="<?= $model->id_proyecto ?>">
			<label for="estatus">Validación</label>
			<select class="form-control" name="" id="estatus">
				<option value>Seleccione</option>
				<option value="2">Aprobar</option>
				<option value="98">Corregir</option>
				<option value="99">Rechazar</option>
			</select>
		</div>

		<div id="cont-rechazo" style="display: none;" class="col-sm-6">
			<label for="motivo_rechazo">Motivo Rechazo</label>
			<select class="form-control" name="" id="motivo_rechazo">
				<option value>Seleccione</option>
				<?php
				foreach ($rechazo as $rechazo) 
				{
					?>
					<option value="<?= $rechazo['id_proyecto_motivo_rechazo'] ?>"><?= $rechazo['proyecto_motivo_rechazo'] ?></option>
					<?php
				}
				?>
			</select>
		</div>

		<div id="cont-correccion" style="display: none;" class="col-sm-6">
			<label for="motivo_correccion">Motivo Corrección</label>
			<select class="form-control" name="" id="motivo_correccion">
				<option value>Seleccione</option>
				<?php
				foreach ($correccion as $correccion) 
				{
					?>
					<option value="<?= $correccion['id_proyecto_motivo_correccion'] ?>"><?= $correccion['proyecto_motivo_correccion'] ?></option>
					<?php
				}
				?>
			</select>
		</div><br><br><br><br>

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

	var estatuss = document.getElementById("estatus").value;

	document.getElementById("estatus").addEventListener('change', (event) => {
		if(document.getElementById("estatus").value == 98)
		{
			document.getElementById("cont-correccion").setAttribute("style", "");
		}
		else
		{
			document.getElementById("cont-correccion").style.display = 'none';
		}

		if(document.getElementById("estatus").value == 99)
		{
			document.getElementById("cont-rechazo").setAttribute("style", "");
		}
		else
		{
			document.getElementById("cont-rechazo").style.display = 'none';
		}
	});

	

    $("#validar_proyecto").click(function(event) {
            
           event.preventDefault(); 

           var estatus = document.getElementById("estatus").value;
           var motivo_correccion = document.getElementById("motivo_correccion").value;
           var observaciones = document.getElementById("observaciones").value;
           var id_proyecto = document.getElementById("id_proyecto").value;
           var motivo_rechazo = document.getElementById("motivo_rechazo").value;

           //Si el proyecto se va a corregir
           //----------------------------------
           //----------------------------------
           if(motivo_correccion != "")
           {

           		document.getElementById("motivo_rechazo").value = "";
           		
                AlertSigepsiConfirm("¿Estas seguro que deseas enviar a corrección este proyecto?", "¡El proyecto pasara a estar en estatus de corrección!", "fas fa-exclamation-circle", "", "Cancelar", "Enviar a correción");

                $("#no").click(function(event) {
                    alerta_sigepsi_confirm.style.display = 'none';
                    return false;
                });

                $("#si").click(function(event) {
                    alerta_sigepsi_confirm.style.display = 'none';
                    document.querySelector(".preloader").setAttribute("style", "");
                    var url = "sigepsi/web/index.php?r=proyectos/corregir";

                    //Verificar validacion
                    //---------------------
                    var VerficarValidacion = [
                                               
                                                ValidateNumber('estatus'),
                                                ValidateNumber('motivo_correccion'),
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
                            estatus                    :    estatus,       
                            motivo_correccion          :    motivo_correccion,
                            observaciones              :    observaciones,
                        }
                    })
                    .done(function(response) {
     
                    if(response.data.message == "El proyecto ha sido corregido exitosamente.")
                    {
                        document.querySelector(".preloader").style.display = "none";
                        AlertSigepsi("El proyecto se envió a corrección", "¡Se ha enviado un correo a cada integrante del proyecto para que esten al tanto de las correcciones!", "fas fa-check", "success", "http://localhost:8080/sigepsi/web/index.php?r=proyectos%2Fview&id="+id_proyecto+"");
                    }

                    })
                    .fail(function() {
                        console.log("error");
                        AlertSigepsi("Ocurrió un error al corregir el proyecto", "¡Intenta nuevamente!", "fas fa-times-circle", "warning");
                        document.querySelector(".preloader").style.display = "none";   
                    });
                });

           }

           //Si el proyecto se va a rechazar
           //----------------------------------
           //----------------------------------
           if(motivo_rechazo != "")
           {

                AlertSigepsiConfirm("¿Estas seguro que deseas rechazar este proyecto?", "¡El proyecto pasara a estar en estatus de rechazo!", "fas fa-exclamation-circle", "", "Cancelar", "Rechazar");

                $("#no").click(function(event) {
                    alerta_sigepsi_confirm.style.display = 'none';
                    return false;
                });

                $("#si").click(function(event) {
                    alerta_sigepsi_confirm.style.display = 'none';
                    document.querySelector(".preloader").setAttribute("style", "");

                    document.getElementById("motivo_correccion").value = "";
                    var url = "sigepsi/web/index.php?r=proyectos/rechazo";

                    //Verificar validacion
                    //---------------------
                    var VerficarValidacion = [
                                               
                                                ValidateNumber('estatus'),
                                                ValidateInputText('motivo_rechazo'),
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
                                estatus                    :    estatus,       
                                motivo_rechazo             :    motivo_rechazo,
                                observaciones              :    observaciones,
                        }
                    })
                    .done(function(response) {

                        
                        if(response.data.message == "El proyecto ha sido rechazado.")
                        {
                            document.querySelector(".preloader").style.display = "none";
                            AlertSigepsi("El proyecto ha sido rechazado", "¡Se ha enviado un correo a cada integrante del proyecto para que esten al tanto del rechazo!", "fas fa-check", "success", "http://localhost:8080/sigepsi/web/index.php?r=proyectos%2Fview&id="+id_proyecto+"");
                        }
                     
                    })
                    .fail(function() {
                        console.log("error");
                        AlertSigepsi("Ocurrió un error al rechazar el proyecto", "¡Intenta nuevamente!", "fas fa-times-circle", "warning");
                        document.querySelector(".preloader").style.display = "none";   
                    });
                });

           		
           }

           if(estatus == 2)
           {
                document.getElementById("motivo_correccion").value = "";

                AlertSigepsiConfirm("¿Estas seguro que deseas aprobar este proyecto?", "¡El proyecto pasara a estar en estatus de desarrollo!", "fas fa-exclamation-circle", "", "Cancelar", "Aprobar");

                $("#no").click(function(event) {
                    alerta_sigepsi_confirm.style.display = 'none';
                    return false;
                });

                $("#si").click(function(event) {

                    alerta_sigepsi_confirm.style.display = 'none';
                    document.querySelector(".preloader").setAttribute("style", "");
                    var url = "sigepsi/web/index.php?r=proyectos/aprobar";

                    //Verificar validacion
                    //---------------------
                    var VerficarValidacion = [
                                               
                                                ValidateNumber('estatus'),
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
                                estatus                    :    estatus,       
                                observaciones              :    observaciones,
                        }
                    })
                    .done(function(response) {

                        
                        if(response.data.message == "El proyecto ha sido aprobado.")
                        {
                            document.querySelector(".preloader").style.display = "none";
                            AlertSigepsi("El proyecto ha sido aprobado exitosamente", "¡Se ha enviado un correo a cada integrante del proyecto para que esten al tanto de la aprobación!", "fas fa-check", "success", "http://localhost:8080/sigepsi/web/index.php?r=proyectos%2Fview&id="+id_proyecto+"");
                        }
                     
                    })
                    .fail(function() {
                        console.log("error");
                        AlertSigepsi("Ocurrió un error al aprobar el proyecto", "¡Intenta nuevamente!", "fas fa-times-circle", "warning");
                        document.querySelector(".preloader").style.display = "none";   
                    });
                });

                
                
           }
    });

      


JS;
$this->registerJs($script);
?>


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
?>

<?= $this->render('alertsigepsi') ?>
<?= $this->render('alertconfirmation') ?>

<div class="conten-crud">
	<div class="cintillo">
      <?php echo Html::img('@web/imagenes/cintillo.jpg'); ?>
  	</div>

    <ol style="display: block;" class="breadcrumb">
        <li><a href="<?= Url::to(['proyectos/admin']); ?>">Inicio</a></li>
        <li><a href="#">corregir proyectos</a></li>
    </ol>

	<h1 class="title-crud">Corregir Proyectos</h1>

	<div class="alert-sigepsi" style="background: #fcf8e3; color: #8a6d3b;">
		<p>
			Esta propuesta de proyecto fue sometida a corrección, por favor realice los cambios necesarios y en el campo de observaciones ubicado al final del formulario escriba un mensaje para que el profesor de proyecto esté al tanto del cambio que usted realizó.
		</p>
	</div>

	<?php $form = ActiveForm::begin(['enableClientValidation'=>false]); ?>
		<div class="row">
			<div class="col-sm-6">
				<input type="hidden" id="id_proyecto" value="<?= $model->id_proyecto ?>">
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
		</div>

		<div class="row">
			<?= $form->field($model, 'id_estatus')->textInput()->hiddenInput()->label(false) ?>

			<div class="con">
				<?= $form->field($model, 'id_comunidad')->textInput() ?>
				<i data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample" style="margin-left: 10px; cursor: pointer;" class="fas fa-search"></i>
			</div>

			<div style="display: none;" class="datos-comunidades">

			</div>

			<div class="collapse" id="collapseExample" style="width: 97%; margin: auto;">
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
		</div>

		<div class="row">
			<div class="col-sm-4">
               <div class="form-group field-proyectos-fecha_inicio">
                        <label class="control-label" for="proyectos-fecha_inicio">Fecha Fin</label>
                        <input class="form-control" type="date" id="proyectos-fecha_inicio" value="<?= $model->fecha_inicio ?>">
                        <div class="help-block"></div>
                    </div>      
            </div>

            <div class="col-sm-4">
                 <div class="form-group field-proyectos-fecha_fin">
                        <label class="control-label" for="proyectos-fecha_fin">Fecha Fin</label>
                        <input class="form-control" type="date" id="proyectos-fecha_fin" value="<?= $model->fecha_fin ?>">
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
		</div>

		<div class="row">
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
		</div>

		<div class="row">
		
                <?= $form->field($model, 'conclusiones')->textarea(['rows' => 6])->hiddenInput()->label(false) ?>

                <?= $form->field($model, 'recomendaciones')->textarea(['rows' => 6])->hiddenInput()->label(false) ?>

                <?= $form->field($model, 'formato_informe_final')->textInput()->hiddenInput()->label(false) ?>

                <?php $propuesta = "Propuesta"; ?>

                <?= $form->field($model, 'formato_propuesta')->textInput(['value' => $propuesta])->hiddenInput()->label(false) ?>

                <?php $created_by = Yii::$app->user->identity->username ?>

                <?= $form->field($model, 'created_by')->textInput(['value' => $created_by])->hiddenInput()->label(false) ?>

                <?= $form->field($model, 'created_at')->textInput()->hiddenInput()->label(false) ?>

                <?= $form->field($model, 'updated_by')->textInput()->hiddenInput()->label(false) ?>

                <?= $form->field($model, 'updated_at')->textInput()->hiddenInput()->label(false) ?>
		</div>

		<label for="observaciones">Observaciones</label>
		<textarea class="form-control" id="observaciones" placeholder="Escribe una observación..." name="" id="" cols="30" rows="10"></textarea><br>

		<button class="btn btn-success" id="button_registrar_proyecto">Corregir Proyecto</button>
	<?php ActiveForm::end(); ?>


</div>

<?php
$script = <<< JS

    $("#proyectos-id_comunidad").prop('disabled', true);
    //$("#proyectos-fecha_inicio").attr('readonly', "readonly");
    //$("#proyectos-fecha_fin").attr('readonly', "readonly");

     //Limpiar campos (estado municipio parroquia de la comunidad)
     //--------------------------------------------------------
     //--------------------------------------------------------
      var comunidad_estado = document.getElementById("proyectos-comunidad_id_estado");
      var comunidad_municipio = document.getElementById("proyectos-comunidad_id_municipio");
      var comunidad_parroquia = document.getElementById("proyectos-comunidad_id_parroquia");

      comunidad_estado.innerHTML = '<option value="">Seleccione</option><option value="1">DISTRITO CAPITAL</option><option value="15">MIRANDA</option><option value="24">VARGAS</option>';

      comunidad_municipio.innerHTML = '<option value="">Seleccione</option>';

      comunidad_parroquia.innerHTML = '<option value="">Seleccione</option>';


      //Fin Limpiar campos (estado municipio parroquia de la comunidad)
      //--------------------------------------------------------
      //--------------------------------------------------------


      //Filtrar municipio mediante el estado (Filtro comunidad)
      //------------------------------------
      //------------------------------------
      $("#proyectos-comunidad_id_estado").change(function(event) {
            
            var estado_comunidad = $("#proyectos-comunidad_id_estado").val();
            var url = "sigepsi/web/index.php?r=proyectos/filtroestado";
        
            $.ajax({
                url: url,
                type: 'post',
                dataType: 'json',
                data: {
                        estado_comunidad                : estado_comunidad
                }
            })
            .done(function(response) {

                if (response.data.success == true) 
                {
                    //Limpiar select de municipios
                    comunidad_municipio.innerHTML = '<option value="">Seleccione</option>';


                    for (es = 0; es < response.data.estado.length; es++)
                    {
                        
                            //Crea el elemento <option> dentro del select municipio
                            var itemOption = document.createElement('option');

                                
                            //Contenido de los <option> del select municipios
                            var municipio = document.createTextNode(response.data.estado[es].municipio); 
                            var id_municipio = document.createTextNode(response.data.estado[es].id_municipio); 
                        
                            //Crear atributo value para los elemento option
                            var attValue = document.createAttribute("value");
                            attValue.value = response.data.estado[es].id_municipio;
                            itemOption.setAttributeNode(attValue);


                            //Añadir contenido a los <option> creados 
                            itemOption.appendChild(municipio);
                         
                            comunidad_municipio.appendChild(itemOption);


                    }
                }
             
            })
            .fail(function() {
                console.log("error");
                   
            });
        });
        //Fin Filtrar municipio mediante el estado (Filtro comunidad)
        //------------------------------------
        //------------------------------------

        //Filtrar parroquia mediante el municipio (Filtro comunidad)
      //------------------------------------
      //------------------------------------
      $("#proyectos-comunidad_id_municipio").change(function(event) {
            
            var municipio_comunidad = $("#proyectos-comunidad_id_municipio").val();
            var url = "sigepsi/web/index.php?r=proyectos/filtroparroquia";
        
            $.ajax({
                url: url,
                type: 'post',
                dataType: 'json',
                data: {
                        municipio_comunidad                : municipio_comunidad
                }
            })
            .done(function(response) {

                if (response.data.success == true) 
                {
                    //Limpiar select de parroquias
                    comunidad_parroquia.innerHTML = '<option value="">Seleccione</option>';


                    for (es = 0; es < response.data.parroquia.length; es++)
                    {
                        
                            //Crea el elemento <option> dentro del select parroquia
                            var itemOption = document.createElement('option');

                                
                            //Contenido de los <option> del select parroquias
                            var parroquia = document.createTextNode(response.data.parroquia[es].parroquia); 
                            var id_parroquia = document.createTextNode(response.data.parroquia[es].id_parroquia); 
                    

                            //Crear atributo value para los elemento option
                            var attValue = document.createAttribute("value");
                            attValue.value = response.data.parroquia[es].id_parroquia;
                            itemOption.setAttributeNode(attValue);


                            //Añadir contenido a los <option> creados 
                            itemOption.appendChild(parroquia);
                         
                            comunidad_parroquia.appendChild(itemOption);


                    }
                }
             
            })
            .fail(function() {
                console.log("error");
                   
            });
        });
        //Fin Filtrar parroquia mediante el municipio (Filtro comunidad)
        //------------------------------------
        //------------------------------------


        //Limpiar campos (estado municipio parroquia del proyecto)
        //--------------------------------------------------------
        //--------------------------------------------------------
        var proyecto_estado = document.getElementById("proyectos-id_estado");
        var proyecto_municipio = document.getElementById("proyectos-id_municipio");
        var proyecto_parroquia = document.getElementById("proyectos-id_parroquia");

        proyecto_estado.innerHTML = '<option value="">Seleccione</option><option value="1">DISTRITO CAPITAL</option><option value="15">MIRANDA</option><option value="24">VARGAS</option>';

        proyecto_municipio.innerHTML = '<option value="">Seleccione</option>';

        proyecto_parroquia.innerHTML = '<option value="">Seleccione</option>';

        //Fin Limpiar campos (estado municipio parroquia del proyecto)
        //--------------------------------------------------------
        //--------------------------------------------------------



        //Filtrar municipio mediante el estado (Filtro proyecto)
      //------------------------------------
      //------------------------------------
      $("#proyectos-id_estado").change(function(event) {
            
            var estado_proyecto = $("#proyectos-id_estado").val();
            var url = "sigepsi/web/index.php?r=proyectos/filtroestadoproyecto";
        
            $.ajax({
                url: url,
                type: 'post',
                dataType: 'json',
                data: {
                        estado_proyecto                : estado_proyecto
                }
            })
            .done(function(response) {

                if (response.data.success == true) 
                {
                    //Limpiar select de municipios
                    proyecto_municipio.innerHTML = '<option value="">Seleccione</option>';


                    for (es = 0; es < response.data.estado.length; es++)
                    {
                        
                            //Crea el elemento <option> dentro del select municipio
                            var itemOption = document.createElement('option');

                                
                            //Contenido de los <option> del select municipios
                            var municipio = document.createTextNode(response.data.estado[es].municipio); 
                            var id_municipio = document.createTextNode(response.data.estado[es].id_municipio); 
                        
                            //Crear atributo value para los elemento option
                            var attValue = document.createAttribute("value");
                            attValue.value = response.data.estado[es].id_municipio;
                            itemOption.setAttributeNode(attValue);


                            //Añadir contenido a los <option> creados 
                            itemOption.appendChild(municipio);
                         
                            proyecto_municipio.appendChild(itemOption);


                    }
                }
             
            })
            .fail(function() {
                console.log("error");
                   
            });
        });
        //Fin Filtrar municipio mediante el estado (Filtro proyecto)
        //------------------------------------
        //------------------------------------


         //Filtrar parroquia mediante el municipio (Filtro comunidad)
      //------------------------------------
      //------------------------------------
      $("#proyectos-id_municipio").change(function(event) {
            
            var municipio_proyecto = $("#proyectos-id_municipio").val();
            var url = "sigepsi/web/index.php?r=proyectos/filtroparroquiaproyecto";
        
            $.ajax({
                url: url,
                type: 'post',
                dataType: 'json',
                data: {
                        municipio_proyecto                : municipio_proyecto
                }
            })
            .done(function(response) {

                if (response.data.success == true) 
                {
                    //Limpiar select de parroquias
                    proyecto_parroquia.innerHTML = '<option value="">Seleccione</option>';


                    for (es = 0; es < response.data.parroquia.length; es++)
                    {
                        
                            //Crea el elemento <option> dentro del select parroquia
                            var itemOption = document.createElement('option');

                                
                            //Contenido de los <option> del select parroquias
                            var parroquia = document.createTextNode(response.data.parroquia[es].parroquia); 
                            var id_parroquia = document.createTextNode(response.data.parroquia[es].id_parroquia); 
                    

                            //Crear atributo value para los elemento option
                            var attValue = document.createAttribute("value");
                            attValue.value = response.data.parroquia[es].id_parroquia;
                            itemOption.setAttributeNode(attValue);


                            //Añadir contenido a los <option> creados 
                            itemOption.appendChild(parroquia);
                         
                            proyecto_parroquia.appendChild(itemOption);


                    }
                }
             
            })
            .fail(function() {
                console.log("error");
                   
            });
        });
        //Fin Filtrar parroquia mediante el municipio (Filtro comunidad)
        //------------------------------------
        //------------------------------------



       //Registrar Proyecto en la base de datos
       //--------------------------------------
       //--------------------------------------
       $("#button_registrar_proyecto").click(function(event) {
            
            event.preventDefault(); // stopping submitting

            AlertSigepsiConfirm("¿Estas seguro que deseas corregir este proyecto?", "¡Si confirmas el proyecto quedara a la espera de una nueva validación!", "fas fa-exclamation-circle", "", "Cancelar", "Corregir");


            var id_necesidad                = document.getElementById('proyectos-id_necesidad').value = 0;
            var titulo                      = document.getElementById('proyectos-titulo').value;
            var problema                    = document.getElementById('proyectos-problema').value;
            var objetivo_general            = document.getElementById('proyectos-objetivo_general').value;
            var objetivos_especificos       = document.getElementById('proyectos-objetivos_especificos').value;
            var id_comunidad                = document.getElementById('proyectos-id_comunidad').value;
            var id_estatus                  = document.getElementById('proyectos-id_estatus').value = 1;
            var conclusiones                = document.getElementById('proyectos-conclusiones').value = "";
            var recomendaciones             = document.getElementById('proyectos-recomendaciones').value = "";
            var fecha_inicio                = document.getElementById('proyectos-fecha_inicio').value;
            var fecha_fin                   = document.getElementById('proyectos-fecha_fin').value;
            var id_especialidad             = document.getElementById('proyectos-id_especialidad').value;
            var id_parroquia                = document.getElementById('proyectos-id_parroquia').value;
            var formato_informe_final       = document.getElementById('proyectos-formato_informe_final').value = "";
            var formato_propuesta           = document.getElementById('proyectos-formato_propuesta').value = "";
            var direccion                   = document.getElementById('proyectos-direccion').value;
            var cedula_tutor_comunitario    = document.getElementById('proyectos-cedula_tutor_comunitario').value;
            var tutor_comunitario           = document.getElementById('proyectos-tutor_comunitario').value;
            var id_tutor                    = document.getElementById('proyectos-id_tutor').value;
            var sinopsis                    = document.getElementById('proyectos-sinopsis').value;
            var id_linea_investigacion      = document.getElementById('proyectos-id_linea_investigacion').value;
            var id_trayecto                 = document.getElementById('proyectos-id_trayecto').value;
            var created_by                  = document.getElementById('proyectos-created_by').value;
            var estado                      = document.getElementById('proyectos-id_estado').value;
            var municipio                   = document.getElementById('proyectos-id_municipio').value;
            var observaciones               = document.getElementById("observaciones").value;
            var id_proyecto                 = document.getElementById("id_proyecto").value;

            $("#no").click(function(event) {
                alerta_sigepsi_confirm.style.display = 'none';
                return false;
            });

            $("#si").click(function(event) {

                document.querySelector(".preloader").setAttribute("style", "");
                var url = "sigepsi/web/index.php?r=proyectos/correccionpropuesta";

                alerta_sigepsi_confirm.style.display = 'none';

                //Verificar validacion
                //---------------------
                var VerficarValidacion = [
                                            //ValidateInputText('proyectos-titulo'), 
                                            //ValidateInputText('proyectos-problema'),
                                            //ValidateInputText('proyectos-objetivo_general'),
                                            //ValidateInputText('proyectos-objetivos_especificos'),
                                            //ValidateInputText('proyectos-sinopsis'),
                                            ValidateInputText('proyectos-id_comunidad'),
                                            ValidateDate('proyectos-fecha_inicio'),
                                            ValidateDate('proyectos-fecha_fin'),
                                            ValidateInputText('proyectos-id_especialidad'),
                                            ValidateInputText('proyectos-id_trayecto'),
                                            ValidateInputText('proyectos-id_linea_investigacion'),
                                            ValidateInputText('proyectos-id_estado'),
                                            ValidateInputText('proyectos-id_municipio'),
                                            ValidateInputText('proyectos-id_parroquia'),
                                            ValidateInputText('proyectos-direccion'),
                                            ValidateNumber('proyectos-cedula_tutor_comunitario'),
                                            ValidateInputText('proyectos-tutor_comunitario'),
                                            ValidateInputText('proyectos-id_tutor'),
                                            ValidateInputText('observaciones'),

                                        ];

                for (ver = 0; ver < VerficarValidacion.length; ver++) {
                        if(VerficarValidacion[ver] === false)
                        {
                            document.querySelector(".preloader").style.display = 'none';
                            return false;
                        }
                        else
                        {

                        }
                }
                //Fin Verificar validacion
                //---------------------

                //Fin Verificar que los estudiantes esten asigandos al proyecto
                //---------------------------------------------------------
            
                $.ajax({
                    url: url,
                    type: 'post',
                    dataType: 'json',
                    data:   {
                                id_necesidad                :    id_necesidad,
                                titulo                      :    titulo,
                                problema                    :    problema,
                                objetivo_general            :    objetivo_general,
                                objetivos_especificos       :    objetivos_especificos,
                                id_estatus                  :    id_estatus,
                                id_comunidad                :    id_comunidad,
                                id_estatus                  :    id_estatus,
                                conclusiones                :    conclusiones,
                                recomendaciones             :    recomendaciones,
                                fecha_inicio                :    fecha_inicio,
                                fecha_fin                   :    fecha_fin,
                                id_especialidad             :    id_especialidad,
                                id_parroquia                :    id_parroquia,
                                formato_informe_final       :    formato_informe_final,
                                formato_propuesta           :    formato_propuesta,
                                direccion                   :    direccion,
                                cedula_tutor_comunitario    :    cedula_tutor_comunitario,
                                tutor_comunitario           :    tutor_comunitario,
                                id_tutor                    :    id_tutor,
                                sinopsis                    :    sinopsis,
                                id_linea_investigacion      :    id_linea_investigacion,
                                id_trayecto                 :    id_trayecto,
                                created_by                  :    created_by,
                                observaciones               :    observaciones,
                                id_proyecto                 :    id_proyecto,
                            }
                })
                .done(function(response) {

                    if (response.data.message == "El proyecto ha sido corregido.") 
                    {
                        document.querySelector(".preloader").style.display = 'none';
                        AlertSigepsi("Proyecto corregido exitosamente", "Se envió una notificación al correo de cada integrante", "fas fa-check", "success", "http://localhost:8080/sigepsi/web/index.php?r=proyectos%2Fview&id="+id_proyecto+"");
                    } 
                    
                })
                .fail(function() {
                    console.log("error");
                        document.querySelector(".preloader").style.display = 'none';
                        AlertSigepsi("Ocurrió un error al corregir el proyecto", "¡Intenta nuevamente!", "fas fa-times-circle", "warning");
                });   
            });
        });
        //Fin registrar proyecto en la base de datos
        //------------------------------------------
        //------------------------------------------


        //Buscar comunidades (Verificar si existen en la base de datos)
        //-------------------------------------------------------------
        //-------------------------------------------------------------
        $("#button_buscar_comunidad").click(function(event) {
            document.querySelector(".preloader").setAttribute("style", "");
            event.preventDefault(); // stopping submitting

            var comunidad_id_estado             = document.getElementById('proyectos-comunidad_id_estado').value;
            var comunidad_id_municipio          = document.getElementById('proyectos-comunidad_id_municipio').value;
            var comunidad_id_parroquia          = document.getElementById('proyectos-comunidad_id_parroquia').value;
            var table_comunidades               = document.getElementById('table-comunidades');
            var table_comunidadesClass          = document.querySelector(".table-comunidades tbody");

            var url = "sigepsi/web/index.php?r=proyectos/comunidades";

            //Verificar validacion
            //---------------------
            var VerficarValidacion = [
                                        ValidateInputText('proyectos-comunidad_id_estado'), 
                                        ValidateInputText('proyectos-comunidad_id_municipio'),
                                        ValidateInputText('proyectos-comunidad_id_parroquia'),
                                       
                                    ];

            for (ver = 0; ver < VerficarValidacion.length; ver++) {
                    if(VerficarValidacion[ver] === false)
                    {
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
                        comunidad_id_estado                 : comunidad_id_estado,
                        comunidad_id_municipio              : comunidad_id_municipio,
                        comunidad_id_parroquia              : comunidad_id_parroquia
                }
            })
            .done(function(response) {


                if (response.data.success == true) 
                {
                    if(response.data.comunidades == false)
                    {
                        document.querySelector(".preloader").style.display = 'none';
                        AlertSigepsi("Comunidad no encontrada", "¡No existen comunidades registradas para esta parroquia!", "fas fa-hotel", "warning");
                    }
                    else
                    {
                        document.getElementById("table-comunidades").setAttribute("style", "");
                        document.querySelector(".preloader").style.display = 'none';
                        AlertSigepsi("Comunidad encontrada", "", "fas fa-hotel", "success");
                        for (m = 0; m < response.data.comunidades.length; m++) 
                        {

                            var contador = m;

                            var nameElementAttr = "comunidad_" + contador;

                            var btnComunidadSelect = "btn_comunidad_" + contador; 
    
                            //Verificar que las comunidades no se repitan
                            //-------------------------------------------
                            //-------------------------------------------
                            var verificar = "." + nameElementAttr + " td";

                            var verificar2 = nameElementAttr;

                            var analizar = document.querySelectorAll(verificar);

                            for (b = 0; b < analizar.length; b++)
                            {

                                console.log(contador);
                                if(analizar[2].textContent != response.data.comunidades.telefono && analizar[0].textContent != response.data.comunidades.telefono)
                                {
                                    if(contador == 0)
                                    {
                                        table_comunidadesClass.innerHTML = "";
                                        table_comunidadesClass.innerHTML = "<tr><th>Nombre</th><th>Dirección</th><th>Teléfono</th><th>Persona de Contacto</th><th style='text-align:center;'>Acciones</th></tr>";
                                    }
                                    else
                                    {
                                        
                                    }
                                }
                                else
                                {
                                   return false;
                                }   
                            }
                            //Fin Verificar que las comunidades no se repitan
                            //-------------------------------------------
                            //-------------------------------------------


                            //document.getElementBiId(nameElementAttr).removeChild();

                            //Crea el elemento <tr> dentro de la tabla comunidades
                            var itemTr = document.createElement('tr');

                            //Crea el elemento <td> dentro de la tabla comunidades
                            var itemTdNombre = document.createElement('td');
                            var itemTdDireccion = document.createElement('td');
                            var itemTdTelefono = document.createElement('td');
                            var itemTdPersonaContacto = document.createElement('td');
                            var itemTdAccion = document.createElement('td');
                                
                            //Contenido de los td de la tabla comunidades
                            var nombre = document.createTextNode(response.data.comunidades[m].nombre); 
                            var direccion = document.createTextNode(response.data.comunidades[m].direccion); 
                            var telefono = document.createTextNode(response.data.comunidades[m].telefono);
                            var persona_contacto = document.createTextNode(response.data.comunidades[m].persona_contacto);


                            //Crear atributo id para los elemento tr
                            var attId = document.createAttribute("id");
                            attId.value = nameElementAttr;
                            itemTr.setAttributeNode(attId);

                            //Crear atributo class para los elementos tr
                            var attClass = document.createAttribute("class");
                            attClass.value = nameElementAttr;
                            itemTr.setAttributeNode(attClass);

                             //Crear atributo class para los td accion
                            var attClass = document.createAttribute("class");
                            attClass.value = "accion";
                            itemTdAccion.setAttributeNode(attClass);

                            
                            table_comunidadesClass.appendChild(itemTr);

                            //Selecciona por medio del id los <tr> creados
                            var SelectTr = document.getElementById(nameElementAttr);

                                
                            //Añadir a los <td> a los <tr> creados
                            SelectTr.appendChild(itemTdNombre);
                            SelectTr.appendChild(itemTdDireccion);
                            SelectTr.appendChild(itemTdTelefono);
                            SelectTr.appendChild(itemTdPersonaContacto);
                            SelectTr.appendChild(itemTdAccion);

             

                            //Añade contenido a los <td> creados
                            itemTdNombre.appendChild(nombre);
                            itemTdDireccion.appendChild(direccion); 
                            itemTdTelefono.appendChild(telefono);
                            itemTdPersonaContacto.appendChild(persona_contacto);
                            itemTdAccion.innerHTML = '<a href="#" id="'+btnComunidadSelect+'" data-id="'+response.data.comunidades[m].id_comunidad+'" data-nombre="'+response.data.comunidades[m].nombre+'" data-direccion="'+response.data.comunidades[m].direccion+'" data-telefono="'+response.data.comunidades[m].telefono+'" data-persona="'+response.data.comunidades[m].persona_contacto+'" data-estado="'+response.data.comunidades[m].estado+'" data-municipio="'+response.data.comunidades[m].municipio+'" data-parroquia="'+response.data.comunidades[m].parroquia+'" class="btn btn-sm btn-success selector"> Seleccionar </a>';
                        }

                        

                    }

                } 
                
            })
            .fail(function() {
                console.log("error");
                    document.querySelector(".preloader").style.display = 'none';
                    AlertSigepsi("Comunidad no encontrada", "¡Intenta nuevamente!", "fas fa-home", "warning");
            });
        
        });
        //Fin buscar comunidades (Verificar en la base de datos)
        //------------------------------------------------------
        //------------------------------------------------------


        //Elegir comunidad
        //---------------
        //---------------
        $(document).ready(function(){
            $('body').on('click', '.selector', function(e){
                e.preventDefault();

                AlertSigepsi("Comunidad seleccionada", "¿Quieres continuar llenando los campos?", "fas fa-check", "success");

                var contComunidad = document.querySelector(".datos-comunidades");
                var inputHiden = document.getElementById("proyectos-id_comunidad");
                var labelInput = document.querySelector(".field-proyectos-id_comunidad label");
                
                var nombreSet = $(this).attr('data-nombre');
                var direccionSet = $(this).attr('data-direccion');
                var estadoSet = $(this).attr('data-estado');
                var municipioSet = $(this).attr('data-municipio');
                var parroquiaSet = $(this).attr('data-parroquia');
                var idSet = $(this).attr('data-id');

                contComunidad.setAttribute("style", "");
                inputHiden.setAttribute("type", "hidden");
                inputHiden.setAttribute("value", idSet);  
                labelInput.setAttribute("style", "margin:0px !important");
                document.querySelector(".field-proyectos-id_comunidad").style.margin = "0px";
                labelInput.style.display = "none";

                $('#collapseExample').collapse('hide');

                contComunidad.innerHTML = '<p><strong>Nombre de la comunidad: </strong>'+nombreSet+ " " +'</p> <p><strong>Estado: </strong> '+estadoSet+' <strong> &nbsp;&nbsp;Municipio: </strong> '+municipioSet+' <strong> &nbsp;&nbsp;Parroquia: </strong> '+parroquiaSet+' </p><p><strong>Dirección: </strong> '+direccionSet+'</p>'; 
           })
        })
        //Fin elegir comunidad
        //--------------------
        //--------------------



JS;
$this->registerJs($script);
?>



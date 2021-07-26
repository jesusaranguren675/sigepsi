<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\assets\ComunidadesAsset;
ComunidadesAsset::register($this);

$tipos_comunidades = \app\models\TiposComunidades::find()->all();
$estados = \app\models\Estados::find()->all();
$municipios = \app\models\Municipios::find()->all();
$parroquias = \app\models\Parroquias::find()->all();
/* @var $this yii\web\View */
/* @var $model app\models\Comunidades */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="comunidades-form">

    <?php $form = ActiveForm::begin([
        //'enableClientValidation' => false,
        //'enableAjaxValidation' => false,
    ]); ?>

    <div class="row">
        <div class="col-sm-4">
            <?= $form->field($model, 'rif')->textInput(['maxlength' => true]) ?>
        </div>

        <div class="col-sm-4">
            <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>
        </div>

        <div class="col-sm-4">
            <?= $form->field($model, "id_tipo_comunidad")->dropDownList(
                             ArrayHelper::map($tipos_comunidades, 'id_tipo_comunidad', 'tipo_comunidad'),
                             ['prompt' => 'Seleccione']);?>         
        </div>
    </div>
    
    <div class="row">
        <div class="col-sm-4">
            <?= $form->field($model, 'telefono_contacto')->textInput() ?>
        </div>

        <div class="col-sm-4">
            <?= $form->field($model, 'persona_contacto')->textInput(['maxlength' => true]) ?>
        </div>

        <div class="col-sm-4">
            <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    
    <div class="row">
        <div class="col-sm-4">
            <?= $form->field($model, "id_estado")->dropDownList(
                             ArrayHelper::map($estados, 'id_estado', 'estado'),
                             ['prompt' => 'Seleccione']);?>
        </div>

        <div class="col-sm-4">
            <?= $form->field($model, "id_municipio")->dropDownList(
                             ArrayHelper::map($municipios, 'id_municipio', 'municipio'),
                             ['prompt' => 'Seleccione']);?>
        </div>

        <div class="col-sm-4">
            <?= $form->field($model, "id_parroquia")->dropDownList(
                             ArrayHelper::map($parroquias, 'id_parroquia', 'parroquia'),
                             ['prompt' => 'Seleccione']);?>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6">

            <?php $estatus = [1 => 'Activa', 2 => 'Inactiva']; ?>

            <?= $form->field($model, 'id_estatus')->dropDownList($estatus, ['prompt' => 'Seleccione' ]); ?>
        </div>

        <div class="col-sm-6">
            <?= $form->field($model, 'direccion')->textArea(['maxlength' => true]) ?>
        </div>
    </div>


    <!-- <?= $form->field($model, 'id_user')->textInput([]) ?>-->

    

    <div class="form-group">
        <button id="registrar_comunidad" class="btn btn-success"><i class="fas fa-save"></i> Guardar</button>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
$script = <<< JS

     //Limpiar campos (estado municipio parroquia de la comunidad)
     //--------------------------------------------------------
      var comunidad_estado = document.getElementById("comunidades-id_estado");
      var comunidad_municipio = document.getElementById("comunidades-id_municipio");
      var comunidad_parroquia = document.getElementById("comunidades-id_parroquia");

      comunidad_estado.innerHTML = '<option value="">Seleccione</option><option value="1">DISTRITO CAPITAL</option><option value="15">MIRANDA</option><option value="24">VARGAS</option>';

      comunidad_municipio.innerHTML = '<option value="">Seleccione</option>';

      //comunidad_parroquia.innerHTML = '<option value="">Seleccione</option>';


      //Fin Limpiar campos (estado municipio parroquia de la comunidad)
      //--------------------------------------------------------
      
      //Registrar Comunidad
      //-------------------

      $("#registrar_comunidad").click(function(event) {

            //document.querySelector(".preloader").setAttribute("style", "");
            event.preventDefault(); 
            

            var rif = document.getElementById("comunidades-rif").value;
            var nombre = document.getElementById("comunidades-nombre").value;
            var id_tipo_comunidad = document.getElementById("comunidades-id_tipo_comunidad").value;
            var telefono_contacto = document.getElementById("comunidades-telefono_contacto").value;
            var persona_contacto = document.getElementById("comunidades-persona_contacto").value;
            var email = document.getElementById("comunidades-email").value;
            var id_parroquia = document.getElementById("comunidades-id_parroquia").value;
            var direccion = document.getElementById("comunidades-direccion").value;
            var id_estatus = document.getElementById("comunidades-id_estatus").value;


            //Contiene la ruta del controlador que procesara los datos enviados mediante el formulario
            //Debemos tomar en cuenta que esta ruta la obtenemos del atributo action que corresponde al formulario
            //-----------------------------------------------------------------------------------------

            var url = document.getElementById("w0").getAttribute("action");

            //Verificar validacion
            //---------------------
            
            if(rif == "" || nombre == "" || id_tipo_comunidad == "" || telefono_contacto == "" || persona_contacto == "" || email == "" || id_parroquia == "" || direccion == "")
            {
                Swal.fire(
                   'Completa los campos requeridos',
                   '',
                   'error'
                )

                return false;
            }
        
         $.ajax({
                url: url,
                type: 'post',
                dataType: 'json',
                data: {
                            rif                         : rif,
                            nombre                      : nombre,
                            id_tipo_comunidad           : id_tipo_comunidad,
                            telefono_contacto           : telefono_contacto,
                            persona_contacto            : persona_contacto,
                            email                       : email,
                            id_parroquia                : id_parroquia,
                            direccion                   : direccion,
                            id_estatus                  : id_estatus,
                        
                }
            })
            .done(function(response) {

                if (response.data.success == true) 
                {
                    Swal.fire(
                    response.data.message,
                    '<a href="http://localhost/sigepsi/web/index.php?r=comunidades%2Fview&id='+response.data.id+'">Visualizar el registro modificado</a>',
                    'success'
                    )
                }
                else
                {
                   Swal.fire(
                   response.data.message,
                   '<a href="http://localhost/sigepsi/web/index.php?r=comunidades/index">Enviar un email a soporte sigepsi</a>',
                   'error'
                   )
                }
             
            })
            .fail(function() {
                console.log("error");
            });
     });

     //Fin registrar comunidad
     //-----------------------

      //Filtrar municipio mediante el estado (Filtro comunidad)
      //------------------------------------
      //------------------------------------
      $("#comunidades-id_estado").change(function(event) {
            
            var estado_comunidad = $("#comunidades-id_estado").val();
            var url = "localhost/sigepsi/web/index.php?r=comunidades/filtroestado";
        
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
      $("#comunidades-id_municipio").change(function(event) {
            
            var municipio_comunidad = $("#comunidades-id_municipio").val();
            var url = "localhost/sigepsi/web/index.php?r=comunidades/filtroparroquia";
        
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




JS;
$this->registerJs($script);
?>

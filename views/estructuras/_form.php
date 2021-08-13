<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
$carreras = \app\models\Carreras::find()->all();
$trayectos = \app\models\Trayectos::find()->all();
$lineas_investigacion = \app\models\Lineasinvestigacion::find()->all();

/* @var $this yii\web\View */
/* @var $model app\models\Estructuras */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="estructuras-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
    	<div class="col-sm-6">
    		<?= $form->field($model, "id_carrera")->dropDownList(
               ArrayHelper::map($carreras, 'id_carrera', 'carrera'),
               ['prompt' => 'Seleccione']);?>
    	</div>

    	<div class="col-sm-6">
    		<?= $form->field($model, "id_trayecto")->dropDownList(
                    ArrayHelper::map($trayectos, 'id_trayecto', 'trayecto'),
                    ['prompt' => 'Seleccione']);?>
    	</div>

    </div>

    <p style="display: none;" class="alert alert-success" id="titulo-items"></p>
    <div class="d-flex flex-row bd-highlight mb-3" id="estructuras">
		
	</div>

    <div class="row">
    	<div class="col-sm-6">
    		<?= $form->field($model, "id_linea_investigacion")->dropDownList(
                    ArrayHelper::map($lineas_investigacion, 'id_linea_investigacion', 'linea_investigacion'),
                    ['prompt' => 'Seleccione']);?>
    	</div>


   	 	<div class="col-sm-6">
   	 		<?= $form->field($model, 'peso')->textInput() ?>
   	 	</div>	
    </div>



    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
$script = <<< JS

      //Registrar Comunidad
      //-------------------

      $("#estructuras-id_trayecto").change(function(event) {

      	document.getElementById("estructuras").innerHTML = "";

        var id_carrera = document.getElementById("estructuras-id_carrera").value;
        var id_trayecto = document.getElementById("estructuras-id_trayecto").value;
        var id_linea_investigacion = document.getElementById("estructuras-id_linea_investigacion").value;
     
     	//ruta del controlador que procesara los datos enviados via ajax
        var url = "http://localhost/sigepsi/web/index.php?r=estructuras%2Ffiltroestructuras";
        
        $.ajax({
        	url: url,
        	type: 'post',
        	dataType: 'json',
        	data: {
        		id_carrera                  : id_carrera,
        		id_trayecto                 : id_trayecto,
        	}
        	})
        	.done(function(response) {

        		if (response.data.success == true) 
        		{
        		
        		   var titulo_items = document.getElementById("titulo-items");

        		   titulo_items.style.display = 'block';

        		   titulo_items.innerHTML = '<i class="fas fa-exclamation-circle"></i> Estos son los items que serán evaluados, correspondientes a la carrera y trayecto seleccionado: ';

                   for (es = 0; es < response.data.estructuras.length; es++)
                    {
                       //Etiqueta <p>
                       var p = document.createElement('p');

                       var i = document.createElement('i');


                       //Clase que sera insertada en la etiqueta <p>
                       var attClass = document.createAttribute("class");
                       attClass.value = 'p-2 bd-success text-white bg-primary';
                       p.setAttributeNode(attClass);

                       p.appendChild(i);

                       //Clase que sera insertada en la etiqueta <i>
                       var classi = document.createAttribute("class");
                       classi.value = 'fas fa-check text-success';
                       i.setAttributeNode(classi);

                       //Texto que sera insertado en la etiqueta <p>
                       var item = document.createTextNode(response.data.estructuras[es].item);

                       //Accedemos al contenedor donde se colocara la etiqueta <p>
                       document.getElementById("estructuras").appendChild(p); 

                       //Agregamos contenido a la etiqueta <p>
                       p.appendChild(item);
                    }
        		}
        		else
        		{
        			console.log(response.data.message);
        		}

        		})
        		.fail(function() {
        			console.log("error");
        	});
     });

      
      //Registrar Comunidad
      //-------------------

      $("#registrar_comunidad").change(function(event) {


            //document.querySelector(".preloader").setAttribute("style", "");
            event.preventDefault(); 
            

            var id_carrera = document.getElementById("estructuras-id_carrera").value;
            var id_trayecto = document.getElementById("estructuras-id_trayecto").value;
            var id_linea_investigacion = document.getElementById("estructuras-id_linea_investigacion").value;
     
            //Contiene la ruta del controlador que procesara los datos enviados mediante el formulario
            //Debemos tomar en cuenta que esta ruta la obtenemos del atributo action que corresponde al formulario
            //-----------------------------------------------------------------------------------------

            var url = document.getElementById("w0").getAttribute("action");




        
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

JS;
$this->registerJs($script);
?>

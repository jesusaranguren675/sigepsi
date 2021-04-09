<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\TiposComunidades;
use app\models\Parroquias;
use app\models\NecesidadesEstatus;
use app\models\Estados;
$TiposComunidades = \app\models\TiposComunidades::find()->all();
$Estados = \app\models\Estados::find()->all();
$Municipios = \app\models\Municipios::find()->all();
$Parroquias = \app\models\Parroquias::find()->all();
$NecesidadesEstatus = \app\models\NecesidadesEstatus::find()->all();
$Estados = \app\models\Estados::find()->all();


/* @var $this yii\web\View */
/* @var $model frontend\models\Comunidades */
/* @var $form yii\widgets\ActiveForm */
?>
<?= $this->render('/proyectos/alertsigepsi') ?>
<div class="comunidades-form">
    <div class="row">
        <?php $form = ActiveForm::begin(['enableClientValidation'=>false]); ?>
        
        <div class="col-sm-4">
            <?= $form->field($model, 'nombre')->textInput() ?>        
        </div>
        
        <div class="col-sm-4">
            <!--<?= $form->field($model, 'id_tipo_comunidad')->textInput() ?> -->
            <?= $form->field($model, "id_tipo_comunidad")->dropDownList(
                                       ArrayHelper::map($TiposComunidades, 'id_tipo_comunidad', 'tipo_comunidad'),
                                       ['prompt' => 'Seleccione la comunidad']);?>        
        </div>

        <div class="col-sm-4">
            <?= $form->field($model, 'telefono')->textInput() ?>        
        </div>
    </div>

    <div class="row">
        <div class="col-sm-4">
            <?= $form->field($model, "estado")->dropDownList(
               ArrayHelper::map($Estados, 'id_estado', 'estado'),
               ['prompt' => 'Seleccione']);?>         
        </div>

        <div class="col-sm-4">
            <?= $form->field($model, "municipio")->dropDownList(
               ArrayHelper::map($Municipios, 'id_municipio', 'municipio'),
               ['prompt' => 'Seleccione']);?>         
        </div>

        <div class="col-sm-4">
            <?= $form->field($model, "parroquia")->dropDownList(
               ArrayHelper::map($Parroquias, 'id_parroquia', 'parroquia'),
               ['prompt' => 'Seleccione']);?>         
        </div> 
    </div>
    
    <div class="row">
        <div class="col-sm-12">
            <?= $form->field($model, 'direccion')->textarea(['rows' => 6]) ?>        
        </div>
    </div>

    <div class="row">   
        <div class="col-sm-4">
            <?= $form->field($model, 'persona_contacto')->textInput() ?>        
        </div>

        <?php
        if(Yii::$app->user->can('comunidad'))
        {
            
        }
        else
        {
            ?>  
                <div class="col-sm-4">
                <?= $form->field($model, 'username')->textInput() ?>        
                </div>

                <div class="col-sm-4">
                    <?= $form->field($model, 'email')->textInput() ?>        
                </div>
                
                <div class="col-sm-4">
                    <?= $form->field($model, 'password')->passwordInput() ?>        
                </div>

                <div class="col-sm-4">
                    <?= $form->field($model, 'password_confirm')->passwordInput() ?>        
                </div>
            <?php
        }
      
        ?>

    </div>
        <button type="button" id="registrar-comunidad" class="btn btn-success">Guardar</button>
        <?php ActiveForm::end(); ?>
</div>



<?php
$script = <<< JS

 $("#registrar-comunidad").click(function(event) {
           document.querySelector(".preloader").setAttribute("style", "");
           event.preventDefault(); 

           var nombre = document.getElementById("comunidades-nombre").value;
           var tipo_comunidad = document.getElementById("comunidades-id_tipo_comunidad").value;
           var telefono = document.getElementById("comunidades-telefono").value;
           var parroquia = document.getElementById("comunidades-parroquia").value;
           var direccion = document.getElementById("comunidades-direccion").value;
           var persona_contacto = document.getElementById("comunidades-persona_contacto").value;
           var username = document.getElementById("comunidades-username").value;
           var email = document.getElementById("comunidades-email").value;
           var password = document.getElementById("comunidades-password").value;
           var password_confirm = document.getElementById("comunidades-password_confirm").value;

         
            var url = "sigepsi/web/index.php?r=comunidades/create";

            //Verificar validacion
            //---------------------
            var VerficarValidacion = [
                                       
                                        ValidateInputText('comunidades-nombre'),
                                        ValidateInputText('comunidades-id_tipo_comunidad'),
                                        ValidateNumber('comunidades-telefono'),
                                        ValidateInputText('comunidades-estado'),
                                        ValidateInputText('comunidades-municipio'),
                                        ValidateInputText('comunidades-parroquia'),
                                        ValidateInputText('comunidades-direccion'),
                                        ValidateInputText('comunidades-persona_contacto'),
                                        ValidateInputText('comunidades-username'),
                                        ValidateInputText('comunidades-direccion'),
                                        ValidateInputText('comunidades-direccion'),
                                        ValidateInputText('comunidades-direccion'),
                                    ];

            for (ver = 0; ver < VerficarValidacion.length; ver++) {
                    if(VerficarValidacion[ver] === false)
                    {
                        document.querySelector(".preloader").style.display = 'none';
                        event.preventDefault(); // stopping submitting
                        return false;
                    }
                    else
                    {

                    }
            }

             if(password != password_confirm)
             {
                document.querySelector(".preloader").style.display = 'none';
                AlertSigepsi("Las contraseñas no coinciden", "¡Intenta nuevamente!", "fas fa-times-circle", "warning");
                document.getElementById("comunidades-password").style.border = "solid 1px red";
                document.getElementById("comunidades-password_confirm").style.border = "solid 1px red";
                return false;
             }
             else
             {
                document.getElementById("comunidades-password").style.border = "solid 1px #68ea17";
                document.getElementById("comunidades-password_confirm").style.border = "solid 1px #68ea17";
             }

            //Fin Verificar validacion
            //---------------------


            $.ajax({
                url: url,
                type: 'post',
                dataType: 'json',
                data: {
                        nombre              :   nombre,
                        tipo_comunidad      :   tipo_comunidad,
                        telefono            :   telefono,
                        parroquia           :   parroquia,
                        direccion           :   direccion,
                        persona_contacto    :   persona_contacto,
                        username            :   username,
                        email               :   email,
                        password            :   password,
                }
            })
            .done(function(response) {

                if (response.data.success == true) 
                {
                    document.querySelector(".preloader").style.display = 'none';
          
                    AlertSigepsi("Comunidad registrada exitosamente", "<a class='btn btn-primary' href='/sigepsi/web/index.php?r=comunidades'>Para visualizar comunidades clickea aquí</a>", "fas fa-check", "success");

                }
    
            })
            .fail(function() {
                console.log("error");
                document.querySelector(".preloader").style.display = 'none';
                AlertSigepsi("No se pudo registrar la comunidad", "¡Intenta nuevamente!", "fas fa-times-circle", "warning");   
            });
    });


//Limpiar campos (estado municipio parroquia de la comunidad)
     //--------------------------------------------------------
     //--------------------------------------------------------
      var comunidad_estado = document.getElementById("comunidades-estado");
      var comunidad_municipio = document.getElementById("comunidades-municipio");
      var comunidad_parroquia = document.getElementById("comunidades-parroquia");

      comunidad_estado.innerHTML = '<option value="">Seleccione</option><option value="1">DISTRITO CAPITAL</option><option value="15">MIRANDA</option><option value="24">VARGAS</option>';

      comunidad_municipio.innerHTML = '<option value="">Seleccione</option>';

      comunidad_parroquia.innerHTML = '<option value="">Seleccione</option>';


      //Fin Limpiar campos (estado municipio parroquia de la comunidad)
      //--------------------------------------------------------
      //--------------------------------------------------------


      //Filtrar municipio mediante el estado (Filtro comunidad)
      //------------------------------------
      //------------------------------------
      $("#comunidades-estado").change(function(event) {
            
            var estado_comunidad = $("#comunidades-estado").val();
            var url = "sigepsi/web/index.php?r=comunidades/filtroestado";
        
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
      $("#comunidades-municipio").change(function(event) {
            
            var municipio_comunidad = $("#comunidades-municipio").val();
            var url = "sigepsi/web/index.php?r=comunidades/filtroparroquia";
        
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

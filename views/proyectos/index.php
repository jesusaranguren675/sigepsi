<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;
use yii\widgets\LinkPager;
use yii\widgets\ActiveForm;
use app\models\Estados;
use app\models\ProyectosEstatus;
use app\models\Especialidades;
use app\models\lineasInvestigacion;
$Estados = \app\models\Estados::find()->all();
$ProyectosEstatus = \app\models\ProyectosEstatus::find()->all();
$Especialidades = \app\models\Especialidades::find()->all();
$lineasInvestigacion = \app\models\LineasInvestigacion::find()->all();
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\ProyectosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Proyectos';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="proyectos-index conten-crud table-responsive">
    <div class="cintillo">
        <?php echo Html::img('@web/imagenes/cintillo.jpg'); ?>
    </div>

    <ol style="display: block;" class="breadcrumb">
        <li><a href="<?= Url::to(['proyectos/index']); ?>">Inicio</a></li>
        <li><a href="#">reportes</a></li>
    </ol>

    <h1 class="title-crud"><?= Html::encode($this->title) ?></h1>
    
    <p>
        <a class="btn btn-success" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
            Buscar Proyecto <i class="fas fa-angle-down"></i> 
        </a>
    </p>
    <div class="collapse" id="collapseExample">
        <div class="card card-body">
            <?php $form = ActiveForm::begin([
                                                "method" => "post",
                                                "action" => Url::toRoute("proyectos/pdf"),
                                            ]); ?>
            <div class="row">
                <div class="col-sm-4">
                    <?= $form->field($model, 'fecha_inicio')->widget(\yii\jui\DatePicker::className(), [
                        // if you are using bootstrap, the following line will set the correct style of the input field
                        'dateFormat' => 'yyyy-MM-dd',
                        'options' => ['class' => 'form-control'],
                        // ... you can configure more DatePicker properties here
                        ]) ?>  
                </div> 
                <div class="col-sm-4">
                    <?= $form->field($model, 'fecha_fin')->widget(\yii\jui\DatePicker::className(), [
                        // if you are using bootstrap, the following line will set the correct style of the input field
                        'dateFormat' => 'yyyy-MM-dd',
                        'options' => ['class' => 'form-control'],
                        // ... you can configure more DatePicker properties here
                        ]) ?>
                </div>   
                <div class="col-sm-4">
                    <?= $form->field($model, "id_estado")->dropDownList(
                                       ArrayHelper::map($Estados, 'id_estado', 'estado'),
                                       ['prompt' => 'Seleccione']);?>
                </div>
                <div class="col-sm-4">
                    <?= $form->field($model, "id_estatus")->dropDownList(
                                       ArrayHelper::map($ProyectosEstatus, 'id_estatus', 'estatus'),
                                       ['prompt' => 'Seleccione']);?>        
                </div>
                <div class="col-sm-4">
                     <?= $form->field($model, "id_especialidad")->dropDownList(
                                       ArrayHelper::map($Especialidades, 'id_especialidad', 'especialidad'),
                                       ['prompt' => 'Seleccione']);?>             
                </div>
                <div class="col-sm-4">
                    <?= $form->field($model, "id_linea_investigacion")->dropDownList(
                                       ArrayHelper::map($lineasInvestigacion, 'id_linea_investigacion', 'linea_investigacion'),
                                       ['prompt' => 'Seleccione']);?>         
                </div>
                <?php $fecha_inicio = null; $fecha_fin = null; $id_estado = null; $id_estatus = null; $id_especialidad = null; $id_linea_investigacion = null; ?>
                <div class="col-sm-12">
                    <button class="btn btn-primary" id="buscar-proyecto"><i class="fas fa-search"></i> Buscar</button>
                     <a class="btn btn-danger" id="exportar-proyecto"  target="_blank" title="Para exportar los datos a formato pdf debes crear una busqueda"><i class="fas fa-file-pdf"></i> Exportar a PDF</a><br><br>
                </div>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>


    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?php Pjax::begin(); ?>


    <table id="table_reportes" class="table table-bordered table-hover table-striped table_reportes">
        <tr>
            <th class="alert alert-info">N°</th>
            <th class="alert alert-info" colspan="5">Título</th>
            <th class="alert alert-info">Estatus</th>
            <th class="alert alert-info">Estado</th>
            <th class="alert alert-info">Nombre</th>
            <th class="alert alert-info">Especialidad</th>
            <th class="alert alert-info">Línea de investigación</th>
            <th class="alert alert-info">Fecha inicio</th>
            <th class="alert alert-info">Fecha fin</th>
        </tr>
     <?php
     $contador = 1;
     foreach ($proyectos as $proyectos) 
     {
        ?>
        <tr>
            <td><?= $contador ?></td>
            <td colspan="5"><?= $proyectos['titulo'] ?></td>
            <td><?= $proyectos['estatus'] ?></td>
            <td><?= $proyectos['estado'] ?></td>
            <td><?= $proyectos['nombre'] ?></td>
            <td><?= $proyectos['especialidad'] ?></td>
            <td><?= $proyectos['linea_investigacion'] ?></td>
            <td><?= $proyectos['fecha_inicio'] ?></td>
            <td><?= $proyectos['fecha_fin'] ?></td>
        </tr>
        <?php
        $contador ++;
     }
     ?>
    </table>
    <?php Pjax::end(); ?>
     <?= LinkPager::widget(['pagination' => $pagination]) ?>

</div>

<script type="text/javascript">
    var table = document.querySelectorAll(".table_reportes tbody tr");

    console.log(table.length);

</script>

<?php
$script = <<< JS

    $("#buscarproyectos-fecha_inicio").attr('readonly', "readonly");
    $("#buscarproyectos-fecha_fin").attr('readonly', "readonly");

    $("#buscar-proyecto").click(function(event) {
            
           event.preventDefault(); 

           var fecha_inicio = document.getElementById("buscarproyectos-fecha_inicio").value;
           var fecha_fin = document.getElementById("buscarproyectos-fecha_fin").value;
           var id_estado = document.getElementById("buscarproyectos-id_estado").value;
           var id_estatus = document.getElementById("buscarproyectos-id_estatus").value;
           var id_especialidad = document.getElementById("buscarproyectos-id_especialidad").value;
           var id_linea_investigacion = document.getElementById("buscarproyectos-id_linea_investigacion").value;
            
            var url = "sigepsi/web/index.php?r=proyectos/index";

            //Verificar validacion
            //---------------------
            var VerficarValidacion = [
                                       
                                        ValidateDate('buscarproyectos-fecha_inicio'),
                                        ValidateDate('buscarproyectos-fecha_fin'),
                                        ValidateInputText('buscarproyectos-id_estado'),
                                        ValidateInputText('buscarproyectos-id_estatus'),
                                        ValidateInputText('buscarproyectos-id_especialidad'),
                                        ValidateInputText('buscarproyectos-id_linea_investigacion'),
                                       
    
                                    ];

            for (ver = 0; ver < VerficarValidacion.length; ver++) {
                    if(VerficarValidacion[ver] === false)
                    {
                        event.preventDefault(); // stopping submitting
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
                        fecha_inicio                :    fecha_inicio,       
                        fecha_fin                   :    fecha_fin,
                        id_estado                   :    id_estado,
                        id_estatus                  :    id_estatus,
                        id_especialidad             :    id_especialidad,
                        id_linea_investigacion      :    id_linea_investigacion,
                }
            })
            .done(function(response) {

                if (response.data.success == true) 
                {
                    if(response.data.proyecto == "")
                    {
                        AlertSigepsi("No se encontraron proyectos", "¡Intenta nuevamente!", "fas fa-search", "warning");

                        return false;
                    }
                    else
                    {
                        var arreglo = "Se econtraron" + " " + response.data.proyecto.length + " " + "proyectos";
                        AlertSigepsi(arreglo, "¿Quieres crear otra busqueda?", "fas fa-search", "success");
                   
                        var table_reportes = document.querySelector(".table_reportes tbody");
                        console.log(table_reportes);

                        table_reportes.innerHTML = "<tr><th class='alert alert-info'>Titulo</th><th class='alert alert-info'>Estatus</th><th class='alert alert-info'>Estado</th><th class='alert alert-info'>Nombre</th><th class='alert alert-info'>Especialidad</th><th class='alert alert-info'>Linea de investigación</th><th class='alert alert-info'>Fecha Inicio</th><th class='alert alert-info'>Fecha Fin</th></tr>"

                        for (es = 0; es < response.data.proyecto.length; es++)
                        {

                            var nameElementAttr = "reporte_" + es;
                        
                            //Crea el elemento <tr> dentro de la tabla reportes
                            var itemTr = document.createElement('tr');

                            //Crea el elemento <td> dentro de la tabla reportes
                            var itemTdTitulo = document.createElement('td');
                            var itemTdEstatus = document.createElement('td');
                            var itemTdEstado = document.createElement('td');
                            var itemTdNombre = document.createElement('td');
                            var itemTdEspecialidad = document.createElement('td');
                            var itemTdLinea = document.createElement('td');
                            var itemTdFecha_inicio = document.createElement('td');
                            var itemTdFecha_fin = document.createElement('td');
                                
                            //Contenido de los td de la tabla comunidades
                            var titulo = document.createTextNode(response.data.proyecto[es].titulo); 
                            var estatus = document.createTextNode(response.data.proyecto[es].estatus); 
                            var estado = document.createTextNode(response.data.proyecto[es].estado);
                            var nombre = document.createTextNode(response.data.proyecto[es].nombre);
                            var especialidad = document.createTextNode(response.data.proyecto[es].especialidad);
                            var linea_investigacion = document.createTextNode(response.data.proyecto[es].linea_investigacion);
                            var fecha_inicio = document.createTextNode(response.data.proyecto[es].fecha_inicio);
                            var fecha_fin = document.createTextNode(response.data.proyecto[es].fecha_fin);


                            //Crear atributo id para los elemento tr
                            var attId = document.createAttribute("id");
                            attId.value = nameElementAttr;
                            itemTr.setAttributeNode(attId);

                            
                            table_reportes.appendChild(itemTr);

                            //Selecciona por medio del id los <tr> creados
                            var SelectTr = document.getElementById(nameElementAttr);

                                
                            //Añadir a los <td> a los <tr> creados
                            SelectTr.appendChild(itemTdTitulo);
                            SelectTr.appendChild(itemTdEstatus);
                            SelectTr.appendChild(itemTdEstado);
                            SelectTr.appendChild(itemTdNombre);
                            SelectTr.appendChild(itemTdEspecialidad);
                            SelectTr.appendChild(itemTdLinea);
                            SelectTr.appendChild(itemTdFecha_inicio);
                            SelectTr.appendChild(itemTdFecha_fin);

             
                            //Añade contenido a los <td> creados
                            itemTdTitulo.appendChild(titulo);
                            itemTdEstatus.appendChild(estatus); 
                            itemTdEstado.appendChild(estado);
                            itemTdNombre.appendChild(nombre);
                            itemTdEspecialidad.appendChild(especialidad);
                            itemTdLinea.appendChild(linea_investigacion);
                            itemTdFecha_inicio.appendChild(fecha_inicio);
                            itemTdFecha_fin.appendChild(fecha_fin);
                           
                        }
                    }
                }
             
            })
            .fail(function() {
                console.log("error");
                   
            });
    });

      $("#exportar-proyecto").click(function(event) {
           
            event.preventDefault(); 

            var fecha_inicio = document.getElementById("buscarproyectos-fecha_inicio").value;
            var fecha_fin = document.getElementById("buscarproyectos-fecha_fin").value;
            var id_estado = document.getElementById("buscarproyectos-id_estado").value;
            var id_estatus = document.getElementById("buscarproyectos-id_estatus").value;
            var id_especialidad = document.getElementById("buscarproyectos-id_especialidad").value;
            var id_linea_investigacion = document.getElementById("buscarproyectos-id_linea_investigacion").value;
            
             var url = "sigepsi/web/index.php?r=proyectos/pdf";

             //Verificar validacion
             //---------------------
             var VerficarValidacion = [
                                       
                                         ValidateDate('buscarproyectos-fecha_inicio'),
                                         ValidateDate('buscarproyectos-fecha_fin'),
                                         ValidateInputText('buscarproyectos-id_estado'),
                                         ValidateInputText('buscarproyectos-id_estatus'),
                                         ValidateInputText('buscarproyectos-id_especialidad'),
                                         ValidateInputText('buscarproyectos-id_linea_investigacion'),
                                       
    
                                     ];

             for (ver = 0; ver < VerficarValidacion.length; ver++) {
                     if(VerficarValidacion[ver] === false)
                     {
                         event.preventDefault();  //stopping submitting
                     }
                     else
                     {

                     }
             }
             //Fin Verificar validacion
             //---------------------

             window.open("/sigepsi/web/index.php?r=proyectos%2Fpdf&fecha_inicio=" + fecha_inicio + "&fecha_fin=" + fecha_fin + "&id_estado=" + id_estado + "&id_estatus=" + id_estatus + " &id_especialidad=" + id_especialidad + "&id_linea_investigacion=" + id_linea_investigacion, "_blank");
        
     });


JS;
$this->registerJs($script);
?>
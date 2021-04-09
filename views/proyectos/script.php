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



       //Asignar Estudiante al proyecto
       //------------------------------
       //------------------------------
       var contador = 0;
       document.getElementById("encabezado").style.display = 'none';
       $("#button_integrante").click(function(event) {
            event.preventDefault(); // stopping submitting
            var data = document.getElementById('proyectos-cedula_integrante').value;
            var id_especialidad = document.getElementById('proyectos-id_especialidad').value;
            var url = "sigepsi/web/index.php?r=proyectos/integrantes";

            if(data === "")
            {
                AlertSigepsi("Campo cédula integrante vacío", "¡Intenta nuevamente!", "fas fa-times-circle", "warning");
                return false;
            }
            if(id_especialidad === ""){
                 AlertSigepsi("Selecciona la especialidad del proyecto", "¡Intenta nuevamente!", "fas fa-times-circle", "warning");
                return false;
            }

            $.ajax({
                url: url,
                type: 'post',
                dataType: 'json',
                data: {
                            cedula_integrante : data,
                            id_especialidad : id_especialidad
                       }
            })
            .done(function(response) {

                contador = contador + 1;
                console.log(contador);
                var integrante = "integrante_" + contador;
                var clase_integrante = "accion_" + contador;
                var cedula = "cedula_" + contador;
                var campo_integrante = "campo_integrante_" + contador; 

                var btn_remove = "." + integrante + " " + "button";

                if(response.data.integrante === false)
                {
                    contador = contador - 1;
                    console.log(contador);
                    AlertSigepsi("Error", "¡Verifica la cédula y la especialidad!", "fas fa-times-circle", "warning");
                    return false;   
                }
                
                if (response.data.success == true) 
                {
                    if(contador <= 5)
                    {

                        AlertSigepsi("¡Estudiante encontrado!", "¿Quieres agregar otro?", "fas fa-check-circle", "success");
                        document.getElementById("encabezado").style.display = 'block';

                        console.log(contador);
                        //Validar que los estudiantes no se repitan
                        var cedula_integrante = document.querySelectorAll(".cedula_integrante");

                        for(c = 0; c < cedula_integrante.length; c++)
                        {

                            if(cedula_integrante[c].getAttribute('id') != response.data.cedula)
                            {

                            }
                            else
                            {
                                AlertSigepsi("El estudiante ya se encuentra asignado", "¡Intenta con otra cédula!", "fas fa-times-circle", "warning");
                                
                                contador = contador - 1;
                                return false;
                            }
                        }

                        console.log(response.data)
                        //Crear tabla con datos del integrante
                        document.getElementById(integrante).innerHTML = '<td class="cedula_integrante" id="'+response.data.cedula+'">'+response.data.cedula+'</td><td>'+response.data.primer_nombre+' '+response.data.segundo_nombre+' '+response.data.primer_apellido+' '+response.data.segundo_apellido+'</td><td>'+response.data.especialidad+'</td><td style="text-align:center;"><button style="background:#dc3545; color:#fff; border:none;" id="accion_1" class="accion_1" class="btn btn-danger"><i class="fas fa-user-times"></i> Remover Asignacion</button></td>';

                        document.getElementById(campo_integrante).setAttribute("value", response.data.cedula);

                        document.getElementById("contador").setAttribute("value", contador);

                        //console.log(contador);

                        var verificar = document.getElementById(integrante);

                        for (var z = 0; z < verificar.children.length; z++)
                        {
                            if(verificar.children[z] === "")
                            {

                            }
                            else
                            {
                                 document.getElementById(integrante).style.visibility = 'visible';
                            }
                        }

                        //Remover estudiantes
                        let BtnRemove = document.querySelectorAll(btn_remove);
                       
                        for (o = 0; o < BtnRemove.length; o++)
                        {
                            
                            BtnRemove[o].setAttribute("class", clase_integrante)
                            BtnRemove[o].setAttribute("id", clase_integrante)

                            BtnRemove[o].addEventListener('click', (e) => {
                                console.log(BtnRemove[o]);
                                 if(contador < 2)
                                 {
                                    AlertSigepsi("Error", "No es posible remover esta asignación ya que es el único estudiante registrado en el proyecto", "fas fa-times-circle", "warning");     
                                 }
                                 else
                                 {
                                    document.getElementById(integrante).style.display = 'none';

                                    var clear_cedula = document.getElementById(integrante);

                                    for (var z = 0; z < clear_cedula.children.length; z++) {
                                        clear_cedula.children[z].innerHTML = '';
                                    }

                                    var clear_cedula = clear_cedula.firstElementChild;

                                    clear_cedula.setAttribute("id", "");

                                    document.getElementById(integrante).style.display = '';
                                    document.getElementById(integrante).style.visibility = 'hidden';

                                    contador = contador - 1;
                                 } 
                                });
                        }

                    }
                    else
                    {
                        AlertSigepsi("Máximo de integrantes alcanzado", "¡Solo se permiten 5 integrantes por proyecto!", "fas fa-times-circle", "warning");
                        contador = contador - 1;
                    }

                }

                
            })
            .fail(function() {
                console.log("error");
                    AlertSigepsi("Estudiante no encontrado", "¡Intenta nuevamente!", "fas fa-times-circle", "warning");
            });
        
        });
        //Fin asignar estudiante al proyecto
        //---------------------------------
        //---------------------------------


       //Registrar Proyecto en la base de datos
       //--------------------------------------
       //--------------------------------------
       $("#button_registrar_proyecto").click(function(event) {
            document.querySelector(".preloader").setAttribute("style", "");
            event.preventDefault(); // stopping submitting


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
            var campo_integrante_1          = document.getElementById("campo_integrante_1").value;
            var campo_integrante_2          = document.getElementById("campo_integrante_2").value;
            var campo_integrante_3          = document.getElementById("campo_integrante_3").value;
            var campo_integrante_4          = document.getElementById("campo_integrante_4").value;
            var campo_integrante_5          = document.getElementById("campo_integrante_5").value;
            var contador                    = document.getElementById("contador").value;
            
            var url = "sigepsi/web/index.php?r=proyectos/create";

            //Verificar validacion
            //---------------------
            var VerficarValidacion = [
                                        ValidateInputText('proyectos-titulo'), 
                                        ValidateInputText('proyectos-problema'),
                                        ValidateInputText('proyectos-objetivo_general'),
                                        ValidateInputText('proyectos-objetivos_especificos'),
                                        ValidateInputText('proyectos-sinopsis'),
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

            //Verificar que los estudiantes esten asigandos al proyecto
            //---------------------------------------------------------

            if(document.getElementById("contador").value == 0)
            {
                document.querySelector(".preloader").style.display = 'none';
                AlertSigepsi("El proyecto debe tener por lo menos un integrante", "¡Agrega un integrante al proyecto!", "fas fa-times-circle", "warning");

                return false;
            }


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
                            direccion                   :    direccion,
                            cedula_tutor_comunitario    :    cedula_tutor_comunitario,
                            tutor_comunitario           :    tutor_comunitario,
                            id_tutor                    :    id_tutor,
                            sinopsis                    :    sinopsis,
                            id_linea_investigacion      :    id_linea_investigacion,
                            id_trayecto                 :    id_trayecto,
                            created_by                  :    created_by,
                            campo_integrante_1          :    campo_integrante_1,
                            campo_integrante_2          :    campo_integrante_2,
                            campo_integrante_3          :    campo_integrante_3,
                            campo_integrante_4          :    campo_integrante_4,
                            campo_integrante_5          :    campo_integrante_5,
                            contador                    :    contador,
                        }
            })
            .done(function(response) {

                console.log(response.data);

                if(response.data.success == true) 
                {
                    document.querySelector(".preloader").style.display = 'none';
                    AlertSigepsi("Proyecto registrado exitosamente", "<a class='btn btn-primary' href='http://localhost:8080/sigepsi/web/index.php?r=proyectos%2Fupload&id="+response.data.id_proyecto+"'>Para registrar su propuesta de proyecto clickea aquí</a>", "fas fa-check", "success");
                    document.getElementById("close-alert-sigepsi").style.display = 'none';
                } 
                if(response.data.repetido == true){
                    document.querySelector(".preloader").style.display = 'none';
                    AlertSigepsi("Verifica que los estudiantes no esten participando en otros proyectos", "¡Alguno de los estudiantes que intentas registrar esta participando en otro proyecto!", "fas fa-times-circle", "warning");
                }
                
            })
            .fail(function() {
                console.log("error");
                    document.querySelector(".preloader").style.display = 'none';
                    AlertSigepsi("Ocurrió un error al registrar el proyecto", "¡Intenta nuevamente!", "fas fa-times-circle", "warning");
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

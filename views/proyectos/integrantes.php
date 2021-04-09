<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

?>


<!-- Formulario para agregar estudiantes al proyectos -->
<div class="table table-reponsive">
	<table class="table table-bordered">
		<tr>
			<th colspan="2">Estudiantes que ejecutarán el proyecto</th>
		</tr>
		<tr>
			<td>
				<?php 
				$form = ActiveForm::begin([
					'action' => ['proyectos/integrantes'],
					'options' => [
						'class' => 'form-cedula-integrante'
					]
				]); 
				?>
				<div class="col-sm-6">
					<?= $form->field($model, 'cedula_integrante'); ?>
				</div>
				<div class="col-sm-6">
					<button style="margin-top: 10px;" class="btn btn-primary" id="button_integrante" type="button"><i class="fas fa-user"></i> Agregar el estudiante</button>
				</div>
			</td>
			<?php ActiveForm::end(); ?>
		</tr>
	</table>
</div>
<!--Fin Formulario para agregar estudiantes al proyectos -->


<!--Tabla que muestra los estudiantes que se estan agregando al proyecto -->
<div id="encabezado">
    <table class="table-integrantes table table-comunidades table table-bordered table-striped table-hover">
        <tr>
            <th>Cédula</th>
            <th>Nombres y Apellidos</th>
            <th>Especialidad</th>
            <th style="text-align: center;">Acciones</th>
        </tr>
        <tr class="integrante_1" id="integrante_1">
            
        </tr>
        <tr class="integrante_2" id="integrante_2">
            
        </tr>
        <tr class="integrante_3" id="integrante_3">
            
        </tr>
        <tr class="integrante_4" id="integrante_4">
            
        </tr>
        <tr class="integrante_5" id="integrante_5">
            
        </tr>
        <tr class="integrante_6" id="integrante_6">
            
        </tr>
    </table>
</div>
    <div class="form-group">
        <button class="btn btn-success" id="button_registrar_proyecto" type="button">Registrar proyecto</button>
    </div>
	</div>
</div>

<!--Tabla que muestra los estudiantes que se estan agregando al proyecto -->
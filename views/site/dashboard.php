<?php

use yii\helpers\Html;
use yii\helpers\Url;
use app\assets\DashboardAsset;
DashboardAsset::register($this);
?>


<div class="cintillo">
	<?php echo Html::img('@web/imagenes/cintillo.svg'); ?>
</div>
<h3 class="title-dashboard">PANEL DE PROYECTOS</h3>
<div class="estadisticas-dashboard">
	<div class="card estadisticas">
		<h5 class="card-title"><i class="fas fa-chart-bar"></i> Estadisticas Carreras</h5>
		<div class="card-body">
			<canvas id="Carreras" width="400" height="300"></canvas>
		</div>
	</div>

	<div class="card estadisticas">
		<h5 class="card-title"><i class="fas fa-chart-bar"></i> Estadisticas Profesores</h5>
		<div class="card-body">
			<canvas id="Profesores" width="400" height="300"></canvas>
		</div>
	</div>

	<div class="card estadisticas">
		<h5 class="card-title"><i class="fas fa-chart-bar"></i> Estadisticas Alumnos</h5>
		<div class="card-body">
			<canvas id="Alumnos" width="400" height="300"></canvas>
		</div>
	</div>
</div>

<main>
	<div class="container-fluid">
		<div class="card mb-4">
			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
						<thead>
							<tr>
								<th>Título</th>
								<th>Estatus</th>
								<th>Estado</th>
								<th>Nombre</th>
								<th>Linea de Investigación</th>
								<th>Fecha Inicio</th>
								<th>Fecha Fin</th>
							</tr>
						</thead>
						<tfoot>
							<tr>
								<th>Título</th>
								<th>Problema</th>
								<th>Objetivo General</th>
								<th>Objetivos Especificos</th>
								<th>Fecha Inicio</th>
								<th>Fecha Fin</th>
							</tr>
						</tfoot>
						<tbody>
							
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</main>



<?php
use yii\helpers\Html;

?>



<style>
	body {
		font-family: arial;
		color: #333;

	}
	table{
		border: solid 1px #000;
		border-collapse:collapse;
		border-spacing:0;
	}
	tr {
		border: solid 1px #000;
	}
	td {
		border: solid 1px #000;
		font-size: 11.5px;
	}
	th {
		border: solid 1px #000;
		font-size: 11.5px;
	}
</style>

<br><br>
<div class="titulo" style="text-align: center;
	font-weight: bold;
	font-size:16pt;
	text-decoration: underline;">
    LISTADO DE PROYECTOS
</div>

<br>
<b style="font-size: 9pt; color: #333;">Fecha de Reporte: <?php echo date("d/m/Y") ?></b><br>
<b style="font-size: 9pt; color: #333;">Hora de Reporte: <?php echo date("h:i a") ?></b><br><br>

<?php foreach ($proyecto AS $datos_reporte): ?>
	<b style="font-size: 9pt; color: #333;">Fecha Inicio: <?= $datos_reporte['fecha_inicio'] ?></b><br>
	<b style="font-size: 9pt; color: #333;">Fecha Fin: <?= $datos_reporte['fecha_fin'] ?></b><br>
	<b style="font-size: 9pt; color: #333;">Especialidad: <?= $datos_reporte['especialidad'] ?></b><br>
	<b style="font-size: 9pt; color: #333;">Linea de investigación: <?= $datos_reporte['linea_investigacion'] ?></b><br>
	<b style="font-size: 9pt; color: #333;">Estatus: <?= $datos_reporte['estatus'] ?></b><br><br>
	<b style="font-size: 9pt; color: #333;">Total Proyectos: <?= count($proyecto) ?></b><br><br>
<?php endforeach ?>


<table id="table_reportes" class="table table-bordered table-hover table-striped table_reportes">
	<tr>
		<th>N°</th>
		<th>Título</th>
		<th>Estatus</th>
		<th>Estado</th>
		<th>Nombre</th>
		<th>Especialidad</th>
		<th>Línea de investigación</th>
		<th>Fecha inicio</th>
		<th>Fecha fin</th>
	</tr>
	<?php
	foreach ($proyecto as $proyectos)
	{
		$contador = 1;
		?>
		<tr>
			<td><?= $contador ?></td>
			<td><?= $proyectos['titulo'] ?></td>
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

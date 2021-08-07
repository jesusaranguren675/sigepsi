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
    LISTADO DE COMUNIDADES
</div>

<br>
<b style="font-size: 9pt; color: #333;">Fecha de Reporte: <?php echo date("d/m/Y") ?></b><br>
<b style="font-size: 9pt; color: #333;">Hora de Reporte: <?php echo date("h:i a") ?></b><br><br>


<table id="table_reportes" class="table table-bordered table-hover table-striped table_reportes">
	<tr>
		<th>Id Comunidad</th>
		<th>Nombre</th>
		<th>Tipo de Comunidad</th>
		<th>Teléfono de Contacto</th>
		<th>Persona de Contacto</th>
	</tr>
	<?php
	foreach ($comunidades as $comunidades)
	{
		?>
		<tr>
			<td><?= $comunidades['id_comunidad'] ?></td>
			<td><?= $comunidades['nombre'] ?></td>
			<td><?= $comunidades['tipo_comunidad'] ?></td>
			<td><?= $comunidades['telefono_contacto'] ?></td>
			<td><?= $comunidades['persona_contacto'] ?></td>
		</tr>
		<?php
	}

	?>
</table>

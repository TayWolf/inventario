<div class="row">
	<div class="col-xs-12">
		<h2><strong>Extensión del Teléfono : </strong> <?php echo $telefono->no_ext_tel; ?> </h2>
		<table class="table table-bordered">
			<tbody>
				<tr>
					<th colspan="2" style="background-color: #f4f4f4;">No. Serie</th>
					<td colspan="2"><?php echo $telefono->no_serie; ?></td>
				</tr>
				<tr>
					<th colspan="2" style="background-color: #f4f4f4;">Modelo</th>
					<td colspan="2"><?php echo $telefono->modelo; ?></td>
				</tr>
				<tr>
					<th colspan="2" style="background-color: #f4f4f4;">Dirección IP</th>
					<td colspan="2"><?php echo $telefono->direccion_ip; ?></td>
				</tr>
				<tr>
					<th style="background-color: #f4f4f4;">Marca</th>
					<td><?php echo $telefono->marca; ?></td>
					<th style="background-color: #f4f4f4;">Status</th>
					<td><?php echo $telefono->nombre_status; ?></td>
				</tr>
				<tr>
					<th style="background-color: #f4f4f4;">Bitácora</th>
					<td colspan="3"><?php echo $telefono->estado_bien?></td>
				</tr>
				<tr>
					<th style="background-color: #3c8dbc; color: #FFF;" class="text-center" colspan="4">Ultimos Mantenimientos</th>
				</tr>
				<tr>
					<th>Fecha</th>
					<th>Especialista</th>
					<th colspan="2">Descripcion</th>
				</tr>
				<?php if (!empty($mantenimientos)): ?>
					<?php foreach ($mantenimientos as $mantenimiento): ?>
						<tr>
							<td><?php echo $mantenimiento->fecha;?></td>
							<td><?php echo $mantenimiento->tecnico;?></td>
							<td colspan="2"><?php echo $mantenimiento->descripcion;?></td>
						</tr>
					<?php endforeach ?>
					
				<?php else: ?>
					<tr>
						<td colspan="4">No se ha realizo ningun mantenimiento</td>
					</tr>
				<?php endif ?>
			</tbody>
		</table>
	</div>
</div>
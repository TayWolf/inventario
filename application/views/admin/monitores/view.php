<div class="row">
	<div class="col-xs-12">
		<h2><strong>Codigo del Monitor : </strong> <?php echo $monitor->no_serie; ?> </h2>
		<table class="table table-bordered">
			<tbody>
				<tr>
					<th style="background-color: #f4f4f4;">Modelo</th>
					<td><?php echo $monitor->modelo; ?></td>
					<th style="background-color: #f4f4f4;">Marca</th>
					<td><?php echo $monitor->marca; ?></td>
				</tr>
				<tr>
					<th style="background-color: #f4f4f4;">Elemento</th>
					<td><?php echo $monitor->elemento; ?></td>
					<th style="background-color: #f4f4f4;">Area</th>
					<td><?php echo $monitor->area; ?></td>
				</tr>
				<tr>
					<th style="background-color: #f4f4f4;">Propietario</th>
					<td><?php echo $monitor->nombres.''.$monitor->ap_paterno.''.$monitor->ap_materno; ?></td>
					<th style="background-color: #f4f4f4;">Fecha de Registro</th>
					<td><?php echo $monitor->fecregistro_bien; ?></td>
				</tr>
				<tr>
					<th style="background-color: #f4f4f4;">Bitacora</th>
					<td><?php echo $monitor->estado_bien; ?></td>
					<th style="background-color: #f4f4f4;">Estado</th>
					<td><?php echo $monitor->nombre_status?></td>
				</tr>
				<tr>
					<th style="background-color: #3c8dbc; color: #FFF;" class="text-center" colspan="4">Ultimos Mantenimientos</th>
				</tr>
				<tr>
					<th>#</th>
					<th>Fecha</th>
					<th>Tecnico</th>
					<th colspan="2">Descripcion</th>
				</tr>
				<?php if (!empty($mantenimientos)): ?>
					<?php foreach ($mantenimientos as $mantenimiento): ?>
						<tr>
							<td><?php echo $mantenimiento->id_mantenimiento;?></td>
							<td><?php echo $mantenimiento->fecha_mantenimiento;?></td>
							<td><?php echo $mantenimiento->nombres.' '.$mantenimiento->ap_paterno.' '.$mantenimiento->ap_materno;?></td>
							<td colspan="2"><?php echo $mantenimiento->motivo_mantenimiento;?></td>
						</tr>
					<?php endforeach ?>
					
				<?php else: ?>
					<tr>
						<td colspan="4">No se ha realizado ningún mantenimiento</td>
					</tr>
				<?php endif ?>
			</tbody>
		</table>
	</div>
</div>
<div class="row">
	<div class="col-xs-12">
		<h2><strong>Codigo de Lap-Top </strong> <?php echo $laptop->no_serie; ?></h2>
		<table class="table table-bordered">
			<tbody>
				<tr>
					<th style="background-color: #f4f4f4;">Tipo de Propiedad</th>
					<td><?php echo $laptop->tipo_propiedad; ?></td>
					
					<th style="background-color: #f4f4f4;">Elemento</th>
					<td><?php echo $laptop->elemento; ?></td>

				</tr>
				<tr>
					<th style="background-color: #f4f4f4;">Modelo</th>
					<td><?php echo $laptop->modelo; ?></td>
					
					<th style="background-color: #f4f4f4;">Marca</th>
					<td><?php echo $laptop->marca; ?></td>
				</tr>
				<tr>
					<th style="background-color: #f4f4f4;">Unidad de Almacenamiento</th>
					<td colspan="3"><?php echo $laptop->unidad_almacenamiento; ?></td>
				</tr>
				<tr>
					<th style="background-color: #f4f4f4;">Procesador</th>
					<td><?php echo $laptop->procesador; ?></td>
					
					<th style="background-color: #f4f4f4;">RAM</th>
					<td><?php echo $laptop->ram; ?></td>

				</tr>
				<tr>
					<th style="background-color: #f4f4f4;">Sistema Operativo</th>
					<td><?php echo $laptop->sistema_operativo; ?></td>
					
					<th style="background-color: #f4f4f4;">Dirección MAC</th>
					<td><?php echo $laptop->direccion_mac; ?></td>
					
				</tr>
				<tr>
					<th style="background-color: #f4f4f4;">IP</th>
					<td><?php echo $laptop->direccion_ip; ?></td>
					
					<th style="background-color: #f4f4f4;">Estado</th>
					<td colspan="3"><?php echo $laptop->nombre_status; ?></td>
				</tr>
				<tr>
					<th colspan="4" style="background-color: #f4f4f4; text-align: center;">Bitacora</th>
				</tr>
				<tr>
					<td colspan="4"><?php echo $laptop->estado_bien; ?></td>
				</tr>
				<tr>
					<th style="background-color: #6f80ac; color: #FFF;" class="text-center" colspan="4">Ultimos Mantenimientos</th>
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
						<td colspan="4">No se ha realizo ningún mantenimiento</td>
					</tr>
				<?php endif ?>
				<tr>
					<th style="background-color: #6f80ac; color: #FFF;" class="text-center" colspan="4">Antecedentes de préstamos de la LapTop</th>
				</tr>
				<?php if (!empty($mantenimientos)): ?>
					<tr>
						<th>#</th>
						<th>Fecha de Asignación</th>
						<th colspan="2">Usuario</th>
					</tr>
					<?php foreach ($mantenimientos as $mantenimiento): ?>
						<tr>
							<td><?php echo $mantenimiento->id_mantenimiento;?></td>
							<td><?php echo $mantenimiento->fecha_mantenimiento;?></td>
							<td colspan="2"><?php echo $mantenimiento->nombres.' '.$mantenimiento->ap_paterno.' '.$mantenimiento->ap_materno;?></td>
						</tr>
					<?php endforeach ?>
					
					<?php else: ?>
						<tr>
							<th>#</th>
							<th colspan="2">Fecha de Asignación</th>
							<th>Usuario</th>
						</tr>
						<tr>
							<td colspan="4">No se ha realizo ningún antecedente de usuario(s)</td>
						</tr>
				<?php endif ?>
			</tbody>
		</table>
	</div>
</div>
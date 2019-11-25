<div class="row">
	<div class="col-xs-12">
		<h2><strong>Codigo del <?php echo $bienes->elemento; ?> : </strong> <?php echo $bienes->no_serie; ?></h2>
		<table class="table table-bordered">
			<tbody>
				<tr>
					<th style="background-color: #f4f4f4;">Persona</th>
					<td><?php echo $bienes->nombres.' '.$bienes->ap_paterno.' '.$bienes->ap_materno; ?></td>

					<th style="background-color: #f4f4f4;">Tipo de Propiedad</th>
					<td><?php echo $bienes->tipo_propiedad; ?></td>
				</tr>
				<tr>
					<th style="background-color: #f4f4f4;">Elemento</th>
					<td><?php echo $bienes->elemento; ?></td>

					<th style="background-color: #f4f4f4;">Area</th>
					<td><?php echo $bienes->nombre_area; ?></td>
				</tr>
				<tr>
					<th style="background-color: #f4f4f4;">Modelo</th>
					<td><?php echo $bienes->modelo; ?></td>

					<th style="background-color: #f4f4f4;">Marca</th>
					<td><?php echo $bienes->marca; ?></td>
				</tr>
				<tr>
					<th style="background-color: #f4f4f4;">Procesador</th>
					<td><?php echo $bienes->procesador; ?></td>

					<th style="background-color: #f4f4f4;">Unidad de Almacenamiento</th>
					<td><?php echo $bienes->unidad_almacenamiento; ?></td>
				</tr>
				<tr>
					<th style="background-color: #f4f4f4;">RAM</th>
					<td><?php echo $bienes->ram; ?></td>

					<th style="background-color: #f4f4f4;">Sistema Operativo</th>
					<td><?php echo $bienes->sistema_operativo; ?></td>
				</tr>
				<tr>
					<th style="background-color: #f4f4f4;">Dirección MAC</th>
					<td><?php echo $bienes->direccion_mac; ?></td>
					
					<th style="background-color: #f4f4f4;">IP</th>
					<td><?php echo $bienes->direccion_ip; ?></td>
				</tr>
				<tr>
					<th style="background-color: #f4f4f4;">Bitacora</th>
					<td><?php echo $bienes->estado_bien; ?></td>

					<th style="background-color: #f4f4f4;">Estado</th>
					<td><?php echo $bienes->nombre_status; ?></td>
				</tr>
				<tr>
					<td colspan="4"></td>
				</tr>
				<tr>
					<th style="background-color: #510B23; color: #FFF;" class="text-center" colspan="4">Ultimos Mantenimientos</th>
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
					<th style="background-color: #510B23; color: #FFF;" class="text-center" colspan="4">Antecedentes de usuario(s) del CPU</th>
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
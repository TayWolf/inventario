<div class="row">
	<div class="col-xs-12">
		<table class="table table-bordered">
			<tbody>
				<tr>
					<th style="background-color: #f4f4f4;">Nombre(s) del Propietario</th>
					<td colspan="2"><?php echo $persona->nombres; ?></td>
				</tr>
				<tr>
					<th style="background-color: #f4f4f4;">Apellido Paterno</th>
					<td><?php echo $persona->ap_paterno; ?></td>
				</tr>
					<th style="background-color: #f4f4f4;">Apellido Materno</th>
					<td><?php echo $persona->ap_materno; ?></td>
				</tr>
				<tr>
					<th style="background-color: #f4f4f4;">Área</th>
					<td><?php echo $persona->nombre_area; ?></td>
				</tr>
				<tr>
					<th style="background-color: #f4f4f4;">Cargo</th>
					<td><?php echo $persona->cargo; ?></td>
				</tr>
				<tr>
					<th style="background-color: #f4f4f4;">Estado</th>
					<td><?php echo $persona->nombre_status?></td>
				</tr>
				
			</tbody>
		</table>
	</div>
</div>
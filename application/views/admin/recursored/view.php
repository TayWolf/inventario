<div class="row">
	<div class="col-xs-12">
		<table class="table table-bordered">
			<tbody>
				<tr>
					<th colspan="3" style="background-color: #f4f4f4;text-align: center;">Persona</th>
				</tr>
				<tr>
					<td colspan="3" style="text-align: center;"><?php echo $recursored->nombres.' '.$recursored->ap_paterno.' '.$recursored->ap_materno; ?></td>
				</tr>
				<tr>
					<th style="background-color: #f4f4f4;">Tipo de Cuenta</th>
					<td><?php echo $recursored->nombre_tipo_acceso; ?></td>
				</tr>
				<tr>
					<th style="background-color: #f4f4f4;">Usuario</th>
					<td><?php echo $recursored->usuario_acceso; ?></td>
				</tr>
				<tr>
					<th style="background-color: #f4f4f4;">Contraseña</th>
					<td><?php echo $recursored->clave_acceso; ?></td>
				</tr>
				<tr>
					<th style="background-color: #f4f4f4;">Estado</th>
					<td><?php echo $recursored->nombre_status; ?></td>
				</tr>
				
			</tbody>
		</table>
	</div>
</div>
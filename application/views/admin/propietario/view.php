<div class="row">
	<div class="col-xs-12">
		<table class="table table-bordered">
			<tbody>
				<tr>
					<th style="background-color: #f4f4f4;">Nombre(s) del Propietario</th>
					<td><?php echo $propietario->nombre; ?></td>
					<th style="background-color: #f4f4f4;">Apellido Materno</th>
					<td><?php echo $propietario->apMat; ?></td>
					<th style="background-color: #f4f4f4;">Apellido Paterno</th>
					<td><?php echo $propietario->apPat; ?></td>
				</tr>
				<tr>
					<th style="background-color: #f4f4f4;">Estado</th>
					<td><?php echo $propietario->estado == 1 ? "Activo":"Inactivo"; ?></td>
				</tr>
				
			</tbody>
		</table>
	</div>
</div>
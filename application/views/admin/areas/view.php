<div class="row">
	<div class="col-xs-12">
		<table class="table table-bordered">
			<tbody>
				<tr>
					<th style="background-color: #f4f4f4;">Nombre del Área</th>
					<td><?php echo $area->nombre_area; ?></td>
				</tr>
				<tr>
					<th style="background-color: #f4f4f4;">Estado</th>
					<td><?php echo $area->id_status == 1 ? "Activa":"Inactivo"; ?></td>
				</tr>
				
			</tbody>
		</table>
	</div>
</div>
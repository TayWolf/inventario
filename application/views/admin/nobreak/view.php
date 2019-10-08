<div class="row">
	<div class="col-xs-12">
		<h2><strong>Codigo del No-BREAK : </strong> <?php echo $nobreak->no_serie; ?> </h2>
		<table class="table table-bordered">
			<tbody>	
				<tr>	
					<th style="background-color: #f4f4f4;">Modelo</th>
					<td><?php echo $nobreak->modelo; ?></td>
				</tr>
				<tr>
					<th style="background-color: #f4f4f4;">Área</th>
					<td><?php echo $nobreak->area; ?></td>
				</tr>
				<tr>
					<th style="background-color: #f4f4f4;">Descripcion</th>
					<td><?php echo $nobreak->descripcion; ?></td>
				</tr>
				<tr>
					<th style="background-color: #f4f4f4;">Fecha de Registro</th>
					<td><?php echo $nobreak->fecregistro; ?></td>
				</tr>
				<tr>
					<th style="background-color: #f4f4f4;">Estado</th>
					<td><?php echo $nobreak->estado == 1 ? "Activo":"Inactivo"; ?></td>
				</tr>
			</tbody>
		</table>
	</div>
</div>
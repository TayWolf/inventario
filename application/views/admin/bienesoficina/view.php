<div class="row">
	<div class="col-xs-12">
		<h2><strong>Codigo del Mobiliario de Oficina : </strong> <?php echo $bienoficina->no_serie; ?> </h2>
		<table class="table table-bordered">
			<tbody>	
				<tr>	
					<th style="background-color: #f4f4f4;">Modelo</th>
					<td><?php echo $bienoficina->modelo; ?></td>

					<th style="background-color: #f4f4f4;">Elemento</th>
					<td><?php echo $bienoficina->elemento; ?></td>
				</tr>
				<tr>

					<th style="background-color: #f4f4f4;">Tipo de Bien</th>
					<td><?php echo $bienoficina->nombre_bien; ?></td>
					
					<th style="background-color: #f4f4f4;">Descripcion</th>
					<td><?php echo $bienoficina->estado_bien; ?></td>
				</tr>
				<tr>
					<th style="background-color: #f4f4f4;">Fecha de Registro</th>
					<td><?php echo $bienoficina->fecregistro_bien; ?></td>
					
					<th style="background-color: #f4f4f4;">Estado</th>
					<td><?php echo $bienoficina->nombre_status?></td>
				</tr>
			</tbody>
		</table>
	</div>
</div>
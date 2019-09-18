<div class="row">
	<div class="col-xs-12">
		<table class="table table-bordered">
			<tbody>
				<tr>
					<th style="background-color: #f4f4f4;">IP</th>
					<td><?php echo $ip->descripcion; ?></td>
				</tr>
				<tr>
					<th style="background-color: #f4f4f4;">Estado</th>
					<td><?php echo $ip->estado == 1 ? "Ocupada":"Libre"; ?></td>
				</tr>
				
			</tbody>
		</table>
	</div>
</div>
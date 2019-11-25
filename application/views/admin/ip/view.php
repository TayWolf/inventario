<div class="row">
	<div class="col-xs-12">
		<table class="table table-bordered">
			<tbody>
				<tr>
					<th style="background-color: #f4f4f4;">DIRECCIÓN IP</th>
					<td><?php echo $ip->direccion_ip; ?></td>
				</tr>
				<tr>
					<th style="background-color: #f4f4f4;">RANGO IP</th>
					<td>
						<?php 
							if ($ip->rango_ip == 1) 
                            {
                              $ip->rango_ip = "Datos";
                            } 
                            else if ($ip->rango_ip == 2) 
                            {
                                $ip->rango_ip = "Voz";
                            } 
                            else{
                              $ip->rango_ip = "Servidores";
                            }
                    		echo  $ip->rango_ip;
						?>
					</td>
				</tr>
				<tr>
					<th style="background-color: #f4f4f4;">STATUS</th>
					<td><?php echo $ip->nombre_status == 1 ? "Ocupada":"Libre"; ?></td>
				</tr>
				
			</tbody>
		</table>
	</div>
</div>
<section class="content-header">
    <h1>
        Servidores <small>Editar</small>
    </h1>

</section>

<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="box box-solid">
    
        <div class="box-body">
            <div class="row">
                <div class="col-md-12 col-xs-12">
                    <form action="<?php echo base_url();?>bienes/servidores/update" method="POST">
                        <input type="hidden" name="idServidor" value="<?php echo $servidor->id_bien;?>">
                        <?php if ($this->session->flashdata("success")): ?>
                            <script>
                                swal("Registro Exitoso!", "Haz click en el botón para continuar registrando.", "success");
                            </script>
                        <?php endif ?>
                        <?php if ($this->session->flashdata("error")): ?>
                            <script>
                                swal("Error al Registrar!", "Haz click en el botón para volver intentarlo.", "error");
                            </script>
                        <?php endif ?>
                        
                         <div class="col-md-6 col-xs-12">
                            <div class="form-group">
                                <label for="no_serie">No. de Serie:</label>
                                <input type="text" name="no_serie" id="no_serie" class="form-control" value="<?php echo $servidor->no_serie ?>" required="required">
                            </div>
                            <div class="form-group">
                                <label for="modelo">Modelo:</label>
                                <input type="text" name="modelo" id="modelo" class="form-control" value="<?php echo $servidor->modelo ?>" required="required">
                            </div>
                            <div class="form-group">
                                <label for="ram">RAM:</label>
                                <input type="text" name="ram" id="ram" class="form-control" value="<?php echo $servidor->ram ?>">
                            </div>
                            <div class="form-group">
                                <label for="unidad_almacenamiento">Unidad de almacenamiento:</label>
                                <input type="text" name="unidad_almacenamiento" id="unidad_almacenamiento" class="form-control" value="<?php echo $servidor->unidad_almacenamiento ?>">
                            </div>
                            <div class="form-group">
                                <label for="procesador">Procesador:</label>
                                <input type="text" name="procesador" id="procesador" class="form-control" value="<?php echo $servidor->procesador ?>">
                            </div>
                            <div class="form-group">
                                <label for="estado_bien">Bitácora:</label>
                                <textarea style="resize: none;" type="text" name="estado_bien" id="estado_bien" class="form-control"><?php echo $servidor->estado_bien?></textarea>
                            </div>    
                        </div>

                        <div class="col-md-6 col-xs-12">
                            <div class="form-group">
                                <label for="id_marca">Marca:</label>
                                <select name="id_marca" id="id_marca" class="form-control" required="required">
                                    <option value="">Elije la marca</option>
                                    <?php foreach ($marcas as $marca): ?>
                                        <option value="<?php echo $marca->id_marca;?>" <?php echo $marca->id_marca == $servidor->id_marca ? "selected":"";?>><?php echo $marca->marca;?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="id_persona">Encargado:</label>
                                <select name="id_persona" id="id_persona" class="form-control">
                                    <option value="">Elije al encargado</option>
                                    <?php foreach ($personas as $persona): ?>
                                        <option value="<?php echo $persona->id_persona;?>" <?php echo $persona->id_persona == $servidor->id_persona ? "selected":"";?>><?php echo $persona->nombres.' '.$persona->ap_paterno.' '.$persona->ap_materno;?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="id_tipo_propiedad">Tipo de Propiedad:</label>
                                <select name="id_tipo_propiedad" id="id_tipo_propiedad" class="form-control">
                                    <option value="">Elije el tipo de propiedad</option>
                                    <?php foreach ($tipo_propiedades as $tipo_propiedad): ?>
                                        <option value="<?php echo $tipo_propiedad->id_tipo_propiedad;?>" <?php echo $tipo_propiedad->id_tipo_propiedad == $servidor->id_tipo_propiedad ? "selected":"";?>><?php echo $tipo_propiedad->tipo_propiedad;?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="id_ip">Dirección IP:</label>
                                <select name="id_ip" id="id_ip" class="form-control">
                                    <option value="">Elije la IP</option>
                                    <?php foreach ($ips as $ip): ?>
                                        <option value="<?php echo $ip->id_ip;?>" <?php echo $ip->id_ip == $servidor->id_ip ? "selected":"";?>><?php echo $ip->direccion_ip;?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="direccion_mac">MAC:</label>
                                <input type="text" name="direccion_mac" id="direccion_mac" class="form-control" value="<?php echo $servidor->direccion_mac ?>">
                            </div>
                            <div class="form-group">
                                <label for="sistema_operativo">Sistema Operativo:</label>
                                <input type="text" name="sistema_operativo" id="sistema_operativo" class="form-control" value="<?php echo $servidor->sistema_operativo ?>">
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <div class="form-group">
                                <label for="id_status">Status del servidor:</label>
                                <select name="id_status" id="id_status" class="form-control">
                                    <option value="">Elije el status del actual del servidor</option>
                                    <?php foreach ($status as $stat): ?>
                                        <option value="<?php echo $stat->id_status;?>" <?php echo $stat->id_status == $servidor->id_status ? "selected":"";?>><?php echo $stat->nombre_status;?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="submit" name="guardar" class="btn btn-success btn-flat" value="Guardar">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /.box-body -->
        
    </div>
    <!-- /.box -->
</section>
<!-- /.content -->
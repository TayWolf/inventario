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
<section class="content-header">
    <h1>
        CPU <small>Registro</small>
    </h1>

</section>

<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="box box-solid">
    
        <div class="box-body">
            <form action="<?php echo base_url();?>bienes/cpu/store" method="POST">
                <div class="row">
                    <div class="col-md-6 col-sm-8 col-xs-12">
                        <div class="form-group">
                            <label for="no_serie">No. Serie:</label>
                            <input type="text" name="no_serie" id="no_serie" class="form-control" required="required">
                        </div>
                        <div class="form-group">
                            <label for="marca">Marca:</label>
                            <select name="marca" id="marca" class="form-control" required="required">
                                <option value="">Elija marca</option>
                                <?php foreach ($marcas as $marca): ?>
                                    <option value="<?php echo $marca->id_marca;?>"><?php echo $marca->marca;?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="modelo">Modelo:</label>
                            <input type="text" name="modelo" id="modelo" class="form-control" required="required">
                        </div>
                        <div class="form-group">
                            <label for="procesador">Procesador:</label>
                            <input type="text" name="procesador" id="procesador" class="form-control" required="required">
                        </div>
                        <div class="form-group">
                            <label for="unidad_almacenamiento">Unidad de Almacenamiento:</label>
                            <input type="text" name="unidad_almacenamiento" id="unidad_almacenamiento" class="form-control" required="required">
                        </div>
                        <div class="form-group">
                            <label for="ram">RAM:</label>
                            <input type="text" name="ram" id="ram" class="form-control" required="required">
                        </div>
                        <div class="form-group">
                            <label for="direccion_mac">Direccion MAC:</label>
                            <input type="text" name="direccion_mac" id="direccion_mac" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="tipo_propiedad">Tipo de Propiedad:</label>
                            <select name="tipo_propiedad" id="tipo_propiedad" class="form-control" required="required">
                                <option value="">Elija el tipo de propiedad</option>
                                <?php foreach ($propiedades as $propiedad): ?>
                                    <option value="<?php echo $propiedad->id_tipo_propiedad;?>"><?php echo $propiedad->tipo_propiedad;?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="sistema_operativo">Sistema Operativo:</label>
                            <input type="text" name="sistema_operativo" id="sistema_operativo" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="ip">IP:</label>
                            <!-- <input type="text" name="ip" id="ip" class="form-control"> -->
                            <select name="ip" id="ip" class="form-control" required="required">
                                <option value="">Elija la IP</option>
                                <?php foreach ($ips as $ip): ?>
                                    <option value="<?php echo $ip->id_ip;?>"><?php echo $ip->direccion_ip;?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="status">Estado del CPU:</label>
                            <select name="status" id="status" class="form-control" required="required">
                                <option value="">Elija el estado</option>
                                <?php foreach ($status as $stat): ?>
                                    <option value="<?php echo $stat->id_status;?>"><?php echo $stat->nombre_status;?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="personas">Usuario del Equipo:</label>
                            <!-- <input type="text" name="propietario" id="propietario" class="form-control"> -->
                            <select name="personas" id="personas" class="form-control">
                                <option value="">Elija el usuario del equipo</option>
                                <?php foreach ($personas as $persona): ?>
                                    <option value="<?php echo $persona->id_persona;?>"><?php echo $persona->nombres.' '.$persona->ap_paterno.' '.$persona->ap_materno;?></option>
                                <?php endforeach ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="bitacora">Bitacora del CPU:</label>
                            <textarea name="bitacora" class="form-control" id="bitacora" rows="12" cols="50" style="resize: none;"></textarea>
                        </div>
                    </div>

                    
                </div>
                <div class="row">
                    <div class="col-md-12 form-group">
                        <input type="submit" name="guardar" class="btn btn-success btn-flat" value="Guardar">
                    </div>
                </div>
            </form>
        </div>
        <!-- /.box-body -->
        
    </div>
    <!-- /.box -->
</section>
<!-- /.content -->
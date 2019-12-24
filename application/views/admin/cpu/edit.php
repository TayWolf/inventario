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
        Computadoras <small>Editar</small>
    </h1>

</section>

<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="box box-solid">
    
        <div class="box-body">
            <form action="<?php echo base_url();?>bienes/cpu/update" method="POST">
                <input type="hidden" name="idBien" value="<?php echo $computadora->id_bien?>">
                <div class="row">
                    <div class="col-md-6 col-sm-8 col-xs-12">
                        <div class="form-group">
                            <label for="folio_remision">Folio de Remisión:</label>
                            <input type="text" name="folio_remision" id="folio_remision" class="form-control" required="required" value="<?php echo $computadora->folio_remision?>">
                        </div>
                        <div class="form-group">
                            <label for="no_serie">No. Serie:</label>
                            <input type="text" name="no_serie" id="no_serie" class="form-control" required="required" value="<?php echo $computadora->no_serie?>">
                        </div>
                        <div class="form-group">
                            <label for="monitor">No. Serie Monitor:</label>
                            <input type="text" name="monitor" id="monitor" class="form-control" required="required" value="<?php echo $computadora->monitor?>">
                        </div>
                        <div class="form-group">
                            <label for="no_break">No. Serie No-BREAK:</label>
                            <input type="text" name="no_break" id="no_break" class="form-control" required="required" value="<?php echo $computadora->no_break?>">
                        </div>
                        <div class="form-group">
                            <label for="marca">Marca:</label>
                            <select name="marca" id="marca" class="form-control" required="required">
                                <option value="">Elija marca</option>
                                <?php foreach ($marcas as $marca): ?>
                                    <option value="<?php echo $marca->id_marca;?>" <?php echo $marca->id_marca == $marca->id_marca ? "selected":"";?>><?php echo $marca->marca;?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                         <div class="form-group">
                            <label for="modelo">Modelo:</label>
                            <input type="text" name="modelo" id="modelo" class="form-control" value="<?php echo $computadora->modelo?>">
                        </div>
                        <div class="form-group">
                            <label for="procesador">Procesador:</label>
                            <input type="text" name="procesador" id="procesador" class="form-control" value="<?php echo $computadora->procesador?>">
                        </div>
                        <div class="form-group">
                            <label for="unidad_almacenamiento">Unidad de Almacenamiento:</label>
                            <input type="text" name="unidad_almacenamiento" id="unidad_almacenamiento" class="form-control" value="<?php echo $computadora->unidad_almacenamiento?>">
                        </div>
                        <div class="form-group">
                            <label for="ram">RAM:</label>
                            <input type="text" name="ram" id="ram" class="form-control" value="<?php echo $computadora->ram?>">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="direccion_mac">Direccion MAC:</label>
                            <input type="text" name="direccion_mac" id="direccion_mac" class="form-control" value="<?php echo $computadora->direccion_mac?>">
                        </div>
                        <div class="form-group">
                            <label for="tipo_propiedad">Tipo de Propiedad:</label>
                            <select name="tipo_propiedad" id="tipo_propiedad" class="form-control" required="required">
                                <option value="">Elija el tipo de propiedad</option>
                                <?php foreach ($propiedades as $propiedad): ?>
                                    <option value="<?php echo $propiedad->id_tipo_propiedad;?>" <?php echo $propiedad->id_tipo_propiedad == $computadora->id_tipo_propiedad ? "selected":"";?>><?php echo $propiedad->tipo_propiedad;?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="sistema_operativo">Sistema Operativo:</label>
                            <input type="text" name="sistema_operativo" id="sistema_operativo" class="form-control" value="<?php echo $computadora->sistema_operativo?>">
                        </div>
                        <div class="form-group">
                            <label for="ip">IP:</label>
                            <!-- <input type="text" name="ip" id="ip" class="form-control"> -->
                            <select name="ip" id="ip" class="form-control">
                                <option value="">Elija la IP</option>
                                <?php foreach ($ips as $ip): ?>
                                    <option value="<?php echo $ip->id_ip;?>" <?php echo $ip->id_ip == $computadora->id_ip ? "selected":"";?>><?php echo $ip->direccion_ip;?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="status">Estado del CPU:</label>
                            <select name="status" id="status" class="form-control" required="required">
                                <option value="">Elija el estado</option>
                                <?php foreach ($status as $stat): ?>
                                    <option value="<?php echo $stat->id_status;?>" <?php echo $stat->id_status == $computadora->id_status ? "selected":"";?>><?php echo $stat->nombre_status;?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="personas">Usuario del Equipo:</label>
                            <!-- <input type="text" name="propietario" id="propietario" class="form-control"> -->
                            <select name="personas" id="personas" class="form-control">
                                <option value="">Elija el usuario del equipo</option>
                                <?php foreach ($personas as $persona): ?>
                                    <option value="<?php echo $persona->id_persona;?>" <?php echo $persona->id_persona == $computadora->id_persona ? "selected":"";?>><?php echo $persona->nombres.' '.$persona->ap_paterno.' '.$persona->ap_materno;?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="bitacora">Bitacora del CPU:</label>
                            <textarea name="bitacora" class="form-control" id="bitacora" rows="8" cols="50" style="resize: none;"><?php echo $computadora->estado_bien?></textarea>
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
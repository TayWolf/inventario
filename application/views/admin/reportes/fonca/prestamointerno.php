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
        Formato <small>Préstamo Interno</small>
    </h1>

</section>

<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="box box-solid">
    
        <div class="box-body">
            <form action="<?php echo base_url();?>reportes/busquedaavanzada/generarPDF" id="formprestamointerno" method="POST" target="_blank">
                <input type="hidden" id="tipoarchivo" name="tipoarchivo" value="1">
                <div class="row">
                    <div class="col-md-6 col-sm-8 col-xs-12">
                        <div class="form-group">
                            <label for="personas">Nombre:</label>
                            <!-- <input type="text" name="propietario" id="propietario" class="form-control"> -->
                            <select name="personas" id="personas" class="form-control">
                                <option value="">Elija el usuario al que se le prestará equipo</option>
                                <?php foreach ($personas as $persona): ?>
                                    <option value="<?php echo $persona->id_persona;?>"><?php echo $persona->nombres.' '.$persona->ap_paterno.' '.$persona->ap_materno;?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="personas">Área:</label>
                            <!-- <input type="text" name="propietario" id="propietario" class="form-control"> -->
                            <select name="personas" id="personas" class="form-control">
                                <option value="">Elija el área a la que pertenece</option>
                                <?php foreach ($personas as $persona): ?>
                                    <option value="<?php echo $persona->id_persona;?>"><?php echo $persona->nombres.' '.$persona->ap_paterno.' '.$persona->ap_materno;?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="marca">Marca:</label>
                            <select name="marca" id="marca" class="form-control">
                                <option value="">Elija marca</option>
                                <?php foreach ($marcas as $marca): ?>
                                    <option value="<?php echo $marca->id_marca;?>"><?php echo $marca->marca;?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="modelo">Modelo:</label>
                            <input type="text" name="modelo" id="modelo" class="form-control">
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="procesador">No. de Serie:</label>
                            <input type="text" name="procesador" id="procesador" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="ip">IP:</label>
                            <!-- <input type="text" name="ip" id="ip" class="form-control"> -->
                            <select name="ip" id="ip" class="form-control">
                                <option value="">Elija la IP</option>
                                <?php foreach ($ips as $ip): ?>
                                    <option value="<?php echo $ip->id_ip;?>"><?php echo $ip->direccion_ip;?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="status">Estado del CPU:</label>
                            <select name="status" id="status" class="form-control">
                                <option value="">Elija el estado</option>
                                <?php foreach ($status as $stat): ?>
                                    <option value="<?php echo $stat->id_status;?>"><?php echo $stat->nombre_status;?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="bitacora">Descripción:</label>
                            <textarea name="bitacora" class="form-control" id="bitacora" rows="1" cols="50" style="resize: none;"></textarea>
                        </div>
                    </div>
                </div>
            </form>
            <div class="row">
                <div class="col-md-12 form-group" style="text-align: center;">
                    <a href="#" name="file-pdf" class="btn btn-primary btn-flat" onclick="javascript:document.getElementById('formprestamointerno').submit(); return false;">Generar PDF</a>
                </div>
            </div>
        </div>
        <!-- /.box-body -->
        
    </div>
    <!-- /.box -->
</section>
<!-- /.content -->
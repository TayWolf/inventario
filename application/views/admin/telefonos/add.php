<section class="content-header">
    <h1>
        Teléfono <small>Registro</small>
    </h1>

</section>

<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="box box-solid">
    
        <div class="box-body">
            <div class="row">
                <div class="col-md-6 col-sm-8 col-xs-12">
                    <form action="<?php echo base_url();?>equipos/telefonos/store" method="POST">
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
                        
                        <div class="form-group">
                            <label for="no_ext">No. EXT:</label>
                            <input type="text" name="no_ext" id="no_ext" class="form-control" required="required">
                        </div>
                        <div class="form-group">
                            <label for="no_serie">No. Serie:</label>
                            <input type="text" name="no_serie" id="no_serie" class="form-control" required="required">
                        </div>
                        <div class="form-group">
                            <label for="modelo">Modelo:</label>
                            <input type="text" name="modelo" id="modelo" class="form-control" required="required">
                        </div>
                        <div class="form-group">
                            <label for="area">Área:</label>
                            <select name="area" id="area" class="form-control" required="required">
                                <option value="">Elija área</option>
                                <?php foreach ($areas as $area): ?>
                                    <option value="<?php echo $area->id;?>"><?php echo $area->nombre;?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="usuario_telefono">Usuario:</label>
                            <input type="text" name="usuario_telefono" id="usuario_telefono" class="form-control" required="required">
                        </div>
                        <div class="form-group">
                            <label for="ip">IP:</label>
                            <select name="ip" id="ip" class="form-control" required="required">
                                <option value="">Elija IP</option>
                                <?php foreach ($ips as $ip): ?>
                                    <option value="<?php echo $ip->id;?>"><?php echo $ip->descripcion;?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <input type="submit" name="guardar" class="btn btn-success btn-flat" value="Guardar">
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
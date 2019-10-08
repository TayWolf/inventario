<section class="content-header">
    <h1>
        No-BREAK <small>Editar</small>
    </h1>

</section>

<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="box box-solid">
    
        <div class="box-body">
            <div class="row">
                <div class="col-md-6 col-sm-8 col-xs-12">
                    <form action="<?php echo base_url();?>equipos/nobreak/update" method="POST">
                        <input type="hidden" name="idNobreak" value="<?php echo $nobreak->id;?>">
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
                            <label for="no_serie">No. de Serie:</label>
                            <input type="text" name="no_serie" id="no_serie" class="form-control" required="required" value="<?php echo $nobreak->no_serie ?>">
                        </div>
                        <div class="form-group">
                            <label for="modelo">Modelo:</label>
                            <input type="text" name="modelo" id="modelo" class="form-control" required="required" value="<?php echo $nobreak->modelo; ?>">
                        </div>
                        <div class="form-group">
                            <label for="area">Área:</label>
                            <select name="area" id="area" class="form-control" required="required">
                                <option value="">Elija el área</option>
                                <?php foreach ($areas as $area): ?>
                                    <option value="<?php echo $area->id;?>" <?php echo $area->id == $nobreak->id_area ? "selected":"";?>><?php echo $area->nombre;?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="descripcion">Descripcion:</label>
                            <input type="text" name="descripcion" id="descripcion" class="form-control" required="required" value="<?php echo $nobreak->descripcion; ?>">
                        </div>
                        <?php if ($nobreak->estado == 0): ?>
                            <div class="form-group">
                                <label for="">Estado:</label>
                                <select name="estado" id="estado" required class="form-control">
                                    <option value="1">Activo</option>
                                    <option value="2" selected>Inactivo</option>
                                </select>
                            </div>
                        <?php endif ?>
                        
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
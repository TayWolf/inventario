<section class="content-header">
    <h1>
        Mobiliario de Oficina <small>Registro</small>
    </h1>

</section>

<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="box box-solid">
    
        <div class="box-body">
            <div class="row">
                <div class="col-md-6 col-sm-8 col-xs-12">
                    <form action="<?php echo base_url();?>bienes/oficina/store" method="POST">
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
                        <!-- <div class="form-group">
                            <label for="area">Área:</label>
                            <select name="area" id="area" class="form-control" required="required">
                                <option value="">Elije el Área</option>
                                <?php foreach ($areas as $area): ?>
                                    <option value="<?php echo $area->id;?>"><?php echo $area->nombre;?></option>
                                <?php endforeach ?>
                            </select>
                        </div> -->
                        <div class="form-group">
                            <label for="descripcion">Nombre:</label>
                            <input type="text" name="descripcion" id="descripcion" class="form-control">
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
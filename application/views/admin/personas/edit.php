<section class="content-header">
    <h1>
        Antivirus <small>Editar</small>
    </h1>

</section>

<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="box box-solid">
    
        <div class="box-body">
            <div class="row">
                <div class="col-md-6 col-sm-8 col-xs-12">
                    <form action="<?php echo base_url();?>configuraciones/propietario/update" method="POST">

                        <input type="hidden" name="idAntivir" value="<?php echo $propietario->id;?>">
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
                            <label for="nombre">Nombre(s):</label>
                            <input type="text" name="nombre" id="nombre" class="form-control" value="<?php echo $propietario->nombre?>"  required="required">
                        </div>

                         <div class="form-group">
                            <label for="apMat">Apellido Materno:</label>
                            <input type="text" name="apMat" id="apMat" class="form-control" value="<?php echo $propietario->apMat?>"  required="required">
                        </div>

                         <div class="form-group">
                            <label for="apPat">Apellido Paterno:</label>
                            <input type="text" name="apPat" id="apPat" class="form-control" value="<?php echo $propietario->apPat?>"  required="required">
                        </div>

                        <?php if ($propietario->estado == 0): ?>
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
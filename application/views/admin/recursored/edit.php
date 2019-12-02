<section class="content-header">
    <h1>
        Recurso de Red <small>Editar</small>
    </h1>

</section>

<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="box box-solid">
    
        <div class="box-body">
            <div class="row">
                <div class="col-xs-12">
                    <form action="<?php echo base_url();?>configuraciones/recursored/update" method="POST">

                        <input type="hidden" name="idRecursoRed" value="<?php echo $recursored->id_clave_acceso;?>">
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
                                <label for="id_tipo_clave">Tipo de Clave:</label>
                                <select name="id_tipo_clave" id="id_tipo_clave" class="form-control" required="required">
                                    <option value="">Elija el tipo de clave</option>
                                    <?php foreach ($tipo_claves as $tipo_clave): ?>
                                        <option value="<?php echo $tipo_clave->id_tipo_clave;?>" <?php echo $tipo_clave->id_tipo_clave == $recursored->id_tipo_clave ? "selected":"";?>><?php echo $tipo_clave->nombre_tipo_acceso;?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="id_persona">Persona:</label>
                                <select name="id_persona" id="id_persona" class="form-control" required="required">
                                    <option value="">Elija la persona a la que desea asignar una clave de acceso</option>
                                    <?php foreach ($personas as $persona): ?>
                                        <option value="<?php echo $persona->id_persona;?>" <?php echo $persona->id_persona == $recursored->id_persona ? "selected":"";?>><?php echo $persona->nombres.' '.$persona->ap_paterno.' '.$persona->ap_materno;?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 col-xs-12">
                            <div class="form-group">
                                <label for="usuario_acceso">Usuario:</label>
                                <input type="text" name="usuario_acceso" id="usuario_acceso" class="form-control" value="<?php echo $recursored->usuario_acceso?>" required="required">
                            </div>
                            <div class="form-group">
                                <label for="clave_acceso">Contraseña:</label>
                                <input type="text" name="clave_acceso" id="clave_acceso" class="form-control" value="<?php echo $recursored->clave_acceso?>" required="required">
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <div class="form-group">
                                <label for="id_status">Status:</label>
                                <select name="id_status" id="id_status" class="form-control" required="required">
                                    <option value="">Elija el status que desea asignar a la clave de acceso</option>
                                    <?php foreach ($status as $stat): ?>
                                        <option value="<?php echo $stat->id_status;?>" <?php echo $stat->id_status == $recursored->id_status ? "selected":"";?>><?php echo $stat->nombre_status;?></option>
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
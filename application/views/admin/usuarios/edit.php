<section class="content-header">
    <h1>
        Usuarios <small> Editar</small>
    </h1>

</section>

<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="box box-solid">
    
        <div class="box-body">
            <div class="row">
                <div class="col-md-6 col-sm-8 col-xs-12">
                    <form action="<?php echo base_url();?>administrador/usuarios/update" method="POST">
                        <?php if ($this->session->flashdata("success")): ?>
                            <script>
                                swal("Registro Actualizado!", "Haz click en el botón para continuar.", "success");
                            </script>
                        <?php endif ?>
                        <?php if ($this->session->flashdata("error")): ?>
                            <script>
                                swal("Error al Actualizar!", "Haz click en el botón para volver intentarlo.", "error");
                            </script>
                        <?php endif ?>
                        <input type="hidden" name="idUsuario" value="<?php echo $usuario->id_usuario;?>">
                        <div class="form-group">
                            <label for="cedula">Cedula:</label>
                            <input type="text" name="cedula" class="form-control" required="required" value="<?php echo $usuario->curp?>">
                        </div>
                        <div class="form-group">
                            <label for="nombres">Nombres y Apellidos</label>
                            <input type="text" name="nombres" class="form-control" required="required" value="<?php echo $usuario->nombres.' '.$usuario->ap_paterno.' '.$usuario->ap_materno ?>">
                        </div>
                        <div class="form-group">
                            <label for="email">Nombre de Usuario:</label>
                            <input type="text" name="email" class="form-control" required="required" value="<?php echo $usuario->usuario?>">
                        </div>
                        <div class="form-group">
                            <label for="rol">Rol:</label>
                            <select name="rol" id="rol" required class="form-control">
                                <option value="">Seleccione Rol</option>
                                <?php foreach ($roles as $rol): ?>
                                    <option value="<?php echo $rol->id_rol?>" <?php echo $rol->id_rol == $usuario->id_rol ? "selected":"";?>><?php echo $rol->nombre_rol;?></option>
                                <?php endforeach ?>
                            </select>
                        </div >
                        <?php if ($usuario->id_status == 2): ?>
                            <div class="form-group">
                                <label for="estado">Estado:</label>
                                <select name="estado" id="estado" required class="form-control">
                                    <option value="1">Activo</option>
                                    <option value="2" selected>Inactivo</option>
                                </select>
                            </div>
                        <?php endif ?>
                        <div class="form-group">
                            <input type="submit" name="guardar" class="btn btn-success btn-flat" value="Guardar">
                            <a href="<?php echo base_url();?>administrador/usuarios" class="btn btn-danger btn-flat"> Volver</a>
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
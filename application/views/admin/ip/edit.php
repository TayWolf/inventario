<section class="content-header">
    <h1>
        IP's <small>Editar</small>
    </h1>

</section>

<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="box box-solid">
    
        <div class="box-body">
            <div class="row">
                <div class="col-md-6 col-sm-8 col-xs-12">
                    <form action="<?php echo base_url();?>configuraciones/ip/update" method="POST">

                        <input type="hidden" name="idIp" value="<?php echo $ip->id_ip;?>">
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
                            <label for="direccion_ip">Dirección IP:</label>
                            <input type="text" name="direccion_ip" id="direccion_ip" class="form-control" value="<?php echo $ip->direccion_ip?>"  required="required">
                        </div>
                        
                        <?php if ($ip->rango_ip == 1): ?>
                            <div class="form-group">
                                <label for="rango_ip">Rango de la IP:</label>
                                <select name="rango_ip" id="rango_ip" required class="form-control">
                                    <option value="">Elija el rango de la IP</option>
                                    <option value="1" selected>Datos</option>
                                    <option value="2">Voz</option>
                                    <option value="3">Servidor</option>
                                </select>
                            </div>
                        <?php endif ?>

                        <?php if ($ip->rango_ip == 2): ?>
                            <div class="form-group">
                                <label for="rango_ip">Rango de la IP:</label>
                                <select name="rango_ip" id="rango_ip" required class="form-control">
                                    <option value="">Elija el rango de la IP</option>
                                    <option value="1">Datos</option>
                                    <option value="2" selected>Voz</option>
                                    <option value="3">Servidor</option>
                                </select>
                            </div>
                        <?php endif ?>

                        <?php if ($ip->rango_ip == 3): ?>
                            <div class="form-group">
                                <label for="rango_ip">Rango de la IP:</label>
                                <select name="rango_ip" id="rango_ip" required class="form-control">
                                    <option value="">Elija el rango de la IP</option>
                                    <option value="1">Datos</option>
                                    <option value="2">Voz</option>
                                    <option value="3" selected>Servidor</option>
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
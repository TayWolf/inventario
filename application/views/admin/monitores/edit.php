<section class="content-header">
    <h1>
        Monitores <small>Editar</small>
    </h1>

</section>

<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="box box-solid">
    
        <div class="box-body">
            <div class="row">
                <div class="col-xs-12">
                    <form action="<?php echo base_url();?>bienes/monitores/update" method="POST">
                        <input type="hidden" name="idMonitor" value="<?php echo $monitor->id_bien;?>">
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
                                <label for="no_serie">No. Serie:</label>
                                <input type="text" name="no_serie" id="no_serie" class="form-control" value="<?php echo $monitor->no_serie;?>" required="required">
                            </div>
                            <div class="form-group">
                                <label for="modelo">Modelo:</label>
                                <input type="text" name="modelo" id="modelo" class="form-control" value="<?php echo $monitor->modelo;?>" required="required">
                            </div>
                            <div class="form-group">
                                <label for="marca">Marca:</label>
                                <select name="marca" id="marca" class="form-control" required="required">
                                    <option value="">Elija marca</option>
                                    <?php foreach ($marcas as $marca): ?>
                                    <option value="<?php echo $marca->id_marca;?>" <?php echo $marca->id_marca==$monitor->id_marca?"selected":"";?>><?php echo $marca->marca;?></option>
                                <?php endforeach ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="status">Status:</label>
                                <select name="status" id="status" class="form-control" required="required">
                                    <option value="">Elija el estado del monitor</option>
                                    <?php foreach ($status as $stat): ?>
                                    <option value="<?php echo $stat->id_status;?>" <?php echo $stat->id_status==$monitor->id_status?"selected":"";?>><?php echo $stat->nombre_status;?></option>
                                <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 col-xs-12">
                            <div class="form-group">
                                <label for="id_tipo_propiedad">Tipo de Propiedad:</label>
                                <select name="id_tipo_propiedad" id="id_tipo_propiedad" class="form-control" required="required">
                                    <option value="">Elija el tipo de propiedad del monitor</option>
                                    <?php foreach ($tipo_propiedades as $tipo_propiedad): ?>
                                        <option value="<?php echo $tipo_propiedad->id_tipo_propiedad;?>" <?php echo $tipo_propiedad->id_tipo_propiedad==$monitor->id_tipo_propiedad?"selected":"";?>><?php echo $tipo_propiedad->tipo_propiedad;?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="persona">Persona:</label>
                                <select name="persona" id="persona" class="form-control">
                                    <option value="">Elija el propietario del monitor</option>
                                    <?php foreach ($personas as $persona): ?>
                                        <option value="<?php echo $persona->id_persona;?>" <?php echo $persona->id_persona==$monitor->id_persona?"selected":"";?>><?php echo $persona->nombres.' '.$persona->ap_paterno.' '.$persona->ap_materno;?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="estado_bien">Bitácora del monitor:</label>
                                <textarea name="estado_bien" id="estado_bien" class="form-control" rows="5" cols="50" style="resize: none;"><?php echo $monitor->estado_bien;?></textarea>
                            </div>
                        </div>
                        <div class="col-xs-12">
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
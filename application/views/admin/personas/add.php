<section class="content-header">
    <h1>
        Propietario <small>Registro</small>
    </h1>

</section>

<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="box box-solid">
        <div class="box-body">
            <form action="<?php echo base_url();?>configuraciones/propietario/store" method="POST">
                <div class="row">
                    <div class="col-md-6 col-sm-8 col-xs-12">
                        <div class="form-group">
                            <label for="nombres">Nombre(s):</label>
                            <input type="text" name="nombres" id="nombres" class="form-control" required="required">
                        </div>
                        <div class="form-group">
                            <label for="apPat">Apellido Paterno:</label>
                            <input type="text" name="apPat" id="apPat" class="form-control" required="required">
                        </div>
                        <div class="form-group">
                            <label for="apMat">Apellido Materno:</label>
                            <input type="text" name="apMat" id="apMat" class="form-control" required="required">
                        </div>
                        <div class="form-group">
                                <label for="sexo">Sexo:</label>
                                <select name="sexo" id="sexo" required class="form-control">
                                    <option value="">Elija el sexo</option>
                                    <option value="1">Femenino</option>
                                    <option value="2">Masculino</option>
                                </select>
                            </div>
                        <div class="form-group">
                            <label for="curp">CURP:</label>
                            <input type="text" name="curp" id="curp" class="form-control" required="required">
                        </div>
                        <div class="form-group">
                            <label for="rfc">RFC:</label>
                            <input type="text" name="rfc" id="rfc" class="form-control">
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="id_area">Área:</label>
                            <!-- <input type="text" name="ip" id="ip" class="form-control"> -->
                            <select name="id_area" id="id_area" class="form-control" required="required">
                                <option value="">Elija el área</option>
                                <?php foreach ($areas as $area): ?>
                                    <option value="<?php echo $area->id_area;?>"><?php echo $area->nombre_area;?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="id_cargo">Cargo:</label>
                            <select name="id_cargo" id="id_cargo" class="form-control" required="required">
                                <option value="">Elija el cargo</option>
                                <?php foreach ($cargos as $cargo): ?>
                                    <option value="<?php echo $cargo->id_cargo;?>"><?php echo $cargo->cargo;?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <div class="form-group">
                                <label for="file">Foto:</label>
                                <input type="file" class="form-control" name="file">
                                <span class="help-block">Seleccione archivo .jpg  y .png</span>
                            </div>
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
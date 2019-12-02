<section class="content-header">
    <h1>
        Recurso de Red <small> Listado</small>
    </h1>

</section>
<?php if ($this->session->flashdata("success")): ?>
    <script>
        swal("Registro Actualizado!","<?php echo $this->session->flashdata("success"); ?>", "success");
    </script>
<?php endif ?>
<?php if ($this->session->flashdata("error")): ?>
    <script>
        swal("Error al Registrar!", "Haz click en el botón para volver intentarlo.", "error");
    </script>
<?php endif ?>
<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="box box-solid">
    
        <div class="box-body">
            <input type="hidden" id="modulo" value="recursored">
            <div class="row">
                <div class="col-md-12">
                    <a href="<?php echo base_url();?>configuraciones/recursored/add" class="btn btn-primary btn-flat"><span class="fa fa-plus"></span>Agregar Recurso de Red</a>
                    <hr>
                    <div class="table-responsive">
                        <table id="tb-without-buttons" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Tipo de Clave</th>
                                    <th>Persona</th>
                                    <th>Usuario de Acceso</th>
                                    <th>Clave de Accesso</th>
                                    <th>Status</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($recursored as $rr): ?>
                                    <tr>
                                        <td><?php echo $rr->id_clave_acceso?></td>
                                        <td><?php echo $rr->nombre_tipo_acceso?></td>
                                        <td><?php echo $rr->nombres.' '.$rr->ap_paterno.' '.$rr->ap_materno?></td>
                                        <td><?php echo $rr->usuario_acceso  ?></td>
                                        <td><?php echo $rr->clave_acceso?></td>
                                        <td><?php echo $rr->nombre_status;?></td>
                                        <td>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-primary btn-flat btn-view-conf" data-toggle="modal" data-target="#modal-default" value="<?php echo $rr->id_clave_acceso;?>" title="Ver">
                                                    <span class="fa fa-eye"></span>
                                                </button>
                                                <a href="<?php echo base_url();?>configuraciones/recursored/edit/<?php echo $rr->id_clave_acceso?>" class="btn btn-warning btn-flat" title="Editar"><span class="fa fa-pencil"></span></a>
                                                <?php if ($this->session->userdata("id_rol") == 1): ?>
                                                    <a href="<?php echo base_url();?>configuraciones/recursored/delete/<?php echo $rr->id_clave_acceso?>" class="btn btn-danger btn-flat btn-delete" title="Eliminar">
                                                    <span class="fa fa-times"></span>
                                                </a>
                                                <?php endif ?>
                                                
                                            </div>
                                        </td>

                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.box-body -->
        
    </div>
    <!-- /.box -->
</section>
<!-- /.content -->


<div class="modal fade" id="modal-default">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Informacion del Recurso de Red</h4>
      </div>
      <div class="modal-body">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary btn-print"><span class="fa fa-print"> </span>Imprimir</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
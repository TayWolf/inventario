<section class="content-header">
    <h1>
        CPU <small> Listado</small>
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
            <input type="hidden" id="modulo" value="cpu">
            
            <div class="row">
                <div class="col-md-12">
                    <a href="<?php echo base_url();?>bienes/cpu/add" class="btn btn-primary btn-flat"><span class="fa fa-plus"></span>Agregar CPU</a>
                    <hr>
                    <div class="table-responsive">
                        <table id="tb-without-buttons" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Folio de Remisión</th>
                                    <th>Propietario</th>
                                    <th>Elemento</th>
                                    <th>No. Serie</th>
                                    <th>Monitor</th>
                                    <th>No-Break</th>
                                    <th>IP</th>
                                    <th>No. Ext</th>
                                    <th>Fec. Registro</th>
                                    <th>Perfil</th>

                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $cont = 1;
                                foreach ($computadoras as $computadora): ?>
                                    <tr>
                                        <td><?php echo $cont?></td>
                                        <td><?php echo $computadora->folio_remision?></td>
                                        <td><?php echo $computadora->nombres.' '.$computadora->ap_paterno.' '.$computadora->ap_materno?></td>
                                        <td><?php echo $computadora->elemento?></td>
                                        <td><?php echo $computadora->no_serie?></td>
                                        <td><?php echo $computadora->monitor?></td>                                      
                                        <td><?php echo $computadora->no_break?></td>
                                        <td><?php echo $computadora->direccion_ip?></td>
                                        <td><?php echo $computadora->no_ext_tel?></td>
                                        <td><?php echo $computadora->fecregistro_bien?></td>
                                        <td><?php echo $computadora->nombre_perfil?></td>   
                                        
                                        <td>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-primary btn-flat btn-view" data-toggle="modal" data-target="#modal-default" value="<?php echo $computadora->id_bien;?>" title="Ver">
                                                    <span class="fa fa-eye"></span>
                                                </button>
                                                <a href="<?php echo base_url();?>bienes/cpu/edit/<?php echo $computadora->id_bien?>" class="btn btn-warning btn-flat" title="Editar"><span class="fa fa-pencil"></span></a>
                                                <?php if ($this->session->userdata("id_rol") == 1): ?>
                                                    <a href="<?php echo base_url();?>bienes/cpu/delete/<?php echo $computadora->id_bien?>" class="btn btn-danger btn-flat btn-delete" title="Eliminar">
                                                        <span class="fa fa-times"></span>
                                                    </a>
                                                <?php endif;?>
                                                
                                                <button type="button" class="btn btn-info btn-flat btn-mante" data-toggle="modal" data-target="#modal-mantenimiento" title="Mantenimientos" value="<?php echo $computadora->id_bien;?>">
                                                    <span class="fa fa-wrench"></span>

                                                <!-- <button type="button" class="btn btn-default btn-flat btn-mante" data-toggle="modal" data-target="#modal-usuario" title="Usuario del equipo" value="<?php echo $computadora->id_bien;?>">
                                                    <span class="fa fa-user"></span>
                                                </button> -->
                                            </div>
                                        </td>
                                    </tr>
                                    <?php $cont = $cont + 1; ?>
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
        <h4 class="modal-title">Informacion de la Computadora</h4>
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

<div class="modal fade" id="modal-mantenimiento">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Mantenimiento</h4>
      </div>
      <div class="modal-body">

        <ul class="nav nav-tabs">
            <!-- <li><a data-toggle="tab" href="#listado">Listado</a></li> -->
            <li class="active"><a data-toggle="tab" href="#agregar">Agregar</a></li>
            
        </ul>

        <div class="tab-content">
            <!-- <div id="listado" class="tab-pane fade in active">
                <h2>Ultimos Mantenimientos</h2>
                <table class="table table-bordered" id="tbmantenimientos">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Fecha</th>
                            <th>Tecnico</th>
                            <th>Descripcion</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div> -->
            <div id="agregar" class="tab-pane fade in active">
                <h2>Nuevo Mantenimiento</h2>
                <form action="<?php echo base_url();?>bienes/cpu/addmantenimiento" method="POST">
                    <input type="hidden" name="idequipo" id="idequipo">
                    <div class="form-group">
                        <label for="">Fecha</label>
                        <input type="date" class="form-control" name="fecha" value="<?php echo date("Y-m-d")?>" required="required">
                    </div>
                    <div class="form-group">
                        <label for="">Tecnico</label>
                        <input type="text" name="tecnico" id="tecnico" class="form-control" disabled="" value="<?php echo $this->session->userdata("usuario") ?>">
                    </div>
                    <div class="form-group">
                        <label for="">Descripcion</label>
                        <textarea name="descripcion" id="descripcion"  rows="3" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<div class="modal fade" id="modal-usuario">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Usuario del equipo</h4>
      </div>
      <div class="modal-body">

        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#listadoUsuario">Listado</a></li>
            <li><a data-toggle="tab" href="#agregarUsuario">Agregar</a></li>
            
        </ul>

        <div class="tab-content">
            <div id="listadoUsuario" class="tab-pane fade in active">
                <h2>Usuario(s) del equipo</h2>
                <table class="table table-bordered" id="tbusuario">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Propietario</th>
                            <th>Recurso de Red</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
            <div id="agregarUsuario" class="tab-pane fade">
                <h2>Agregar Propietario</h2>
                <form action="<?php echo base_url();?>equipos/computadoras/addUsuarios" method="POST">
                    <input type="hidden" name="idPropietario" id="idPropietario">
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <select name="nombre" id="nombre" class="form-control" required="required">
                            <option value="">Elije el propietario del equipo</option>
                            <?php foreach ($propietarios as $propietario): ?>
                                <option value="<?php echo $propietario->id;?>"><?php echo $propietario->nombre.' '.$propietario->apMat.' '.$propietario->apPat;?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                  
                    <div class="form-group">
                        <button type="submit" class="btn btn-success">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
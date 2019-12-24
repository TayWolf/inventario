<style>
    .dataTables_wrapper .dataTables_filter 
    {
        float: right;
        text-align: right;
        visibility: hidden;
    }
</style>
<section class="content-header">
    <h1>
        Reportes <small> Búsqueda</small>
    </h1>

</section>
<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="box box-solid">
    
        <div class="box-body">
            <input type="hidden" id="modulo" value="cpu">
            <div class="row">
                    <div class="col-md-1 col-md-offset-2">
                        <div class="form-group" style="padding-top: 5px;">
                            <label for="busquedaBasica">BÚSQUEDA:</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text"  id="busquedaBasica" name="busquedaBasica" class="form-control">
                        </div>
                    </div>
                </div>
            
            <div class="row">
                <div class="col-md-12">
                   
                    <div class="table-responsive">
                        <table id="tbcomputadorasSF" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Folio Remisión</th>
                                    <th>Propietario</th>
                                    <th>Area</th>
                                    <th>CPU</th>
                                    <th>Monitor</th>
                                    <th>No-BREAK</th>
                                    <th>IP</th>
                                    <th>Perfil</th>
                                    <th>Fec. Registro</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($computadoras as $c): ?>
                                    <tr>
                                        <td><?php echo $c->id_bien;?></td>
                                        <td><?php echo $c->folio_remision;?></td>
                                        <td><?php echo $c->nombres.' '.$c->ap_paterno.' '.$c->ap_materno;?></td>
                                        <td><?php echo $c->nombre_area;?></td>
                                        <td><?php echo $c->no_serie;?></td>
                                        <td><?php echo $c->monitor;?></td>
                                        <td><?php echo $c->no_break;?></td>
                                        <td><?php echo $c->direccion_ip;?></td>
                                        <td><?php echo $c->nombre_perfil;?></td>
                                        <?php $fecha = new DateTime($c->fecregistro_bien); ?>
                                        <td><?php echo $fecha->format("d-m-Y");?></td>
                                        <td>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-primary btn-flat btn-view" data-toggle="modal" data-target="#modal-default" value="<?php echo $c->id_bien;?>" title="Ver">
                                                    <span class="fa fa-eye"></span>
                                                </button>
                                                
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
            <li class="active"><a data-toggle="tab" href="#listado">Listado</a></li>
            <li><a data-toggle="tab" href="#agregar">Agregar</a></li>
            
        </ul>

        <div class="tab-content">
            <div id="listado" class="tab-pane fade in active">
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
            </div>
            <div id="agregar" class="tab-pane fade">
                <h2>Nuevo Mantenimiento</h2>
                <form action="<?php echo base_url();?>equipos/computadoras/addmantenimiento" method="POST">
                    <input type="hidden" name="idequipo" id="idequipo">
                    <div class="form-group">
                        <label for="">Fecha</label>
                        <input type="date" class="form-control" name="fecha" value="<?php echo date("Y-m-d")?>" required="required">
                    </div>
                    <div class="form-group">
                        <label for="">Tecnico</label>
                        <input type="text" class="form-control" name="tecnico" required="required">
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
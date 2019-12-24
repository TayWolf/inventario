<section class="content-header">
    <h1>
        Búsqueda <small> AVANZADA</small>
    </h1>

</section>

<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="box box-solid">
    
        <div class="box-body">
            <input type="hidden" id="modulo" value="cpu">
            
                <form action="<?php echo current_url();?>" method="POST">
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group" style="padding-top: 5px;">
                            <label for="">Parámetros de Búsqueda:</label>
                        </div>
                    </div>
                    <div class="col-md-3 col-md-offset-3">
                        <div class="form-group">
                            <input type="submit" name="busquedaavanzada" class="btn btn-default btn-flat" value="Buscar">
                            <a href="<?php echo base_url();?>reportes/busquedaavanzada" class="btn btn-danger btn-flat">Reestablecer</a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group" style="padding-top: 5px;">
                            <label for="">Folio de Remisión:</label>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <input type="text" name="folio_remision" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group" style="padding-top: 5px;">
                            <label for="">No. de Serie:</label>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <input type="text" name="no_serie" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group" style="padding-top: 5px;">
                            <label for="">Modelo:</label>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <input type="text" name="modelo" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group" style="padding-top: 5px;">
                            <label for="">IP:</label>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <input type="text" name="id_ip" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group" style="padding-top: 5px;">
                            <label for="">Propietario:</label>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <input type="text" name="id_persona" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group" style="padding-top: 5px;">
                            <label for="">Fecha de Registro:</label>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <input type="text" name="fecregistro_bien" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-4 col-md-offset-5">
                        <div class="form-group">
                            <button type="button" class="btn btn-success btn-flat" data-toggle="modal" data-target="#filtrosModal">Agregar Filtro de Búsqueda</button>
                        </div>
                    </div>
                </div>
            </form>
     
            
            <div class="row" id="tbBusquedaAvanzada">
                <div class="col-md-12">
                   
                    <div class="table-responsive">
                        <table id="tbcomputadoras" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Codigo</th>
                                    <th>Elemento</th>
                                    <th>Area</th>
                                    <th>Procesador</th>
                                    <th>Disco Duro</th>
                                    <th>IP</th>
                                    <th>Memoria RAM</th>
                                    <th>S.O</th>
                                    <th>Usuario</th>
                                    <th>Fec. Registro</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($impresoras as $c): ?>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
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
            <div class="row">
                <div class="col-md-4">
                    <form action="<?php echo base_url();?>reportes/computadoras/exportcomputadoras" method="POST">
                        <input type="hidden" id="busquedabasica" name="busquedabasica" value="<?php echo isset($fecinicio) ? $fecinicio:"";?>">
                        <input type="hidden" id="fechafin" name="fechafin" value="<?php echo isset($fecfin) ? $fecfin:"";?>">
                        <input type="hidden" id="searchfecha" name="searchfecha" value="0">
                        <input type="hidden" id="search" name="search">
                        <input type="hidden" name="tipoarchivo" id="tipoarchivo">
                        <!-- <button id="file-excel" type="submit" class="btn btn-success btn-flat">
                            <span class="fa fa-file-excel-o"></span> Exportar a Excel
                        </button> -->
                        <button id="file-pdf" type="submit" class="btn btn-danger btn-flat" style="margin-left: 700px;">
                            <span class="fa fa-file-pdf-o"></span> Exportar a PDF
                        </button>
                    </form>
                </div>
                <div class="col-md-8">
                    <div class="paginacionComp text-right">
                           
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

<!-- Modal -->
<div class="modal fade" id="filtrosModal" tabindex="-1" role="dialog" aria-labelledby="filtrosModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Filtros de Búsqueda</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?php echo current_url();?>" method="POST">
                <div class="row">
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group" style="padding-top: 5px;">
                            <label for="">Elemento</label>
                        </div>
                    </div>
                    <div class="col-md-1 col-sm-12">
                        <div class="form-group" style="padding-top: 5px;">
                            <input type="checkbox" name="estados[]" value="Rapido">
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group" style="padding-top: 5px;">
                            <label for="">Procesador</label>
                        </div>
                    </div>
                    <div class="col-md-1 col-sm-12">
                        <div class="form-group" style="padding-top: 5px;">
                            <input type="checkbox" name="estados[]" value="Negado">
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group" style="padding-top: 5px;">
                            <label for="">Unidad de Almacenamiento</label>
                        </div>
                    </div>
                    <div class="col-md-1 col-sm-12">
                        <div class="form-group" style="padding-top: 5px;">
                            <input type="checkbox" name="estados[]" value="Aceptado">
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group" style="padding-top: 5px;">
                            <label for="">RAM</label>
                        </div>
                    </div>
                    <div class="col-md-1 col-sm-12">
                        <div class="form-group" style="padding-top: 5px;">
                            <input type="checkbox" name="estados[]" value="Rapido">
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group" style="padding-top: 5px;">
                            <label for="">Extensión Telefónica</label>
                        </div>
                    </div>
                    <div class="col-md-1 col-sm-12">
                        <div class="form-group" style="padding-top: 5px;">
                            <input type="checkbox" name="estados[]" value="Rapido">
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group" style="padding-top: 5px;">
                            <label for="">MAC</label>
                        </div>
                    </div>
                    <div class="col-md-1 col-sm-12">
                        <div class="form-group" style="padding-top: 5px;">
                            <input type="checkbox" name="estados[]" value="Rapido">
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group" style="padding-top: 5px;">
                            <label for="">Último Mantenimiento</label>
                        </div>
                    </div>
                    <div class="col-md-1 col-sm-12">
                        <div class="form-group" style="padding-top: 5px;">
                            <input type="checkbox" name="estados[]" value="Rapido">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-4 col-md-offset-5">
                        <div class="form-group">
                            <button type="button" class="btn btn-success btn-flat" data-toggle="modal" data-target="#filtrosModal">Agregar</button>
                        </div>
                    </div>
                </div>
            </form>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
        <!-- <button type="button" class="btn btn-success">Añadir</button> -->
      </div>
    </div>
  </div>
</div>
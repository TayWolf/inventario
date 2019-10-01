<section class="content-header">
    <h1>
        Reportes <small> IPs</small>
    </h1>

</section>

<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="box box-solid">
    
        <div class="box-body">
            <input type="hidden" id="modulo" value="ip">

            <form action="<?php echo current_url();?>" method="POST">
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group" style="padding-top: 5px;">
                            <label for="">Rango de fechas:</label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <input type="date" name="fecinicio" class="form-control" value="<?php echo isset($fecinicio) ? $fecinicio:date("Y-m-d");?>">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <input type="date" name="fecfin" class="form-control" value="<?php echo isset($fecfin) ? $fecfin:date("Y-m-d");?>">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <input type="submit" name="buscar" class="btn btn-success btn-flat" value="Buscar">
                            <a href="<?php echo base_url();?>reportes/ip" class="btn btn-danger btn-flat">Reestablecer</a>
                        </div>
                    </div>
                </div>
                <hr>
            </form>
            
            <div class="row">
                <div class="col-md-12">
                
                    <div class="table-responsive">
                        <table id="tb-without-buttons" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    
                                    <th>Codigo</th>
                                    <th>IP</th>
                                    <th>Estado</th>
                                    
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($ip as $ips): ?>
                                    <tr>
                                        
                                        <td><?php echo $ips->id?></td>
                                        <td><?php echo $ips->descripcion?></td>
                                        
                                        <td><?php echo $ips->estado?></td>
                                        
                                        <td>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-primary btn-flat btn-view" data-toggle="modal" data-target="#modal-default" value="<?php echo $ips->id;?>" title="Ver">
                                                    <span class="fa fa-eye"></span>
                                                </button>
                                                
                                            </div>
                                        </td>

                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                            
                        </table>
                        
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <form action="<?php echo base_url();?>reportes/ip/exportar" method="POST">
                                <input type="hidden" id="fechainicio" name="fechainicio" value="<?php echo isset($fecinicio) ? $fecinicio:"";?>">
                                <input type="hidden" id="fechafin" name="fechafin" value="<?php echo isset($fecfin) ? $fecfin:"";?>">
                                <input type="hidden" id="searchfecha" name="searchfecha" value="0">
                                <input type="hidden" id="search" name="search">
                                <input type="hidden" name="tipoarchivo" id="tipoarchivo">
                                <button id="file-excel" type="submit" class="btn btn-success btn-flat">
                                    <span class="fa fa-file-excel-o"></span> Exportar a Excel
                                </button>
                                <button id="file-pdf" type="submit" class="btn btn-danger btn-flat">
                                    <span class="fa fa-file-pdf-o"></span> Exportar a PDF
                                </button>
                            </form>
                        </div>
                        <div class="col-md-8">
                            <div class="paginacionTab text-center">
                           
                            </div>
                        </div>
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
        <h4 class="modal-title">Informacion de la IP</h4>
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
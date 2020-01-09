<section class="content-header">
    <h1>
        Reportes <small> FONCA</small>
    </h1>

</section>

<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="box box-solid">
    
        <div class="box-body">
            <input type="hidden" id="modulo" value="cpu">
            <form action="<?php echo base_url();?>reportes/busquedaavanzada/formulario" method="POST">
                <div class="row">
                    <div class="col-sm-12 col-md-3">
                        <div class="form-group">
                            <label for="tipoarchivo">Formato:</label>
                            <select name="tipoarchivo" id="tipoarchivo" class="form-control">
                                <option value="">Elija el formato que desea generar</option>
                                <option value="1">Formato de préstamo interno (Equipos de Cómputo)</option>
                                <option value="2">Formato de préstamo externo (Equipos de Cómputo)</option>
                                <option value="3">Resguardo de bienes informáticos (Mainbit)</option>
                                <option value="4">Resguardo de impresoras (Mita)</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-4 butonPDF">
                        <div class="form-group paginacionComp">
                            <button id="generarPDF" type="submit" class="btn btn-primary btn-flat">
                                <span class="fa fa-file-pdf-o"></span> Generar PDF
                            </button>
                            <!-- <a href="<?php echo base_url();?>reportes/busquedaavanzada/formulario" ><span class="fa fa-file-pdf-o"></span> Generar PDF</a> -->
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
                                                <button type="button" class="btn btn-primary btn-flat btn-view" data-toggle="modal" data-target="#modal-default" value="" title="Ver">
                                                    <span class="fa fa-eye"></span>
                                                </button>
                                                
                                            </div>
                                        </td>
                                    </tr>
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
                        <!-- <input type="hidden" name="tipoarchivo" id="tipoarchivo"> -->
                        <!-- <button id="file-excel" type="submit" class="btn btn-success btn-flat">
                            <span class="fa fa-file-excel-o"></span> Exportar a Excel
                        </button> -->
                        <!-- <button id="file-pdf" type="submit" class="btn btn-flat" style="margin-left: 700px;background-color: #6F80AC;color: #FFF;">
                            <span class="fa fa-file-pdf-o"></span> Exportar a PDF
                        </button> -->
                    </form>
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
        <h4 class="modal-title">Informacion del PDF</h4>
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
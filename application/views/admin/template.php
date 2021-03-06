<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Inventario | FONCA</title>
    <link rel="shortcut icon" href="<?php echo base_url();?>assets/images/favicon.png" type="image/png">
    <link class="favicon" rel="icon" href="<?php echo base_url();?>assets/images/favicon.png" type="image/png">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- SweetAlert  -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/sweetalert/sweetalert.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/datatables.net-bs/css/dataTables.bootstrap.min.css">
    <!-- DataTables Export -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/datatables-export/css/buttons.dataTables.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/Ionicons/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/skins/_all-skins.min.css">


    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <style>
        .pagination{
            margin: 0px;
        }
        .imagen-firma{
            width: 300px;
            margin:0px auto 10px auto;

        }
        #tbvehiculos tr td:first-child{
            font-weight: bold;
        }
        #tbvehiculos tr th{
            background: #510B23;
            border-color: #3c8dbc;
            color:#FFF; 
        }
        .errorValidation{
            color:red;
        }
        .tb-alistamiento>tbody>tr>td, .tb-alistamiento>tbody>tr>th, .tb-alistamiento>tfoot>tr>td, .tb-alistamiento>tfoot>tr>th, .tb-alistamiento>thead>tr>td, .tb-alistamiento>thead>tr>th{
            padding: 2px !important;
        }
        .tb-alistamiento tbody tr th{
            background-color: #510B23;
            color: #404141;
            text-align: center;
        }
        .tb-vehiculo>tbody>tr>td, .tb-vehiculo>tbody>tr>th, .tb-vehiculo>tfoot>tr>td, .tb-vehiculo>tfoot>tr>th, .tb-vehiculo>thead>tr>td, .tb-vehiculo>thead>tr>th{
            padding: 2px !important;
        }
        .tb-vehiculo tbody tr th{
            background-color: #510B23;
            color: #404141;
            text-align: center;
        }
        .line{
            border-bottom: 1px solid #fff; 
        }
        .butonPDF
        {
            padding-top: 1.8em;
        }
        @media only screen and (max-width: 992px) 
        {
            .butonPDF
            {
                text-align: center;
                padding-top: 0;
            }
        }
    </style>
    <!-- SweetAlert  -->
    <script src="<?php echo base_url();?>assets/sweetalert/sweetalert.min.js"></script>
</head>
<body class="hold-transition skin-blue sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">
        <?php if ($this->session->userdata("id_rol") <= 3): ?>
        <header class="main-header">
            <!-- Logo -->
            <a href="<?php echo base_url();?>dashboard" class="logo">
                       
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini"><b>IF</b></span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg"><b>Inventario FONCA</b></span>
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>

                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <?php echo $this->session->userdata("usuario");?>
                            </a>
                            <ul class="dropdown-menu">
                              <li><a href="<?php echo base_url();?>auth/logout">Cerrar Session</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <?php endif ?>

        <?php if ($this->session->userdata("id_rol") == 4): ?>
        <header class="main-header">
            <!-- Logo -->
            <a href="<?php echo base_url();?>usuario/perfil" class="logo">
                       
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini"><b>IF</b></span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg"><b>Inventario FONCA</b></span>
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>

                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <?php echo $this->session->userdata("usuario");?>
                            </a>
                            <ul class="dropdown-menu">
                              <li><a href="<?php echo base_url();?>auth/logout">Cerrar Session</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <?php endif ?>
        <!-- =============================================== -->

        <!-- Left side column. contains the sidebar -->
        <aside class="main-sidebar">
            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">
                <!-- sidebar menu: : style can be found in sidebar.less -->
                <ul class="sidebar-menu" data-widget="tree">
                    <li class="header">Menú de Navegación</li>
                    <?php if ($this->session->userdata("id_rol") < 3): ?>
                    <li>
                        <a href="<?php echo base_url();?>dashboard"><i class="fa fa-home"></i> <span>Inicio</span></a>
                    </li>
                        
                    
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-desktop"></i> <span>Inventarios</span>
                            <span class="pull-right-container">
                              <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="<?php echo base_url();?>bienes/cpu"><i class="fa fa-circle-o"></i> CPU´s</a></li>
                            <li><a href="<?php echo base_url();?>bienes/impresoras"><i class="fa fa-circle-o"></i> Impresoras</a></li>
                            <li><a href="<?php echo base_url();?>bienes/telefonos"><i class="fa fa-circle-o"></i> Teléfonos</a></li>
                            <li><a href="<?php echo base_url();?>bienes/servidores"><i class="fa fa-circle-o"></i> Servidores</a></li>
                            <li><a href="<?php echo base_url();?>bienes/laptops"><i class="fa fa-circle-o"></i> Lap Tops</a></li>
                            <li><a href="<?php echo base_url();?>bienes/oficina"><i class="fa fa-circle-o"></i> Mobiliario de Oficina</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-cogs"></i> <span>Catálogos</span>
                            <span class="pull-right-container">
                              <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="<?php echo base_url();?>configuraciones/areas"><i class="fa fa-circle-o"></i> Areas</a></li>
                            <li><a href="<?php echo base_url();?>configuraciones/cargo"><i class="fa fa-circle-o"></i> Cargo</a></li>
                            <li><a href="<?php echo base_url();?>configuraciones/tipobienes"><i class="fa fa-circle-o"></i> Tipo de bien</a></li>
                            <li><a href="<?php echo base_url();?>configuraciones/elementos"><i class="fa fa-circle-o"></i> Elemento</a></li>
                            <li><a href="<?php echo base_url();?>configuraciones/marcas"><i class="fa fa-circle-o"></i> Marcas</a></li>
                            <li><a href="<?php echo base_url();?>configuraciones/ip"><i class="fa fa-circle-o"></i> IP's</a></li>
                            <div class="line"></div>
                            <li><a href="<?php echo base_url();?>configuraciones/personas"><i class="fa fa-circle-o"></i> Personas</a></li>
                            <li><a href="<?php echo base_url();?>configuraciones/tipoclaves"><i class="fa fa-circle-o"></i> Tipo de Claves</a></li>
                            <li><a href="<?php echo base_url();?>configuraciones/recursored"><i class="fa fa-circle-o"></i> Recurso de Red</a></li>
                            <!-- <li><a href="<?php echo base_url();?>configuraciones/modelo"><i class="fa fa-circle-o"></i> Modelo</a></li> -->
                            <!-- <li><a href="<?php echo base_url();?>configuraciones/memorias"><i class="fa fa-circle-o"></i> Memorias RAM</a></li> -->
                            <!-- <li><a href="<?php echo base_url();?>configuraciones/discos"><i class="fa fa-circle-o"></i> Discos Duros</a></li> -->
                            <!-- <li><a href="<?php echo base_url();?>configuraciones/antivirus"><i class="fa fa-circle-o"></i> Antivirus</a></li> -->
                            <!-- <li><a href="<?php echo base_url();?>configuraciones/sistemas"><i class="fa fa-circle-o"></i> Sistemas Opertivos</a></li> -->
                            <!-- <li><a href="<?php echo base_url();?>configuraciones/office"><i class="fa fa-circle-o"></i> Office</a></li> -->
                            <!-- <li><a href="<?php echo base_url();?>configuraciones/proveedores"><i class="fa fa-circle-o"></i> Proveedores</a></li> -->
                        </ul>
                    </li>
                    <?php endif ?>
                    <?php if ($this->session->userdata("id_rol") == 1 || $this->session->userdata("id_rol") == 3): ?>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-list"></i> <span>Reportes</span>
                            <span class="pull-right-container">
                              <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="<?php echo base_url();?>reportes/busquedabasica"><i class="fa fa-circle-o"></i> Búsqueda</a></li>
                            <li><a href="<?php echo base_url();?>reportes/busquedaavanzada"><i class="fa fa-circle-o"></i> FONCA</a></li>
                            <!-- <li><a href="<?php echo base_url();?>reportes/computadoras"><i class="fa fa-circle-o"></i> CPU</a></li> -->
                            <!-- <li><a href="<?php echo base_url();?>reportes/impresoras"><i class="fa fa-circle-o"></i> Impresoras</a></li> -->
                            <!-- <li><a href="<?php echo base_url();?>reportes/monitores"><i class="fa fa-circle-o"></i> Monitores</a></li> -->
                            <!-- <li><a href="<?php echo base_url();?>reportes/ip"><i class="fa fa-circle-o"></i> Ips</a></li> -->
                            <!-- <li><a href="<?php echo base_url();?>reportes/telefonos"><i class="fa fa-circle-o"></i> Teléfonos</a></li> -->
                            <!-- <li><a href="<?php echo base_url();?>reportes/nobreak"><i class="fa fa-circle-o"></i> No-BREAK</a></li> -->
                        </ul>
                    </li>
                    <?php endif ?>
                    <?php if ($this->session->userdata("id_rol") == 1): ?>
                        <li class="treeview">
                        <a href="#">
                            <i class="fa fa-user"></i> <span>Administrador</span>
                            <span class="pull-right-container">
                              <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="<?php echo base_url();?>administrador/usuarios"><i class="fa fa-circle-o"></i> Usuarios</a></li>
                            <li><a href="<?php echo base_url();?>administrador/usuarios/logs"><i class="fa fa-circle-o"></i> Logs</a></li>
                            <li><a href="<?php echo base_url();?>administrador/usuarios/download_backup"><i class="fa fa-circle-o"></i> Descargar Backup</a></li>
                            <li><a href="<?php echo base_url();?>administrador/usuarios/upload_data"><i class="fa fa-circle-o"></i> Importar Data</a></li>
                        </ul>
                    </li>
                    <?php endif ?>
                    
                    <?php if ($this->session->userdata("id_rol") <= 4): ?>
                    <li>
                        <a href="<?php echo base_url();?>usuario/perfil"><i class="fa fa-info-circle"></i> <span>Mi perfil</span></a>
                    </li>
                    <?php endif ?>
                </ul>
            </section>
            <!-- /.sidebar -->
        </aside>

        <!-- =============================================== -->

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <?php echo $contenido;?>
        </div>
        <!-- /.content-wrapper -->
    </div>
    <!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="<?php echo base_url(); ?>assets/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url(); ?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<!-- DataTables -->
<script src="<?php echo base_url(); ?>assets/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- DataTables Export -->
<script src="<?php echo base_url(); ?>assets/datatables-export/js/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url(); ?>assets/datatables-export/js/jszip.min.js"></script>
<script src="<?php echo base_url(); ?>assets/datatables-export/js/pdfmake.min.js"></script>
<script src="<?php echo base_url(); ?>assets/datatables-export/js/vfs_fonts.js"></script>
<script src="<?php echo base_url(); ?>assets/datatables-export/js/buttons.html5.min.js"></script>
<script src="<?php echo base_url(); ?>assets/datatables-export/js/buttons.print.min.js"></script>
<!-- SlimScroll -->
<script src="<?php echo base_url(); ?>assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?php echo base_url(); ?>assets/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url(); ?>assets/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url(); ?>assets/dist/js/demo.js"></script>
<script src="<?php echo base_url();?>assets/jquery-print/jquery.print.js"></script>
<script>

  $(document).ready(function () {
    $('.sidebar-menu').tree()
  })
</script>
<script>
    var base_url = "<?php echo base_url();?>";
</script>
<script src="<?php echo base_url(); ?>assets/backend/script.js"></script>
<script src="<?php echo base_url(); ?>assets/backend/computadoras.js"></script>
</body>
</html>

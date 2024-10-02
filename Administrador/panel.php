<!DOCTYPE html>
<html>
<?php
session_start();
if (isset($_REQUEST['sesion']) && $_REQUEST['sesion'] == "cerrar") {
  session_destroy();
  header("location: index.php");
}
if (isset($_SESSION['id']) == false) {
  header("location: index.php");
}
$modulo = $_REQUEST['modulo'] ?? ''
?>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Panel de control</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/x-icon" href="../fotos/LogoNeoCenter.ico">
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <link rel="stylesheet" href="../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <link rel="stylesheet" href="../plugins/jqvmap/jqvmap.min.css">
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <link rel="stylesheet" href="../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker.css">
  <link rel="stylesheet" href="../plugins/summernote/summernote-bs4.css">
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <ul class="navbar-nav ml-auto">
        <a class="nav-link" href="panel.php?modulo=editarUsuario&id=<?php echo $_SESSION['id'] ?>">
          <i class="far fa-user"></i>
        </a>
        <a class="nav-link" href="panel.php?modulo=&sesion=cerrar" title="Cerrar sesión">
          <i class="fas fa-door-closed"></i>
        </a>
        </li>
      </ul>
    </nav>


    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <div class="container">
        <a href="" class="brand-link">
          <span class="brand-text font-weight-light text-center">NeoCenter</span>
        </a>
      </div>

      <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="info">
            <a href="panel.php?modulo=editarUsuario&id=<?php echo $_SESSION['id'] ?>" class="d-block"><?php echo $_SESSION['nombre']; ?></a>
          </div>
        </div>

        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item has-treeview menu-open">
              <a href="#" class="nav-link active">
                <i class="fa fa-shopping-cart nav-icon" aria-hidden="true"></i>
                <p>
                  E-commerce

                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="panel.php?modulo=usuarios" class="nav-link <?php echo ($modulo == "usuarios" || $modulo == "crearUsuario" || $modulo == "editarUsuario" || $modulo == "") ? " active " : " "; ?>">
                    <i class="far fa-user nav-icon"></i>
                    <p>Usuarios</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="panel.php?modulo=clientes" class="nav-link <?php echo ($modulo == "clientes" || $modulo == "editarCliente") ? " active " : " "; ?>">
                    <i class="far fa-user nav-icon"></i>
                    <p>Clientes</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="panel.php?modulo=productos" class="nav-link <?php echo ($modulo == "productos" || $modulo == "crearProducto" || $modulo == "editarProducto") ? "active" : " "; ?>">
                    <i class="fa fa-shopping-bag nav-icon" aria-hidden="true"></i>
                    <p>Productos</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="panel.php?modulo=ventas" class="nav-link <?php echo ($modulo == "ventas") ? "active" : " "; ?>">
                    <i class="fa fa-table nav-icon" aria-hidden="true"></i>
                    <p>Ventas</p>
                  </a>
                </li>
              </ul>
        </nav>
      </div>
    </aside>
    <?php
    if (isset($_REQUEST['mensaje'])) {
    ?>
      <div class="alert alert-primary alert-dismissible fade show float-right" role="alert">
        <?php echo $_REQUEST['mensaje'] ?>
      </div>
    <?php
    }

    if ($modulo == "usuarios" || $modulo == "") {
      include_once "usuarios.php";
    }
    if ($modulo == "productos") {
      include_once "productos.php";
    }
    if ($modulo == "ventas") {
      include_once "ventas.php";
    }
    if ($modulo == "crearUsuario") {
      include_once "crearUsuario.php";
    }
    if ($modulo == "editarUsuario") {
      include_once "editarUsuario.php";
    }
    if ($modulo == "crearProducto") {
      include_once "crearProducto.php";
    }
    if ($modulo == "editarProducto") {
      include_once "editarProducto.php";
    }
    if ($modulo == "ventas") {
      include_once "ventas.php";
    }
    if ($modulo == "clientes") {
      include_once "clientes.php";
    }
    if ($modulo == "editarCliente") {
      include_once "editarCliente.php";
    }
    ?>
  </div>

  <script src="plugins/jquery/jquery.min.js"></script>
  <script src="plugins/jquery-ui/jquery-ui.min.js"></script>
  <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../plugins/chart.js/Chart.min.js"></script>
  <script src="../plugins/sparklines/sparkline.js"></script>
  <script src="../plugins/jqvmap/jquery.vmap.min.js"></script>
  <script src="../plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
  <script src="../plugins/jquery-knob/jquery.knob.min.js"></script>
  <script src="../plugins/moment/moment.min.js"></script>
  <script src="../plugins/daterangepicker/daterangepicker.js"></script>
  <script src="../plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
  <script src="../plugins/summernote/summernote-bs4.min.js"></script>
  <script src="../plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
  <script src="../dist/js/adminlte.js"></script>
  <script src="../dist/js/pages/dashboard.js"></script>
  <script src="../dist/js/demo.js"></script>
  <script src="../plugins/datatables/jquery.dataTables.js"></script>
  <script src="../plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
</body>

</html>
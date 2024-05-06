<!DOCTYPE html>
<html>
<?php
session_start();
if (isset($_REQUEST['sesion']) && $_REQUEST['sesion'] == "cerrar") {
    include_once "../Administrador/conexion.php";
    $conexion = mysqli_connect($host, $user, $pass, $db);
    $queryCompra = "DELETE FROM detalleventas;";
    $resultadoCompra = mysqli_query($conexion, $queryCompra);
    $queryVenta = "DELETE FROM ventas;";
    $resultadoVenta = mysqli_query($conexion, $queryVenta);
    $resultadoCompra = mysqli_query($conexion, $queryCompra);
    session_destroy();
    header("location: indexCliente.php");
}
if (isset($_SESSION['id']) == false) {
    header("location: indexCliente.php");
}
$modulo = $_REQUEST['modulo'] ?? ''
?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>NeoCenter | Tienda</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
    <link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker.css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">
</head>

<body>
    <?php
    include_once "../Administrador/conexion.php";
    $conexion = mysqli_connect($host, $user, $pass, $db);
    ?>
    <div>
        <div class="row">
            <div class="col-12 col">
                <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                    <ul class="navbar-nav">
                        <li class="nav-item d-none d-sm-inline-block">
                            <a href="front.php" class="nav-link">Inicio</a>
                        </li>
                        <li class="nav-item d-none d-sm-inline-block">
                            <a class="nav-link">|</a>
                        </li>
                        <li class="nav-item d-none d-sm-inline-block">
                            <a class="nav-link">Categoría :</a>
                        </li>
                    </ul>

                    <form class="form-inline ml-3" action="front.php">
                        <div class="input-group input-group-sm">
                            <select class="form-control form-control-navbar bg-gray" name="categoria">
                                <option value=""><?php echo $_REQUEST['categoria'] ?? ''; ?>
                                </option>
                                <option value="Celular">Celular</option>
                                <option value="Laptop">Laptop</option>
                                <option value="Tablet">Tablet</option>
                            </select>
                            <div class="input-group-append">
                                <button class="btn btn-navbar" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                    <form class="form-inline ml-3" action="front.php">
                        <div class="input-group input-group-sm">
                            <input class="form-control form-control-navbar bg-gray" type="search" placeholder="Buscar" aria-label="Search" name="nombre" value="<?php echo $_REQUEST['nombre'] ?? ''; ?>">
                            <input type="hidden" name="modulo" value="productos">
                            <div class="input-group-append">
                                <button class="btn btn-navbar" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="front.php?modulo=detalleVenta">
                                <i class="fa fa-cart-plus" aria-hidden="true"></i>
                                <span class="badge badge-danger navbar-badge"></span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="front.php?modulo=detalleCliente&id=<?php echo $_SESSION['id'] ?>">
                                <i class="fa fa-user" aria-hidden="true"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="front.php?modulo=&sesion=cerrar" title="Cerrar sesión">
                                <i class="fas fa-door-closed"></i>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
    </div>
    <?php
    if ($modulo == "productos" || $modulo == "") {
        include_once "productoscliente.php";
    }
    if ($modulo == "detalleProducto") {
        include_once "detalleProducto.php";
    }
    if ($modulo == "detalleVenta") {
        include_once "detalleVenta.php";
    }
    if ($modulo == "detalleCliente") {
        include_once "detalleCliente.php";
    }
    ?>

    <script src="../plugins/jquery/jquery.min.js"></script>
    <script src="plugins/jquery-ui/jquery-ui.min.js"></script>
    <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../plugins/moment/moment.min.js"></script>
    <script src="../plugins/daterangepicker/daterangepicker.js"></script>
    <script src="../dist/js/adminlte.js"></script>
    <script src="dist/js/pages/dashboard.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
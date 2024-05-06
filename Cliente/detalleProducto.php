<?php
include_once "../Administrador/conexion.php";
$conexion = mysqli_connect($host, $user, $pass, $db);

if (isset($_REQUEST['añadir'])) {
    $idCliente = mysqli_real_escape_string($conexion, $_REQUEST['idCliente'] ?? '');
    $fecha = mysqli_real_escape_string($conexion, $_REQUEST['fecha'] ?? '');

    $queryV = "INSERT INTO ventas 
    (idCliente,fecha) VALUES
    ('" . $idCliente . "','" . $fecha . "')
    ";
    $resultado = mysqli_query($conexion, $queryV);
    if ($resultado) {
?>
        <div class="alert alert-success" role="alert">
            <strong>Añadido al carrito con éxito</strong>
            <a href="front.php" class="btn btn-primary ml-4 text-decoration-none">
                Volver
                <i class="fa fa-home ml-2" aria-hidden="true"></i>
            </a>
            <a href="front.php?modulo=detalleVenta" class="btn btn-primary ml-4 text-decoration-none">
                Ver carrito
                <i class="fa fa-shopping-cart ml-2" aria-hidden="true"></i>
            </a>
        </div>
    <?php
    } else {
    ?>
        <div class="alert alert-danger" role="alert">
            <strong>Error al añadir al carrito <?php echo mysqli_error($conexion); ?></strong>
        </div>
<?php
    }
    $queryD = "SELECT id from ventas where idCliente='" . $idCliente . "' AND fecha = '" . $fecha . "';";
    $resultadoD = mysqli_query($conexion, $queryD);
    $rowDetalle = mysqli_fetch_assoc($resultadoD);

    $idProducto = mysqli_real_escape_string($conexion, $_REQUEST['id'] ?? '');
    $idVenta = $rowDetalle["id"];
    $cantidad = mysqli_real_escape_string($conexion, $_REQUEST['cantidad'] ?? '');
    $precio = mysqli_real_escape_string($conexion, $_REQUEST['precio'] ?? '');
    $subtotal =  $precio * $cantidad;
    $queryP = "INSERT INTO detalleventas 
    (idProducto,idVenta,cantidad,precio,subtotal) VALUES
    ('" . $idProducto . "','" . $idVenta . "','" . $cantidad . "','" . $precio . "','" . $subtotal . "')
    ";
    $resultadoP = mysqli_query($conexion, $queryP);
}
$id = mysqli_real_escape_string($conexion, $_REQUEST['id'] ?? '');
$query = "SELECT id,nombre,precio,existencia,descripcion,categoria,imagen from productos where id='" . $id . "';";
$resultadoP = mysqli_query($conexion, $query);
$rowProducto = mysqli_fetch_assoc($resultadoP);

?>

<div class="">
    <div class="card-body">
        <div class="row">
            <div class="col-12 col-sm-6">
                <div class="col-9 ml-5">
                    <img src="../fotos/<?php echo $rowProducto['imagen'] ?>" class="card-img-top img-thumbnail ml-5">
                </div>
            </div>
            <div class="col-12 col-sm-6">
                <h3 class="my-3"><?php echo $rowProducto["nombre"] ?></h3>
                <p><?php echo $rowProducto["descripcion"] ?></p>
                <h4>Stock: <?php echo $rowProducto['existencia'] ?></h4>
                <div class="bg-gray py-2 px-3 mt-4">
                    <h2 class="mb-0">
                        $<?php echo $rowProducto['precio'] ?>
                    </h2>
                </div>
                <form action="front.php?modulo=detalleProducto&id=<?php echo $rowProducto['id'] ?>" method="post">
                    <div class="mt-4">
                        Cantidad:
                        <input type="number" class="form-control" id="cantidadProducto" value="1" name="cantidad">
                    </div>
                    <div class="mt-4">
                        <input type="hidden" class="form-control" name="precio" value="<?php echo $rowProducto['precio'] ?>">
                    </div>
                    <div class="mt-4">
                        <input type="hidden" class="form-control" name="idCliente" value="<?php echo $_SESSION['id'] ?>">
                    </div>
                    <?php
                    date_default_timezone_set('America/Guayaquil');
                    ?>
                    <div class="mt-4">
                        <input type="hidden" class="form-control" name="fecha" value="<?php echo date('Y-m-d H:i:s') ?>">
                    </div>
                    <div class="mt-4">
                        <button type="submit" class="btn btn-success" name="añadir">Añadir al carrito <i class="fa fa-cart-plus" aria-hidden="true"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
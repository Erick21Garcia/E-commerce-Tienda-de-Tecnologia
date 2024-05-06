<div class="container mt-5">

  <?php
  if (isset($_REQUEST['idBorrar'])) {
    $idD = mysqli_real_escape_string($conexion, $_REQUEST['idBorrar'] ?? '');
    $queryD = "DELETE from detalleventas where idProducto='" . $idD . "';";
    $resultadoD = mysqli_query($conexion, $queryD);
  }

  if (isset($_REQUEST['comprar'])) {
    $queryPrimero = "SELECT idProducto,idVenta,cantidad,precio,subtotal from detalleventas; ";
    $resultadoPrimero = mysqli_query($conexion, $queryPrimero);
    while ($rowPrimero = mysqli_fetch_assoc($resultadoPrimero)) {
      $querySegundo = "SELECT id,nombre,categoria,precio,existencia from productos where id='" . $rowPrimero['idProducto'] . "'; ";
      $resultadoSegundo = mysqli_query($conexion, $querySegundo);
      $rowSegundo = mysqli_fetch_assoc($resultadoSegundo);
      $canti = $rowPrimero['cantidad'];
      $exi = $rowSegundo['existencia'];
      $Nresta = intval($exi) - intval($canti);
      $queryR = "UPDATE productos SET 
      existencia='" . $Nresta . "' where id='" . $rowPrimero['idProducto'] . "';
      ";
      $resultadoR = mysqli_query($conexion, $queryR);
    }

    $queryCompra = "DELETE FROM detalleventas;";
    $resultadoCompra = mysqli_query($conexion, $queryCompra);
    $queryVenta = "DELETE FROM ventas;";
    $resultadoVenta = mysqli_query($conexion, $queryVenta);
    $resultadoCompra = mysqli_query($conexion, $queryCompra);
    if ($resultadoCompra) {
  ?>
      <div class="alert alert-success" role="alert">
        <strong>Se ha realizado la compra con exito</strong>
        <a href="front.php" class="btn btn-primary ml-4 text-decoration-none ">Volver a la tienda<i class="fa fa-home ml-2" aria-hidden="true"></i></a>
      </div>
    <?php
    } else {
    ?>
      <div class="alert alert-danger" role="alert">
        <strong>Hubo un error en la compra <?php echo mysqli_error($conexion); ?></strong>
      </div>
  <?php
    }
    $nombreCliente = $_SESSION['nombre'];
    $fechaCompra = date("Y-m-d H:i:s");
    $ingresoTotal = mysqli_real_escape_string($conexion, $_REQUEST['sumaTotal'] ?? '');
    $queryRegistro = "INSERT INTO registroventas 
    (ClienteNombre,FechaCompra,IngresoTotal) VALUES
    ('" . $nombreCliente . "','" . $fechaCompra . "','" . $ingresoTotal . "');";
    $resultadoRegistro = mysqli_query($conexion, $queryRegistro);
  }
  $query = "SELECT idProducto,idVenta,cantidad,precio,subtotal from detalleventas; ";
  $resultado = mysqli_query($conexion, $query);
  ?>

  <h2>Carrito de compra</h2><br>
  <div class="row">
    <div class="col-md-5">
      <div class="card">
        <div class="card-header">
          <strong>Detalles de Venta</strong>
        </div>
        <div class="card-body">
          <h5 class="card-title">Cliente: <?php echo $_SESSION['nombre'] ?></h5>
          <?php
          date_default_timezone_set('America/Guayaquil');
          ?>
          <p class="card-text">Fecha: <?php echo date("Y-m-d") ?></p>
          <?php
          $campoValores = array();
          while ($row = mysqli_fetch_assoc($resultado)) {
            if (isset($row['subtotal']) && $row['subtotal'] !== null) {
              $campoArray[] = $row['subtotal'];
            } else {
              $campoArray[] = 0;
            }
          }
          if ($campoArray[] = 0) {
            $sumaTotal = 0;
          } else {
            $sumaTotal = array_sum($campoArray);
          }
          ?>
          <p class="card-text">Total a pagar: $<?php echo $sumaTotal ?></p>
          <form action="front.php?modulo=detalleVenta" method="post">
            <input type="hidden" name="sumaTotal" value="<?php echo $sumaTotal ?>">
            <button type="submit" class="btn btn-success mr-5" name="comprar">Comprar <i class="fas fa-money-bill"></i></button>
          </form>
        </div>
      </div>
    </div>
    <div class="col-md-7">
      <div class="card">
        <div class="card-header">
          <strong>Productos</strong>
        </div>
        <div class="card-body" style="max-height: 318px; overflow-y: auto;">
          <div class="row">
            <?php
            $query = "SELECT idProducto,idVenta,cantidad,precio,subtotal from detalleventas; ";
            $resultado = mysqli_query($conexion, $query);
            while ($row = mysqli_fetch_assoc($resultado)) {
              $queryP = "SELECT id,nombre,categoria,precio,existencia from productos where id='" . $row['idProducto'] . "'; ";
              $resultadoP = mysqli_query($conexion, $queryP);
              $rowP = mysqli_fetch_assoc($resultadoP)
            ?>
              <div class="card p-4 col-md-6">
                <h5 class="card-title"><strong><?php echo $rowP['nombre'] ?></strong></h5>
                <p class="card-text">Categoría: <?php echo $rowP['categoria'] ?></p>
                <p class="card-text">Precio: <?php echo $rowP['precio'] ?></p>
                <p class="card-text">Cantidad: <?php echo $row['cantidad'] ?></p>
                <p class="card-text">Subtotal: <?php echo $row['subtotal'] ?></p>
                <form action="front.php?modulo=detalleVenta&idBorrar=<?php echo $row['idProducto'] ?>" method="post">
                  <div class="ml-4">
                    <button type="submit" class="btn btn-danger ml-5 mr-5">
                      Eliminar
                      <i class="fa fa-times ml-1" aria-hidden="true"></i>
                    </button>
                </form>
              </div>
          </div>
        <?php
            }
        ?>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

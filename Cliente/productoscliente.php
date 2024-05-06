<div class="row">
    <?php
    $where = " where 1=1";

    $categoria = mysqli_real_escape_string($conexion, $_REQUEST['categoria'] ?? '');
    if (!empty($categoria)) {
        $where .= " and categoria like '%" . $categoria . "%'";
    }

    $nombre = mysqli_real_escape_string($conexion, $_REQUEST['nombre'] ?? '');
    if (!empty($nombre)) {
        $where .= " and nombre like '%" . $nombre . "%'";
    }

    $queryCuenta = "SELECT COUNT(*) as cuenta FROM productos $where ;";
    $resCuenta = mysqli_query($conexion, $queryCuenta);
    $rowCuenta = mysqli_fetch_assoc($resCuenta);
    $totalRegistros = $rowCuenta['cuenta'];

    $elementosPorPagina = 5;
    $totalPaginas = ceil($totalRegistros / $elementosPorPagina);
    $paginaSel = $_REQUEST['pagina'] ?? false;

    if ($paginaSel == false) {
        $inicioLimite = 0;
        $paginaSel = 1;
    } else {
        $inicioLimite = ($paginaSel - 1) * $elementosPorPagina;
    }
    $limite = "limit $inicioLimite,$elementosPorPagina";

    $query = "SELECT
        p.id,
        p.nombre,
        p.precio,
        p.existencia,
        p.descripcion,
        p.categoria,
        p.imagen
        FROM
        productos AS p
        $where
        GROUP BY p.id
        $limite
        ";
    $resultado = mysqli_query($conexion, $query);
    while ($row = mysqli_fetch_assoc($resultado)) {
    ?>
        <div class="col-lag-4 ml-5">
            <div class="card border-gray mt-5">
                <img class="card-img-top img-thumbnail" src="../fotos/<?php echo $row['imagen'] ?>" alt="">
                <div class="card-body">
                    <h4 class="card-title"><strong><?php echo $row['nombre'] ?></strong></h4>
                    <p class="card-text"><strong>Precio:</strong> $<?php echo $row['precio'] ?></p>
                    <p class="card-text"><strong>Stock: </strong><?php echo $row['existencia'] ?></p>
                </div>
                <div class="text-center mb-4 mt-1">
                    <a href="front.php?modulo=detalleProducto&id=<?php echo $row['id'] ?>" class="btn btn-primary">Ver</a>
                </div>
            </div>
        </div>
    <?php
    }
    ?>
</div>
<?php
if ($totalPaginas > 0) {
?>
    <nav aria-label="Page navigation">
        <ul class="pagination ml-5">
            <?php
            if ($paginaSel != 1) {
            ?>
                <li class="page-item">
                    <a class="page-link" href="front.php?modulo=productos&pagina=<?php echo ($paginaSel - 1); ?>" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                        <span class="sr-only">Previous</span>
                    </a>
                </li>
            <?php
            }
            ?>

            <?php
            for ($i = 1; $i <= $totalPaginas; $i++) {
            ?>
                <li class="page-item <?php echo ($paginaSel == $i) ? "active" : " "; ?>">
                    <a class="page-link" href="front.php?modulo=productos&pagina=<?php echo $i; ?>"><?php echo $i; ?></a>
                </li>

            <?php
            }
            ?>
            <?php
            if ($paginaSel != $totalPaginas) {
            ?>

                <li class="page-item">
                    <a class="page-link" href="front.php?modulo=productos&pagina=<?php echo ($paginaSel + 1); ?>" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                        <span class="sr-only">Next</span>
                    </a>
                </li>
            <?php
            }
            ?>
        </ul>
    </nav>
<?php
}
?>
    <?php
    if (isset($_REQUEST['guardar'])) {
        include_once "../Administrador/conexion.php";
        $conexion = mysqli_connect($host, $user, $pass, $db);
        $email = mysqli_real_escape_string($conexion, $_REQUEST['email'] ?? '');
        $contraseña = md5(mysqli_real_escape_string($conexion, $_REQUEST['contraseña'] ?? ''));
        $nombre = mysqli_real_escape_string($conexion, $_REQUEST['nombreC'] ?? '');
        $id = mysqli_real_escape_string($conexion, $_REQUEST['id'] ?? '');

        $query = "UPDATE cliente SET 
        email='" . $email . "',contraseña='" . $contraseña . "',nombreC='" . $nombre . "' where id='" . $id . "';
        ";
        $resultado = mysqli_query($conexion, $query);
        if ($resultado) {
    ?>
            <div class="alert alert-success" role="alert">
                <strong>Cliente editado correctamente <?php echo mysqli_error($conexion); ?></strong>
            </div>
        <?php
        } else {
        ?>
            <div class="alert alert-danger" role="alert">
                <strong>Error al editar usuario <?php echo mysqli_error($conexion); ?></strong>
            </div>
    <?php
        }
    }
    $id = mysqli_real_escape_string($conexion, $_REQUEST['id'] ?? '');
    $query = "SELECT id,email,contraseña,nombreC from cliente where id='" . $id . "';";
    $resultado = mysqli_query($conexion, $query);
    $row = mysqli_fetch_assoc($resultado);
    ?>
    <div class="d-flex justify-content-center mt-5">
        <div class="card col-5">
            <div class="card-header">
                <h3 class="card-title">Detalle Cliente</h3>
            </div>
            <div class="card-body">
                <form action="front.php?modulo=detalleCliente&id=<?php echo $_SESSION['id'] ?>" method="post">
                    <div class="form-group">
                        <label for="email">Correo</label>
                        <input type="email" name="email" id="email" class="form-control" value="<?php echo $row['email'] ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" name="nombreC" id="nombre" class="form-control" value="<?php echo $row['nombreC'] ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="contraseña">Contraseña</label>
                        <input type="password" name="contraseña" id="contraseña" class="form-control" required="required">
                    </div>
                    <div class="text-center">
                        <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
                        <button type="submit" class="btn btn-success" name="guardar">Guardar</button>
                    </div>
                </form>
                <form action="front.php">
                    <button type="submit" class="btn btn-primary" name="regresar">Regresar</button>
                </form>
            </div>
        </div>
    </div>
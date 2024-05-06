<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>NeoCenter | Log in</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

    <?php
    if (isset($_REQUEST['guardar'])) {
        include_once "../Administrador/conexion.php";
        $conexion = mysqli_connect($host, $user, $pass, $db);

        $email = mysqli_real_escape_string($conexion, $_REQUEST['email'] ?? '');
        $contraseña = md5(mysqli_real_escape_string($conexion, $_REQUEST['contraseña'] ?? ''));
        $nombre = mysqli_real_escape_string($conexion, $_REQUEST['nombre'] ?? '');

        $query = "INSERT INTO cliente 
    (email,contraseña,nombreC) VALUES
    ('" . $email . "','" . $contraseña . "','" . $nombre . "')
    ";
        $resultado = mysqli_query($conexion, $query);
        if ($resultado) {
            echo '<div class="d-flex justify-content-center mt-5">
                    <div class="card col-5 bg-success">
                        <div class="card-header">
                            <strong>Usuario creado con éxito</strong>
                        </div>
                    </div>
                </div>';
        } else {
    ?>
            <div class="alert alert-danger" role="alert">
                <strong>Error al crear usuario <?php echo mysqli_error($conexion); ?></strong>
            </div>
    <?php
        }
    }
    ?>

    <!-- Main content -->
    <div class="d-flex justify-content-center mt-5">
        <div class="card col-5">
            <div class="card-header">
                <h3 class="card-title">Registrar Cliente</h3>
            </div>
            <div class="card-body">
                <form action="registroCliente.php
                    " method="post">
                    <div class="form-group">
                        <label for="email">Correo</label>
                        <input type="email" name="email" id="email" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="contraseña">Contraseña</label>
                        <input type="password" name="contraseña" id="contraseña" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" name="nombre" id="nombre" class="form-control" required>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-success" name="guardar">Guardar</button>
                    </div>
                </form>
                <form action="indexCliente.php">
                    <button type="submit" class="btn btn-primary" name="regresar">Regresar</button>
                </form>
            </div>
        </div>
    </div>


    <!-- jQuery -->
    <script src="../plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../dist/js/adminlte.min.js"></script>
<?php
if (isset($_REQUEST['guardar'])) {
    include_once "conexion.php";
    $conexion = mysqli_connect($host, $user, $pass, $db);

    $email = mysqli_real_escape_string($conexion, $_REQUEST['email'] ?? '');
    $contraseña = md5(mysqli_real_escape_string($conexion, $_REQUEST['contraseña'] ?? ''));
    $nombre = mysqli_real_escape_string($conexion, $_REQUEST['nombre'] ?? '');

    $query = "INSERT INTO usuarios 
    (email,contraseña,nombreU) VALUES
    ('" . $email . "','" . $contraseña . "','" . $nombre . "')
    ";
    $resultado = mysqli_query($conexion, $query);
    if ($resultado) {
        echo '<meta http-equiv="refresh" content="0; url=panel.php?modulo=usuarios&mensaje=Usuario creado exitosamente "/>';
    } else {
?>
        <div class="alert alert-danger" role="alert">
            <strong>Error al crear usuario <?php echo mysqli_error($conexion); ?></strong>
        </div>
<?php
    }
}
?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Crear Usuario</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="panel.php?modulo=crearUsuario" method="post">
                            <div class="form-group">
                                <label for="">Correo</label>
                                <input type="email" name="email" class="form-control" required="required">
                            </div>
                            <div class="form-group">
                                <label for="">Contraseña</label>
                                <input type="password" name="contraseña" class="form-control" required="required">
                            </div>
                            <div class="form-group">
                                <label for="">Nombre</label>
                                <input type="text" name="nombre" class="form-control" required="required">
                            </div>
                            <div>
                                <button type="submit" class="btn btn-primary" name="guardar">Guardar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
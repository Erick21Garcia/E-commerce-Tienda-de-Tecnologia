<?php
include_once "conexion.php";
$conexion = mysqli_connect($host, $user, $pass, $db);

if (isset($_REQUEST['guardar'])) {

    $email = mysqli_real_escape_string($conexion, $_REQUEST['email'] ?? '');
    $contraseña = md5(mysqli_real_escape_string($conexion, $_REQUEST['contraseña'] ?? ''));
    $nombre = mysqli_real_escape_string($conexion, $_REQUEST['nombre'] ?? '');
    $id = mysqli_real_escape_string($conexion, $_REQUEST['id'] ?? '');

    $query = "UPDATE cliente SET 
    email='" . $email . "',contraseña='" . $contraseña . "',nombreC='" . $nombre . "' where id='" . $id . "';
    ";
    $resultado = mysqli_query($conexion, $query);
    if ($resultado) {
        echo '<meta http-equiv="refresh" content="0; url=panel.php?modulo=clientes&mensaje=Cliente '.$nombre.' editado exitosamente "/>';
    } else {
?>
        <div class="alert alert-danger" role="alert">
            <strong>Error al editar usuario <?php echo mysqli_error($conexion); ?></strong>
        </div>
<?php
    }
}
$id=mysqli_real_escape_string($conexion,$_REQUEST['id']??'');
$query="SELECT id,email,contraseña,nombreC from cliente where id='".$id."';";
$resultado=mysqli_query($conexion,$query);
$row=mysqli_fetch_assoc($resultado);
?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Editar Cliente</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="panel.php?modulo=editarCliente" method="post">
                            <div class="form-group">
                                <label for="">Correo</label>
                                <input type="email" name="email" class="form-control" value="<?php echo $row['email'] ?>" required="required">
                            </div>
                            <div class="form-group">
                                <label for="">Contraseña</label>
                                <input type="password" name="contraseña" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Nombre</label>
                                <input type="text" name="nombre" class="form-control" value="<?php echo $row['nombreC'] ?>" required="required">
                            </div>
                            <div>
                                <input type="hidden" name="id" value="<?php echo $row['id']?>">
                                <button type="submit" class="btn btn-primary" name="guardar">Guardar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
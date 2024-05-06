<?php
include_once "conexion.php";
$conexion = mysqli_connect($host, $user, $pass, $db);

if (isset($_REQUEST['guardar'])) {

    $nombre = mysqli_real_escape_string($conexion, $_REQUEST['nombre'] ?? '');
    $precio = mysqli_real_escape_string($conexion, $_REQUEST['precio'] ?? '');
    $existencia = mysqli_real_escape_string($conexion, $_REQUEST['existencia'] ?? '');
    $descripcion = mysqli_real_escape_string($conexion, $_REQUEST['descripcion'] ?? '');
    $categoria = mysqli_real_escape_string($conexion, $_REQUEST['categoria'] ?? '');
    $id = mysqli_real_escape_string($conexion, $_REQUEST['id'] ?? '');


    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
        $nombre_imagen = $_FILES['imagen']['name'];
        $ruta_temporal = $_FILES['imagen']['tmp_name'];
        $ruta_destino = 'fotos/' . $nombre_imagen;
        move_uploaded_file($ruta_temporal, $ruta_destino);
    } else {
        // Si no se selecciona una nueva imagen, conserva la imagen actual
        $nombre_imagen = $_REQUEST['imagen_actual'];
    }

    $query = "UPDATE productos SET 
    nombre='" . $nombre . "',precio='" . $precio . "',existencia='" . $existencia . "',imagen='" . $nombre_imagen . "',descripcion='" . $descripcion . "',categoria='" . $categoria . "' where id='" . $id . "' ;
    ";
    $resultado = mysqli_query($conexion, $query);
    if ($resultado) {
        echo '<meta http-equiv="refresh" content="0; url=panel.php?modulo=productos&mensaje=Producto ' . $nombre . ' editado exitosamente "/>';
    } else {
?>
        <div class="alert alert-danger" role="alert">
            <strong>Error al editar producto <?php echo mysqli_error($conexion); ?></strong>
        </div>
<?php
    }
}
$id = mysqli_real_escape_string($conexion, $_REQUEST['id'] ?? '');
$query = "SELECT id,nombre,precio,existencia,descripcion,categoria,imagen from productos where id='" . $id . "';";
$resultado = mysqli_query($conexion, $query);
$row = mysqli_fetch_assoc($resultado);
?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Editar Producto</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="panel.php?modulo=editarProducto" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="">Nombre</label>
                                <input type="text" name="nombre" class="form-control" value="<?php echo $row['nombre'] ?>" required="required">
                            </div>
                            <div class="form-group">
                                <label for="">Precio</label>
                                <input type="text" name="precio" class="form-control" value="<?php echo $row['precio'] ?>" required="required">
                            </div>
                            <div class="form-group">
                                <label for="">Existencia</label>
                                <input type="text" name="existencia" class="form-control" value="<?php echo $row['existencia'] ?>" required="required">
                            </div>
                            <div class="form-group">
                                <label for="">Descripción</label>
                                <textarea name="descripcion" class="form-control" rows="4" required><?php echo $row['descripcion'] ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="">Categoria</label>
                                <select name="categoria" class="form-control" required="required">
                                    <option value="Celulares" <?php if ($row['categoria'] === 'Celulares') echo 'selected' ?>>Celulares</option>
                                    <option value="Tablets" <?php if ($row['categoria'] === 'Tablets') echo 'selected' ?>>Tablets</option>
                                    <option value="Laptops" <?php if ($row['categoria'] === 'Laptops') echo 'selected' ?>>Laptops</option>
                                </select>

                            </div>
                            <div class="form-group">
                                <label for="">Imagen</label>
                                <input type="file" name="imagen" class="form-control-file">
                                <input type="hidden" name="imagen_actual" value="<?php echo $row['imagen']; ?>">
                            </div>
                            <div>
                                <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
                                <button type="submit" class="btn btn-primary" name="guardar">Guardar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
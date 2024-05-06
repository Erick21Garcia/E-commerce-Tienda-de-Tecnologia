<?php
if (isset($_REQUEST['guardar'])) {
    include_once "conexion.php";
    $conexion = mysqli_connect($host, $user, $pass, $db);

    $nombre = mysqli_real_escape_string($conexion, $_REQUEST['nombre'] ?? '');
    $precio = mysqli_real_escape_string($conexion, $_REQUEST['precio'] ?? '');
    $existencia = mysqli_real_escape_string($conexion, $_REQUEST['existencia'] ?? '');
    $descripcion = mysqli_real_escape_string($conexion, $_REQUEST['descripcion'] ?? '');
    $categoria = mysqli_real_escape_string($conexion, $_REQUEST['categoria'] ?? '');


    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
        $nombre_imagen = $_FILES['imagen']['name'];
        $ruta_temporal = $_FILES['imagen']['tmp_name'];
        $ruta_destino = 'fotos/' . $nombre_imagen;
        move_uploaded_file($ruta_temporal, $ruta_destino);
    } else {
        echo '<div class="alert alert-danger" role="alert" >
                <strong>Error al subir la imagen del producto</strong>
            </div>';
        exit; 
    }

    $query = "INSERT INTO productos 
    (nombre,precio,existencia,descripcion,categoria,imagen) VALUES
    ('" . $nombre . "','" . $precio . "','" . $existencia . "','" . $descripcion . "','" . $categoria . "','" . $nombre_imagen . "')
    ";
    $resultado = mysqli_query($conexion, $query);
    if ($resultado) {
        echo '<meta http-equiv="refresh" content="0; url=panel.php?modulo=productos&mensaje=Producto creado exitosamente "/>';
    } else {
?>
        <div class="alert alert-danger" role="alert">
            <strong>Error al añadir producto <?php echo mysqli_error($conexion); ?></strong>
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
                    <h1>Añadir Producto</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="panel.php?modulo=crearProducto" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="">Nombre</label>
                                <input type="text" name="nombre" class="form-control" required="required">
                            </div>
                            <div class="form-group">
                                <label for="">Precio</label>
                                <input type="text" name="precio" class="form-control" required="required">
                            </div>
                            <div class="form-group">
                                <label for="">Existencia</label>
                                <input type="text" name="existencia" class="form-control" required="required">
                            </div>
                            <div class="form-group">
                                <label for="">Descripción</label>
                                <textarea name="descripcion" class="form-control" rows="4" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="">Categoria</label>
                                <select name="categoria" class="form-control" required="required">
                                    
                                    <option value="Celulares">Celulares</option>
                                    
                                    <option value="Tablets">Tablets</option>
                                    
                                    <option value="Laptops">Laptops</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Imagen</label>
                                <input type="file" name="imagen" class="form-control-file" required="required">
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
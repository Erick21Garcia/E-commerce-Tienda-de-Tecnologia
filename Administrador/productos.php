<?php
include_once "conexion.php";
$conexion=mysqli_connect($host,$user,$pass,$db);
if(isset($_REQUEST['idBorrar'])){
    $id = mysqli_real_escape_string($conexion,$_REQUEST['idBorrar']??'');
    $query="DELETE from productos where id='".$id."';";
    $resultado = mysqli_query($conexion,$query);
    if($resultado){
        ?>
        <meta http-equiv="refresh" content="0; url=panel.php?modulo=productos&mensaje=Producto borrado exitosamente "/>
        <?php
    }else{
        ?>
        <div class="alert alert-warning float-right" role="alert">
            <strong>Error al borrar <?php echo mysqli_error($conexion); ?></strong>
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
                    <h1>Productos</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Precio</th>
                                    <th>Existencia</th>
                                    <th>Categoría</th>
                                    <th>Descripción</th>
                                    <th>Acciones
                                        <a href="panel.php?modulo=crearProducto"> <i class="fa fa-plus" aria-hidden="true"></i> </a>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query="SELECT id,nombre,precio,existencia,categoria,descripcion from productos; ";
                                $resultado=mysqli_query($conexion,$query);

                                while($row = mysqli_fetch_assoc($resultado)){
                                    ?>
                                    <tr>
                                    <td><?php echo $row['nombre'] ?></td>
                                    <td><?php echo $row['precio'] ?></td>
                                    <td><?php echo $row['existencia'] ?></td>
                                    <td><?php echo $row['categoria'] ?></td>
                                    <td><?php echo $row['descripcion'] ?></td>
                                    <td>
                                        <a href="panel.php?modulo=editarProducto&id=<?php echo $row['id'] ?>" style="margin-right: 5px;"><i class="fas fa-edit"></i></a>
                                        <a href="panel.php?modulo=productos&idBorrar=<?php echo $row['id'] ?>" class="text-danger borrar"><i class="fas fa-trash"></i></a> 
                                    </td>
                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
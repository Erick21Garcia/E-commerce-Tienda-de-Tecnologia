<?php
include_once "conexion.php";
$conexion=mysqli_connect($host,$user,$pass,$db);
if(isset($_REQUEST['idBorrar'])){
    $id = mysqli_real_escape_string($conexion,$_REQUEST['idBorrar']??'');
    $query="DELETE from usuarios where id='".$id."';";
    $resultado = mysqli_query($conexion,$query);
    if($resultado){
        ?>
        <meta http-equiv="refresh" content="0; url=panel.php?modulo=usuarios&mensaje=Usuario borrado exitosamente "/>
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
                    <h1>Usuarios</h1>
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
                                    <th>Cliente</th>
                                    <th>Fecha</th>
                                    <th>Ingreso</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query="SELECT id,ClienteNombre,FechaCompra,IngresoTotal from registroventas; ";
                                $resultado=mysqli_query($conexion,$query);

                                while($row = mysqli_fetch_assoc($resultado)){
                                    ?>
                                    <tr>
                                    <td><?php echo $row['ClienteNombre'] ?></td>
                                    <td><?php echo $row['FechaCompra'] ?></td>
                                    <td>$ <?php echo $row['IngresoTotal'] ?></td>
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
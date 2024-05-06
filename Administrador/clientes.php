<?php
include_once "conexion.php";
$conexion=mysqli_connect($host,$user,$pass,$db);
if(isset($_REQUEST['idBorrar'])){
    $id = mysqli_real_escape_string($conexion,$_REQUEST['idBorrar']??'');
    $query="DELETE from cliente where id='".$id."';";
    $resultado = mysqli_query($conexion,$query);
    if($resultado){
        ?>
        <meta http-equiv="refresh" content="0; url=panel.php?modulo=clientes&mensaje=Cliente borrado exitosamente "/>
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
                    <h1>Clientes</h1>
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
                                    <th>Email</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query="SELECT id,email,nombreC from cliente; ";
                                $resultado=mysqli_query($conexion,$query);

                                while($row = mysqli_fetch_assoc($resultado)){
                                    ?>
                                    <tr>
                                    <td><?php echo $row['nombreC'] ?></td>
                                    <td><?php echo $row['email'] ?></td>
                                    <td>
                                        <a href="panel.php?modulo=editarCliente&id=<?php echo $row['id'] ?>" style="margin-right: 5px;"><i class="fas fa-edit"></i></a>
                                        <a href="panel.php?modulo=clientes&idBorrar=<?php echo $row['id'] ?>" class="text-danger borrar"><i class="fas fa-trash"></i></a> 
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
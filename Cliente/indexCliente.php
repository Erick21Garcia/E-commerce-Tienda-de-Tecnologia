<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>NeoCenter | Log in</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition login-page">
  <div class="login-box">
    <div class="login-logo">
      <a href="../../indexCliente.php"><b>Neo</b>Center</a>
    </div>
    <div class="card">
      <div class="card-body login-card-body">
        <h5 class="login-box-msg">Cliente</h5>
        <p class="login-box-msg">Iniciar sesión</p>
        <?php
        if (isset($_REQUEST['login'])) {
          session_start();
          $correo = $_REQUEST['email'] ?? '';
          $contra = $_REQUEST['password'] ?? '';
          $contra = md5($contra);
          include_once "../Administrador/conexion.php";
          $conexion = mysqli_connect($host, $user, $pass, $db);
          $query = "SELECT id,email,nombreC from cliente where email='" . $correo . "' and contraseña='" . $contra . "'";
          $resultado = mysqli_query($conexion, $query);
          $row = mysqli_fetch_assoc($resultado);
          if ($row) {
            $_SESSION['id'] = $row['id'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['nombre'] = $row['nombreC'];
            header("location: front.php");
          } else {
        ?>
            <div class="alert alert-danger text-center" role="alert">
              <strong>Inicio de sesión fallida</strong>
            </div>
        <?php
          }
        }
        ?>
        <form method="post">
          <div class="input-group mb-3">
            <input type="email" class="form-control" placeholder="Correo electrónico" name="email">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" class="form-control" placeholder="Contraseña" name="password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="col-12">
            <button type="submit" class="btn btn-success btn-block" name="login">Ingresar</button>
          </div>
      </div>
      </form>
      <form action="registroCliente.php">
        <div class="input-group mb-3 justify-content-center">
          <div class="col-8">
            <button type="submit" class="btn btn-primary btn-block">Registrarse</button>
          </div>
        </div>
      </form>
    </div>
  </div>

  <script src="../plugins/jquery/jquery.min.js"></script>
  <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../dist/js/adminlte.min.js"></script>

</body>

</html>
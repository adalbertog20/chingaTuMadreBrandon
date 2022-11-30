<?php
session_destroy();
session_start();
include("db.php");
$errors = "";
$_SESSION['success'] = "";
if (!empty($_POST['iniciar'])) {
    if (empty($_POST['usuario']) && empty($_POST['contrasena'])) {
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong>Campos vacios!</strong><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
    } else {
        $usuario = $_POST['usuario'];
        $contrasena = $_POST['contrasena'];
        $query = $conn->query("SELECT * FROM clientes WHERE usuario='$usuario' and contrasena='$contrasena'");
        if ($datos = $query->fetch_object()) {
            $_SESSION['username'] = $usuario;
            $_SESSION['success'] = "You have logged in";
            header("Location: inicio.php");
        } else {
            echo '<div class="alert alert-primary alert-dismissible fade show" role="alert">
  <strong>Credenciales incorrectas!</strong><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="estilosGeneral.css">
    <link rel="stylesheet" href="estilosLogin.css">
    <title>Login</title>
</head>

<body>
    <div class="pnlRegistro">
        <h1>Iniciar Sesion</h1>
        <form method="POST">
            <label for="txtNombreUsuario">Nombre de usuario</label><br>
            <input type="text" name="usuario" id="txtNombreUsuario"><br>
            <label for="txtContrasena">Contraseña</label><br>
            <input type="password" name="contrasena" id="txtContrasena"><br>
            <input type="submit" name="iniciar" value="iniciar sesion " />
        </form>
        <p class="registro">¿Aún no cuentas con una cuenta? <a href="registro.php">Crear cuenta...</a></p>
    </div>
</body>

</html>

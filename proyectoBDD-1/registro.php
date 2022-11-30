<?php
include("db.php");
if (isset($_POST['registro'])) {
    if (empty($_POST['usuario']) || empty($_POST['contrasena']) || empty($_POST['email']) || empty($_POST['fecha_nacimiento']) || empty($_POST['num_telefonico'])) {
        echo 'CAMPOS VACIOS';
    } else {
        $usuario = $_POST['usuario'];
        $contrasena = $_POST['contrasena'];
        $email = $_POST['email'];
        $fecha_nacimiento = $_POST['fecha_nacimiento'];
        $num_telefonico = $_POST['num_telefonico'];
        $sql = "INSERT INTO clientes (usuario, contrasena, email, fecha_nacimiento, num_telefonico) VALUES ('$usuario', '$contrasena', '$email', '$fecha_nacimiento', '$num_telefonico')";
        if($conn->query($sql) === 0) {
            echo 'USUARIO NO REGISTRADO';
        } else {
            header("location: index.php");
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
    <link rel="stylesheet" href="estilosRegistrar.css">
    <title>Registrar</title>
</head>

<body>

    <div class="pnlRegistro">
        <h1>CREA TU CUENTA</h1>
        <form method="post">
            <label for="usuario">Nombre de usuario</label><br>
            <input type="text" name="usuario" id="usuario"><br>
            <label for="contrasena">Contraseña</label><br>
            <input type="password" name="contrasena" id="contrasena"><br>
            <label for="email">Correo electronico</label><br>
            <input type="text" name="email" id="email"><br>
            <label for="fecha_nacimiento">Fecha de Nacimiento</label><br>
            <input type="date" name="fecha_nacimiento" value="" max="2022-11-15"><br>
            <label for="num_telefonico">Número telefonico</label><br>
            <input type="text" name="num_telefonico" id="num_telefonico"><br>
            <input type="submit" name="registro" value="Registrar" />
            <p class="registro">¿Ya cuentas con una cuenta? <a href="index.php">Inicia Sesion...</a></p>
        </form>
    </div>
</body>

</html>

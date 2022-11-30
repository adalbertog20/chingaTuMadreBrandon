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
        $query = $conn->query("INSERT INTO clientes (usuario, contrasena, email, fecha_nacimiento, num_telefonico) VALUES ('$usuario', '$contrasena', '$email', '$fecha_nacimiento', '$num_telefonico')");
        $res = mysqli_query($conn, $query);
        if (!$res) {
            die("query failed");
        } else {
            echo '<script type="text/javascript">
location.replace("index.php"); </script>';
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
    <title>venta</title>
</head>

<body>
    <div class="pnlRegistro">
        <h1>Venta</h1>
        <form method="post">
            <label for="nombre_prod">Nombre del producto</label><br>
            <input type="text" onkeypress="return false" name="nombre_prod" id="nombre_prod"><br>
            <label for="fecha_venta">Fecha de la venta</label><br>
            <input type="date" name="fecha_venta" onkeypress="return false" onclick="return false" value="<?php $hoy=date("Y-m-d"); echo $hoy;?>"><br>
            <label for="monto">Monto de la venta</label><br>
            <input type="text" onkeypress="return false" name="monto" id="monto"><br>
            <label for="cantidad">Cantidad</label><br>
            <input type="number" name="cantidad" id="cantidad"><br>
            <label for="descripcion">Descripción</label><br>
            <input type="text" name="descripcion" id="descripcion"><br>
            <input type="submit" name="enviar" value="Enviar" />
            <input type="submit" name="cancelar" value="Cancelar" />
        </form>
    </div>
</body>
</html>

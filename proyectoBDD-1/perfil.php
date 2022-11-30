<?php
include("db.php");
session_start();
if (isset($_POST['salir'])) {
    session_destroy();
    header("location: index.php");
}
$usuario = $_SESSION['username'];
$res = mysqli_query($conn, "SELECT * FROM clientes WHERE usuario='$usuario'");
$data = mysqli_fetch_assoc($res);
$contrasena = $data['contrasena'];
$email = $data['email'];
$fecha_nacimiento = $data['fecha_nacimiento'];
$num_telefonico = $data['num_telefonico'];
if (isset($_POST['actualizar'])) {
    $usuario = $_POST['usuario'];
    $user = $_SESSION['username'];
    $contrasena = $_POST['contrasena'];
    $email = $_POST['email'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $num_telefonico = $_POST['num_telefonico'];
    $sql = "UPDATE clientes SET usuario='$usuario', contrasena='$contrasena', email='$email', fecha_nacimiento='$fecha_nacimiento', num_telefonico='$num_telefonico'
    WHERE usuario='$user'";
    if ($conn->query($sql) === 0) {
        echo 'DATOS NO ACTUAZILADOS';
    } else {
        echo 'DATOS ACTUAZILADOS';
        header("location: index.php");
    }
}
if (isset($_POST['eliminar'])) {
    if (empty($_POST['contrasena_eliminar'])) {
        echo 'INGRESA TU CONTRASENA PARA ELIMINAR TU CUENTA';
    } else {
        $usuario = $_SESSION['username'];
        $res = mysqli_query($conn, "SELECT contrasena as pass FROM clientes WHERE usuario='$usuario'");
        $data = mysqli_fetch_assoc($res);
        if ($_POST['contrasena_eliminar'] == $data['pass']) {
            $res = mysqli_query($conn, "DELETE FROM clientes WHERE usuario='$usuario'");
            header("location: index.php");
        } else {
            echo 'Contrasena Incorrecta';
        }
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="estilosGeneral.css">
    <link rel="stylesheet" href="perfil.css" type="text/css" media="screen" />
    <title>Perfil</title>
    </style>
</head>
<?php include("db.php"); ?>

<body>
    <header class="banner">
        <div class="logo">
            <a href="inicio.php"><img class="logo" src="img/titulo.png"></a>
        </div>
        <div class="buscador">
            <input onkeyup="buscar_ahora($('#buscador').val());" type="text" name="buscador" id="buscador" placeholder="Buscador por saga">
        </div>
        <nav>
            <a href="inicio.php">Inicio</a>
        </nav>
        <div class="perfil">
            <nav>
                <a href="perfil.php">
                    <?php echo $_SESSION['username']; ?>
                </a>
            </nav>
            </a>
        </div>
    </header>
    <div class="busquedaResultado">
        <div id="resultados"></div>
    </div>
    <div class="forma">

        <form method="post">
            <div>
                <label for="">Usuario</label>
                <input type="text" name="usuario" value="<?php echo $usuario; ?>" />
            </div>
            <div>
                <label for="">contrasena</label>
                <input type="password" name="contrasena" value="<?php echo $contrasena; ?>" />
            </div>
            <div>
                <label for="">email</label>
                <input type="text" name="email" value="<?php echo $email; ?>" />
            </div>
            <div>
                <label for="">fecha de nacimiento</label>
                <input type="date" name="fecha_nacimiento" value="<?php echo $fecha_nacimiento; ?>" />
            </div>
            <div>
                <label for="">numero telefonico</label>
                <input type="text" name="num_telefonico" value="<?php echo $num_telefonico; ?>" />
            </div>
            <div class="forma">
                <input type="submit" name="actualizar" value="Actualizar" />
                <input type="submit" name="salir" value="Cerrar session" />
            </div>
        </form>
        <form method="post">
            <h1>Eliminar Cuenta</h1>
            <div>
                <label for="">contrasena</label>
                <input type="password" name="contrasena_eliminar" value="" />
                <input type="submit" name="eliminar" value="Eliminar cuenta" />
            </div>

        </form>
    </div>
    <script type="text/javascript">
        function buscar_ahora(buscar) {
            var parametros = {
                "buscar": buscar
            };
            $.ajax({
                data: parametros,
                type: 'POST',
                url: 'buscador.php',
                success: function(data) {
                    if (document.getElementById("buscador").value == "") {
                        document.getElementById("resultados").style.display = "none";
                    } else {
                        document.getElementById("resultados").style.display = "block";
                        document.getElementById("resultados").innerHTML = data;
                    }
                }
            });
        }
    </script>
</body>

</html>

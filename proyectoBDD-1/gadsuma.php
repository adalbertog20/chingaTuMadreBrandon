<?php
session_start();
function exist($nom_prod)
{
    include("db.php");
    $res = mysqli_query($conn, "SELECT stock as st FROM producto WHERE nombre='$nom_prod'");
    $data = mysqli_fetch_array($res, MYSQLI_ASSOC);
    echo '<div class="alert alert-warning alert-dismissible fade show">Fisico en existencia:' . $data['st'] . '</div>';
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="estilosGeneral.css">
    <link rel="stylesheet" href="estilosComics.css">
    <title>Comic</title>
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
            <a href="inicio.php" class="nav-link">Inicio</a>
        </nav>
        <div class="perfil">
            <div class="usuario">
                <a href="perfil.php">
                    <?php echo $_SESSION['username']; ?>
                </a>
            </div>
        </div>
    </header>
    <div class="busquedaResultado">
        <div id="resultados"></div>
    </div>
    <div class="contenedor">
        <div class="contSuperior">
            <img src="img/portada/portada_Gadsuma.jpeg" alt="Gadsuma">
            <div class="descripcion">
                <h2>Eddy Murillo</h2>
                <a href="gadsuma.php">
                    <h1>Demangel (2021)</h1>
                </a>
                <h2>Acción/Fantasía</h2>
                <p>
                    Gadsuma un chico de 14 años después de un acontecimiento a quedado con amnesia,
                    ahora junto con sus compañeros Kazumi y Toramaru tendrá que ayudar a Gadusuma
                    a recuperar su recuerdos ya que lo persiguen unos seres demasiado fuertes y
                    peligrosos que amenazan las vidas de Gadsuma y sus amigos.
                </p>
                <div class="estado">
                    <p>Activo
                    <div id="activo"></div>
                    </p><br />
                    <p>Clickea para comprar</p>
                </div>

            </div>
        </div>
    </div>
    <form method="post">
        <div class="contCapitulos">
            <div class="capitulos">
                <input id="uno" type="submit" name="capitulouno" value="Capitulo 1: Gadsuma $29.99" />
            </div>
            <div class="capitulos">
                <input type="submit" name="capitulodos" value="Capitulo 2: Gadsuma $29.99" />
            </div>
            <div class="capitulos">
                <input type="submit" name="capitulotres" value="Capitulo 3: Gadsuma $29.99" />
            </div>
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
    <?php
    function venta($comic)
    {
        include("db.php");

        $res = mysqli_query($conn, "INSERT INTO detalle_venta (cantidad, fecha_venta, monto_venta, descripcion_venta, id_producto)
VALUES(1, CURDATE(), (SELECT precio FROM producto WHERE nombre='$comic'), 'COMPRAR', 2)");
        $res = mysqli_query($conn, "UPDATE producto SET stock=stock-1 WHERE nombre='$comic'");
    }
    switch (true) {
        case isset($_POST['capitulouno']);
            venta('Gadsuma: Capitulo 1');
            exist('Gadsuma: Capitulo 1');
            echo '<object class="pdfview" data="comics/demangel/Capitulo 1.pdf" type="application/pdf"></object>';
            break;
        case isset($_POST['capitulodos']);
            venta('Gadsuma: Capitulo 2');
            exist('Gadsuma: Capitulo 2');
            echo '<object class="pdfview" data="comics/demangel/Capitulo 2.pdf" type="application/pdf"></object>';
            break;
        case isset($_POST['capitulotres']);
            venta('Gadsuma: Capitulo 3');
            exist('Gadsuma: Capitulo 3');
            echo '<object class="pdfview" data="comics/demangel/Capitulo 3.pdf" type="application/pdf"></object>';
            break;
    }
    ?>

</body>

</html>

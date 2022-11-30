<?php
include("db.php");
session_start();

function fav_shit($nom_saga)
{
    include("db.php");
    $username = $_SESSION['username'];
    $res = mysqli_query($conn, "SELECT COUNT(*) AS fav FROM favoritos WHERE id_cliente=(SELECT id_cliente FROM clientes WHERE usuario='$username') AND id_saga=(SELECT id_saga FROM sagas WHERE nom_saga='$nom_saga')");
    $data = mysqli_fetch_assoc($res);
    if ($data['fav'] == 0) {
        $res = mysqli_query($conn, "INSERT INTO favoritos (id_saga, id_cliente) VALUES ((SELECT id_saga FROM sagas WHERE nom_saga = '$nom_saga'), (SELECT id_cliente FROM clientes WHERE usuario='$username') )");
        echo 'agregado a favoritos';
    } else {
        $res = mysqli_query($conn, "DELETE FROM favoritos WHERE id_cliente=(SELECT id_cliente FROM clientes WHERE usuario='$username') AND id_saga=(SELECT id_saga FROM sagas WHERE nom_saga='$nom_saga')");
        echo 'eliminado de favs';
    }
}

function ver_shit($nom_saga)
{
    include("db.php");
    $res = mysqli_query($conn, "SELECT visualizaciones AS vis FROM sagas WHERE nom_saga='$nom_saga'");
    $data = mysqli_fetch_assoc($res);
    $visua = ((int)$data['vis']) + 1;
    $res = mysqli_query($conn, "UPDATE sagas SET visualizaciones='$visua' WHERE nom_saga='$nom_saga'");
}

switch (true) {
    case isset($_POST['favgadsuma']);
        fav_shit("Gadsuma");
        break;
    case isset($_POST['favmagooz']);
        fav_shit("Mago de oz");
        break;
    case isset($_POST['favsherlock']);
        fav_shit("Sherlock Holmes");
        break;
    case isset($_POST['favwow']);
        fav_shit("World of Warcraft");
        break;
    case isset($_POST['vergadsuma']);
        ver_shit("Gadsuma");
        header("location: gadsuma.php");
        break;
    case isset($_POST['vermagodeoz']);
        ver_shit("Mago de oz");
        header("location: libroMagoDeOz.php");
        break;
    case isset($_POST['versherlock']);
        ver_shit("Sherlock Holmes");
        header("location: libroSherlock.php");
        break;
    case isset($_POST['verwow']);
        ver_shit("World of Warcraft");
        header("location: comicWarcraft1.php");
        break;
}

function show_fav($nom_saga)
{
    include("db.php");
    $sql = "SELECT COUNT(*) AS total FROM favoritos WHERE id_saga=(SELECT id_saga FROM sagas WHERE sagas.nom_saga='$nom_saga')";
    $res = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($res, MYSQLI_ASSOC);
    return $row['total'];
}

function show_views($nom_saga)
{
    include("db.php");
    $sql_view = "SELECT visualizaciones AS vis FROM sagas WHERE nom_saga='$nom_saga'";
    $res_view = mysqli_query($conn, $sql_view);
    $data_view = mysqli_fetch_array($res_view, MYSQLI_ASSOC);
    return $data_view['vis'];
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
    <link rel="stylesheet" href="estilosIndex.css">
    <title>Inicio</title>
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
    <div class="catalogo">
        <div class="comics">
            <img src="img/portada/portada_Gadsuma.jpeg" alt="Gadsuma">
            <div class="descripcion">
                <img src="img/vistasIcon.png" id="visual">
                <p class="texto"> <?php echo show_views('Gadsuma'); ?> </p>
                <form method="post">
                    <input class="btn btn-primary" type="submit" name="vergadsuma" value="ver" />
                </form>
            </div>
            <div class="descripcion">
                <img src="img/favIcon.png" id="visual">
                <p class="texto"> <?php echo show_fav('Gadsuma'); ?> </p>
                <form method="post">
                    <input class="btn btn-primary" type="submit" name="favgadsuma" value="favoritos" />
                </form>
            </div>
        </div>
        <div class="comics">
            <img src="img/portada/portada_MagoDeOz.jpeg" alt="MagoDeOz">
            <div class="descripcion">
                <img src="img/vistasIcon.png" id="visual">
                <p class="texto"> <?php echo show_views('Mago de oz'); ?> </p>
                <form method="post">
                    <input class="btn btn-primary" type="submit" name="vermagodeoz" value="ver" />
                </form>
            </div>
            <div class="descripcion">
                <img src="img/favIcon.png" id="visual">
                <p class="texto"> <?php echo show_fav("Mago de oz"); ?> </p>
                <form method="post">
                    <input class="btn btn-primary" type="submit" name="favmagooz" value="favoritos" />
                </form>
            </div>
        </div>
        <div class="comics">
            <img src="img/portada/portada_Sherlock.jpeg" alt="Sherlock">
            <div class="descripcion">
                <img src="img/vistasIcon.png" id="visual">
                <p class="texto"> <?php echo show_views('Sherlock Holmes'); ?> </p>
                <form method="post">
                    <input class="btn btn-primary" type="submit" name="versherlock" value="ver" />
                </form>
            </div>
            <div class="descripcion">
                <img src="img/favIcon.png" id="visual">
                <p class="texto"><?php echo show_fav("Sherlock Holmes"); ?></p>
                <form method="post" id="" action="">
                    <input class="btn btn-primary" type="submit" name="favsherlock" value="favoritos" />
                </form>
            </div>
        </div>
        <div class="comics">
            <img src="img/portada/wow.jpeg" alt="HijoDelLobo">
            <div class="descripcion">
                <img src="img/vistasIcon.png" id="visual">
                <p class="texto"> <?php echo show_views('World of Warcraft'); ?> </p>
                <form method="post" id="" action="">
                    <input class="btn btn-primary" type="submit" name="verwow" value="ver" />
                </form>
            </div>
            <div class="descripcion">
                <img src="img/favIcon.png" id="visual">
                <p class="texto"> <?php echo show_fav('World of Warcraft'); ?> </p>
                <form method="post">
                    <input class="btn btn-primary" type="submit" name="favwow" value="favoritos" />
                </form>
            </div>
        </div>

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

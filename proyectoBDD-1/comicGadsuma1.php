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
    <link rel="stylesheet" href="https://stackpath.bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="estilosGeneral.css">
    <link rel="stylesheet" href="estilosComics.css">
    <title>Gadsuma</title>
</head>
<?php include("db.php"); ?>

<body>
    <header class="banner">
        <div class="logo">
            <a href="index.html"><img class="logo" src="img/titulo.png"></a>
        </div>
        <div class="buscador">
            <input onkeyup="buscar_ahora($('#buscador').val());" type="text" name="buscador" id="buscador"
                placeholder="Buscador por saga">
        </div>
        <nav>
            <a href="index.php" class="nav-link">Inicio</a>
        </nav>
        <div class="perfil">
            <div class="usuario">
                <a href="registro.php">
                    <img src="img/userIcon.png">
                </a>
            </div>
        </div>
    </header>
    <div class="busquedaResultado">
        <div id="resultados"></div>
    </div>
    <br><a href="gadsuma.html" class="regresar">Regresar</a>
    <h1 class="titulo">Gadsuma</h1>
    <h2 class="titulo">Capitulo 1: Gadsuma</h2>
    <object class="pdfview" data="comics/demangel/Capitulo 1.pdf" type="application/pdf"></object>
    <div class="botones">
        <a style="display: none;"><button>
                Capitulo Anterior
            </button></a>
        <a href="comicGadsuma2.html"><button>
                Siguiente Capitulo
            </button></a>
    </div>
    <script type="text/javascript">

        function buscar_ahora(buscar) {
            var parametros = { "buscar": buscar };
            $.ajax({
                data: parametros,
                type: 'POST',
                url: 'buscador.php',
                success: function (data) {
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

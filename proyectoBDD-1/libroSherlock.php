<?php session_start(); ?>
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
    <link rel="stylesheet" href="estilosComics.css">
    <title>Sherlock H.</title>
</head>

<body>
    <header class="banner">
        <div class="logo">
            <a href="inicio.php"><img class="logo" src="img/titulo.png"></a>
        </div>
        <div class="buscador">
            <input onkeyup="buscar_ahora($('#buscador').val());" type="text" name="buscador" id="buscador"
                placeholder="Buscador por saga">
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
    <br><a href="Sherlock.html" class="regresar">Regresar</a>
    <h1 class="titulo">Sherlock Holmes</h1>
    <h2 class="titulo">Las aventuras de Sherlock H.</h2>
    <object class="pdfview" data="comics/SherlockHolmes/SherlockHolmes.pdf" type="application/pdf"></object>
    <div class="botones">
        <a href="inicio.php"><button>
                Volver al inicio
            </button></a>
        <a style="display: none;"><button>
                Siguiente Capitulo
            </button></a>
    </div>
</body>

</html>

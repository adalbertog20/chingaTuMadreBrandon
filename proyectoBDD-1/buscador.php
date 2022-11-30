<?php include("db.php");
$buscador = mysqli_query($conn,"SELECT nom_saga,urls FROM sagas WHERE nom_saga LIKE LOWER('%" . $_POST["buscar"] . "%')");
$numero = mysqli_num_rows($buscador);
?>
<h5 class="card-tittle">Resultados encontrados(<?php echo $numero; ?>):</h5>
<?php while ($resultado = mysqli_fetch_assoc($buscador)) { ?>
<a class="resultadoBuscador" href="<?php echo $resultado["urls"]; ?>">
    <?php echo $resultado["nom_saga"]; ?>
</a><br>
<?php } ?>
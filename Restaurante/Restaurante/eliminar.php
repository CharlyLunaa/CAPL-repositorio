<?php
include ("Conexion.php");

if (isset($_GET['nombre'])) {
    $nombre = $_GET['nombre'];

    $sql = "DELETE FROM clientes WHERE nombre = '$nombre'";
    $resultado = $conexion->query($sql);

    if ($resultado) {
        header("location: index.php");
    }

    $conexion->close();
}
?>
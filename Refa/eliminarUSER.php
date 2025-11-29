<?php
include ("Conexion.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM usuarios WHERE (id = '$id')";
    $resultado = $conexion->query($sql);

    if ($resultado) {
        
        session_start();
        session_destroy();

        header("Location: index.php");
        exit();
    } else {
        echo "No hay datos con ese Nombre";
    }
    $conexion->close();
}
?>
<?php
include ("Conexion.php");
echo "<p>Borrar de forma Individual</p><br><br>";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM inventario WHERE (id = '$id')";
    $resultado = $conexion->query($sql);

    if ($resultado) {
        header("Location: CRUD.php");
        //exit();
    } else {
        echo "No hay datos con ese Nombre";
    }
    $conexion->close();
}
?>
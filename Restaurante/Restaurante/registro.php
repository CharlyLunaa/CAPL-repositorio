<?php

include ("Conexion.php");

if (isset($_POST['continuar'])) {
    if (
        isset($_POST['nombre'])
        && isset($_POST['telefono'])
        && isset($_POST['direccion'])
        && isset($_POST['contrasena'])
    ) {
        $nombre = $_POST["nombre"];
        $telefono = $_POST["telefono"];
        $direccion = $_POST["direccion"];
        $contrasena = $_POST["contrasena"];

        $sentencia = $conexion->prepare("INSERT INTO clientes(nombre , telefono , direccion , contrasena) 
            VALUES ('$nombre' , '$telefono' , '$direccion' ,'$contrasena')");

        $sentencia->execute();

        if ($conexion->affected_rows >= 1) {

            header("Location: index.php?nombre=$nombre");
        }
    }
}
mysqli_close($conexion);

?>
<?php
include("Conexion.php");

if (isset($_POST['continuar']) && isset($_POST['nombre']) && isset($_POST['contrasena'])) {
    $nombre = $_POST['nombre'];
    $contrasena = $_POST['contrasena'];
    
    $sql = "SELECT * FROM clientes WHERE nombre = '$nombre' AND contrasena = '$contrasena'";
    $resultado = $conexion->query($sql);

    if ($resultado->num_rows > 0) {
        header("Location: index.php?nombre=$nombre");
        exit;
    } else {
        echo "<script>
            const parrafo1 = document.getElementById('errores');
            parrafo1.innerHTML = 'El usuario o la contraseña no existen';
        </script>";
        echo "<script>window.location.href = 'login.html';</script>";
        exit;
    }
    $conexion->close();
}
?>

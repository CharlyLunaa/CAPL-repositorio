<?php
include ("Conexion.php");

if (isset($_POST['aceptar']) && isset($_POST['name']) && isset($_POST['pass'])) {
    $name = $_POST['name'];
    $pass = $_POST['pass'];
    $sql = "SELECT * FROM usuarios WHERE (user = '$name' AND pass = '$pass')";
    $resultado = $conexion->query($sql);

    if ($resultado->num_rows) {

            session_start();
            $_SESSION['user'] = $name;
                header("Location: index.php");
            

    } else {
        echo "<script>alert('No existe ese ususario');</script>";
        header("Location: index.php");
    }
    $conexion->close();
}
?>
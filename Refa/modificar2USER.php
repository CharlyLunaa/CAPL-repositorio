<?php
include ("Conexion.php");

if (isset($_POST['guardar'])) {
    $id = $_POST['id'];
    $user = $_POST['user'];
    $edad = $_POST["edad"];
    $correo = $_POST["correo"];
    $pass = $_POST["pass"];
    $dire = $_POST["dire"];
    
    $sentencia = "SELECT * FROM usuarios WHERE (user = '$user')";
    $resultado = $conexion->query($sentencia);
    session_start();
    $usuario = $_SESSION['user'];

    if ($user != $usuario && $resultado->num_rows !== 0) {
        echo "<script>
                alert('El usuario ya existe');
                window.history.back();
                </script>";

    } else {

        $sql = "UPDATE usuarios SET user ='" . $user . "', edad='" . $edad . "', correo='" . $correo . "', pass='" . $pass . "', direccion='" . $dire . "' WHERE id='" . $id . "'";

        $sentencia = $conexion->query($sql);

        if ($sentencia) {
            echo 'Filas Modificadas';
            session_start();
            $_SESSION['user'] = $user;

            header("Location: index.php");
            exit();
        } else {
            echo 'No se modificó ninguna fila';
        }
    }
}
mysqli_close($conexion);
?>
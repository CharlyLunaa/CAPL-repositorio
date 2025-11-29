<style>
    body {
        background-color: rgb(37, 22, 2);
    }

    .logo {
        display: none;
    }
</style>
<?php


include ("Conexion.php");

if (isset($_POST['enviar'])) {
    if (
        isset($_POST['name'])
        && isset($_POST['user'])
        && isset($_POST['edad'])
        && isset($_POST['email'])
        && isset($_POST['pass'])
        && isset($_POST['dire'])
    ) {
        $name = $_POST["name"];
        $user = $_POST["user"];
        $edad = $_POST["edad"];
        $correo = $_POST["email"];
        $pass = $_POST["pass"];
        $direccion = $_POST["dire"];

        $sentencia = "SELECT * FROM usuarios WHERE (user = '$user')";
        $resultado = $conexion->query($sentencia);
        session_start();
        $usuario = $_SESSION['user'];

        if ($resultado->num_rows !== 0) {
            echo "<script>
                alert('El usuario ya existe');
                window.history.back();
                </script>";

        } else {

            $sentencia = $conexion->prepare("INSERT INTO usuarios(nombre , user , edad , correo , 
        pass , direccion) VALUES ('$name' , '$user' , '$edad' , '$correo' ,
        '$pass', '$direccion')");

            $sentencia->execute();

            if ($conexion->affected_rows >= 1) {
                session_start();
                $_SESSION['user'] = $user;

                header("Location: index.php");
            } else {
                echo 'Error 404';
            }
        }
    }
}
mysqli_close($conexion);

?>
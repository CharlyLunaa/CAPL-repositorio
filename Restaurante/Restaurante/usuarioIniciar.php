<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            background-color: wheat;
        }

        .panel {
            background-color: burlywood;
            text-align: center;
            margin: auto;
            padding: 30px;
        }

        .errores {
            background-color: yellow;
            color: red;
        }
        .botones{
            margin: auto;
            padding: 10px;
            display: flex;
            justify-content: center;
        }
    </style>
</head>

<body>
    <div class="panel">
        <form method="post" id="form">
        <fieldset>
            <legend>Iniciar sesion</legend>
            <br>
            <label for="nombre">Nombre: </label>
            <input type="text" name="nombre" size="20">
            <br><br>
            <label for="contrasena">Contraseña: </label>
            <input type="password" name="contrasena" size="20">
            <br><br>
            <p class="errores" id="errores"></p><br>
            <div class="botones">
            <input type="submit" name="continuar" class="continuar" value="Continuar"><br><br>
            <input type="button" id="regresar" class="regresar" value="Regresa"><br><br>       
            <input type="button" id="sesion" class="continuar" value="Registrarse">
            </div>
            </fieldset>
        </form>
    </div>
    <?php
    include ("Conexion.php");

    if (isset($_POST['continuar']) && isset($_POST['nombre']) && isset($_POST['contrasena'])) {
        $nombre = $_POST['nombre'];
        $contrasena = $_POST['contrasena'];
        $sql = "SELECT * FROM clientes WHERE (nombre = '$nombre' AND contrasena = '$contrasena')";
        $resultado = $conexion->query($sql);

        if ($resultado->num_rows) {
            header("Location: index.php?nombre=$nombre");
        } else {
            echo "<script>
        alert('el usuario o la contraseña no existe');
        </script>";
        }
        $conexion->close();
    }
    ?>
    <script>
        document.getElementById('regresar').addEventListener('click', () => {
                window.location.href = "index.php";
        });
        document.getElementById('sesion').addEventListener('click', () => {
                window.location.href = "usuarioRegistro.html";
        });
    </script>

</body>

</html>
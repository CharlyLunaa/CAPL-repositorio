
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Document</title>
<link rel="stylesheet" href="">
</head>
<body>
<fieldset><center><h1>Insertar una nueva cancion</h1></center>
<form method="post" action="Insertar.php">
Nombre de la cancion: <input type="text" name="nombre" required><br><br><br>
Nombre del artista: <input type="text" name="nombre_a" required><br><br><br>
Album: <input type="text" name="al" required><br><br><br>
Genero: <input type="text" name="gen" required><br><br><br>
<input type="submit" name="insertar" value="insertar"><br><br>
    </form>
    </fieldset>
</body>
</html>
<?php
include("conexion.php");

if(isset($_POST['insertar'])) {
    if(isset($_POST['nombre'], $_POST['nombre_a'], $_POST['al'], $_POST['gen'])) {
      
        $Nombre = $_POST["nombre"];
        $Nombre_Artista = $_POST["nombre_a"];
        $Album = $_POST["al"];
        $Genero = $_POST["gen"];

        $sentencia = $conexion->prepare("INSERT INTO musica (Nombre_Cancion, Nombre_Artista, Album, Genero) VALUES (?, ?, ?, ?)");
        
        if ($sentencia === false) {
            die('Error al preparar la consulta: ' . $conexion->error);
        }
        
        $sentencia->bind_param("ssss", $Nombre, $Nombre_Artista, $Album, $Genero);

        $sentencia->execute();

        if($sentencia->affected_rows >= 1) {
            echo "Filas agregadas: " . $sentencia->affected_rows;
        } else {
            echo "No se agregó nada";
        }

        $sentencia->close();
    } else {
        echo "Por favor completa todos los campos requeridos.";
    }
}

mysqli_close($conexion);
?>


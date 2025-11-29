<?php
include("Conexion.php");


if (isset($_GET['id'])) {
    $id = $_GET['id'];

   
    $sql = "SELECT * FROM musica WHERE id = '$id'";
    $resultado = mysqli_query($conexion, $sql) or die(mysqli_error($conexion));

  
    if (mysqli_num_rows($resultado) > 0) {
        $fila = mysqli_fetch_assoc($resultado);
        $nombre = $fila['Nombre_Cancion'];
        $cancion = $fila['Nombre_Artista'];
        $album = $fila['Album'];
        $gen = $fila['Genero'];
        
    } else {
        echo "No se encontró el registro con el ID proporcionado.";
        exit; // Terminar la ejecución si no se encontró el registro
    }
} else {
    echo "ID de registro no especificado.";
    exit; // Terminar la ejecución si no se especificó el ID
}
mysqli_close($conexion);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Registro</title>
    <link rel="stylesheet" href="styles3.css"> 
    <script>
        function confirmarmod(event) {
            if (!confirm("¿Estás seguro de que deseas modificar?")) {
                event.preventDefault(); 
            }
        }
    </script>
</head>
<body>
<form name="formulario" id="formulario" action="modifica2.php" method="post">
    <center>
        <h1>Modificar </h1>
    </center>
    <hr>
    <center>
        Nombre de la cancion: <input type="text" id="Nombre" name="Nombre" placeholder="Nombre" size="20"
            value="<?php echo isset($nombre) ? $nombre : ''; ?>"><br><br>

        Nombre del artista: <input type="text" id="Nombre_a" name="Nombre_a" placeholder="Nombre del artista" size="15"
            value="<?php echo isset($cancion) ? $cancion : ''; ?>"><br><br>

        Album: <input type="text" id="Album" name="Album" placeholder="Album" size="15"
            value="<?php echo isset($album) ? $album : ''; ?>"><br><br>

        Genero: <input type="text" id="gen" name="gen" placeholder="Genero" size="15"
            value="<?php echo isset($gen) ? $gen : ''; ?>"><br><br>

      

        <input type="hidden" name="id" value="<?php echo $id; ?>"> <!-- Campo oculto para el id -->
        <input type="submit" id="guardar" name="guardar" value="Guardar">
    </center>
</form>

</body>
</html>
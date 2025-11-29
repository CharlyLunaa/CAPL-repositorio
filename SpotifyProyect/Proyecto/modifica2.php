    <?php
    include("Conexion.php");

    if (isset($_POST['guardar'])) {
        $id = $_POST['id']; 

        $Nombre = $_POST['Nombre'];
        $cancion = $_POST['Nombre_a'];
        $Al = $_POST['Album'];
        $gen = $_POST['gen'];
       

        $sql = "UPDATE musica SET Nombre_Cancion='$Nombre', Nombre_Artista='$cancion', Album='$Al', Genero='$gen' WHERE id='$id'";

        $sentencia = $conexion->query($sql);

        if ($sentencia) {
            echo 'Registro actualizado correctamente';
        } else {
            echo 'Error al actualizar el registro: ' . mysqli_error($conexion);
        }
    }

    mysqli_close($conexion);
    ?>


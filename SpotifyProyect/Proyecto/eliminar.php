        <?php
        include("conexion.php");


        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            $sql = "DELETE FROM musica WHERE id = '$id'";
            $resultado = $conexion->query($sql);

            if ($resultado) {
            
                header("Location: Playlist.php");
                exit; 
            } else {
                echo "Error al intentar eliminar el registro: " . $conexion->error;
            }
        } else {
            echo "ID de registro no especificado";
        }

        mysqli_close($conexion);
        ?>

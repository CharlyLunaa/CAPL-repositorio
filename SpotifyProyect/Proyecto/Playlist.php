<?php
include ("conexion.php");

// Función para limpiar y evitar XSS
function limpiar($datos)
{
    global $conexion; // Importante para utilizar la conexión global en la función
    $datos = htmlspecialchars($datos);
    $datos = stripslashes($datos);
    $datos = trim($datos);
    return mysqli_real_escape_string($conexion, $datos); // Asegurar la limpieza de datos para SQL
}

// Procesamiento del formulario de inserción de canciones
if (isset($_POST['insertar'])) {
    $Nombre = limpiar($_POST["nombre"]);
    $Nombre_Artista = limpiar($_POST["nombre_a"]);
    $Album = limpiar($_POST["al"]);
    $Genero = limpiar($_POST["gen"]);

    $sentencia = $conexion->prepare("INSERT INTO musica (Nombre_Cancion, Nombre_Artista, Album, Genero) VALUES (?, ?, ?, ?)");

    if ($sentencia === false) {
        die('Error al preparar la consulta: ' . $conexion->error);
    }

    $sentencia->bind_param("ssss", $Nombre, $Nombre_Artista, $Album, $Genero);
    $sentencia->execute();

    if ($sentencia->affected_rows >= 1) {
        echo "Canción agregada correctamente.";
    } else {
        echo "No se agregó la canción.";
    }

    $sentencia->close();
}

// Inicializar la variable $seguir
$seguir = '';

// Procesamiento del seguimiento del usuario
if (isset($_GET['correo'])) {
    $correo = limpiar($_GET['correo']);

    // Consulta para obtener el valor de 'seguir' del usuario con el correo dado
    $sql = "SELECT seguir FROM registro WHERE correo = '$correo'";
    $resultado = $conexion->query($sql);

    if ($resultado && $resultado->num_rows > 0) {
        $fila = $resultado->fetch_assoc();
        $seguir = $fila['seguir'];
    } else {
        echo "Error al obtener el estado de seguimiento del usuario.";
    }
}

// Procesamiento de la actualización de seguimiento
if (isset($_POST['actualizar_seguir'])) {
    $nuevoEstado = limpiar($_POST['nuevo_estado']);
    $correo = limpiar($_POST['correo']);

    $sql = "UPDATE registro SET seguir = '$nuevoEstado' WHERE correo = '$correo'";
    $resultado = $conexion->query($sql);

    if ($resultado) {
        $seguir = $nuevoEstado; // Actualizar el estado en la variable local
        echo ($nuevoEstado === 'si') ? 'Siguiendo' : 'Seguir'; // Devolver respuesta al cliente
        exit; // Terminar la ejecución del script después de enviar la respuesta
    } else {
        echo 'Error al actualizar el estado de seguimiento.';
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Playlist - Mi Música</title>
    <style>
        body {
            background: linear-gradient(to bottom, #3b0134, black);
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            color: white;
        }

        .encabezado {
            padding: 20px;
            background-color: black;
            color: white;
            text-align: center;
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
            color: green;
        }

        .barra {
            width: 250px;
            background-color: rgb(26, 26, 26);
            color: white;
            padding: 20px;
            position: fixed;
            top: 100px;
            left: 0;
            height: calc(100% - 80px);
            overflow-y: auto;
        }

        .contenedor {
            margin-top: 100px;
            margin-left: 270px;
            padding: 20px;
            margin-bottom: 500px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            padding: 40px;
            text-align: left;
        }

        th {
            background-color: #333;
            color: white;
        }

        .encabezado2 {
            background-image: url("relsbBarra.png");
            background-size: cover;
            background-position: center;
            width: 100%;
            height: 410px;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 20px;
        }

        .imagen {
            height: 85px;
            width: 85px;
        }

        .populares-header {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .populares-header h1 {
            margin: 0;
            padding: 10px;
        }

        .populares-header input[type="button"] {
            border: 2px solid white;
            border-radius: 15px;
            padding: 5px 10px;
            background-color: transparent;
            color: white;
            cursor: pointer;
            margin-left: 20px;
            font-size: 16px;
        }

        .populares-header input[type="button"]:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }

        .nombre-cancion {
            font-size: 16px;
            font-weight: bold;
        }

        .nombre-artista {
            font-size: 14px;
            color: #ccc;
        }

        .album {
            font-size: 16px;
            font-weight: bold;
        }

        .genero {
            font-size: 14px;
            color: #ccc;
        }

        .detalle {
            font-size: 13px;
            color: #999;
        }

        .eliminar {
            background: linear-gradient(to bottom, #ff4e4e, #1c1c1c);
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 5px;
            cursor: pointer;
            float: right;
            /* Alineación a la derecha */
            margin-top: 5px;
            /* Margen superior ajustado */
        }

        .eliminar:hover {
            background: linear-gradient(to bottom, #ff6666, #333333);
        }

        /* Estilo para el contenedor de cada canción en la lista */
        .cancion-en-lista {
            margin-bottom: 20px;
            /* Espacio entre cada canción */
            padding-bottom: 10px;
            /* Espacio al final de cada canción */
        }
    </style>
</head>

<body>
    <div class="encabezado">
        <h1>Spotify</h1>
    </div>

    <div class="barra" id="lista">
        <h2>Fila de reproducción</h2>
        <?php if (isset($_GET['sigue'])) {
            $user = $_GET['sigue'];
            echo "
                <ul>
                    <li><a class='eliminar' href='eliminar.php?user=$user'><p>Eliminar cuenta</p></a></li>
                    <li><a href='index.php'><p>Cerrar Sesión</p></a></li>
                </ul>";
        } ?>
    </div>

    <div class="contenedor">
        <div class="encabezado2"></div>
        <div class="populares-header">
            <h1>Populares</h1>
            <input type="button" class="seguir" id="seguir"
                value="<?php echo ($seguir == 'si') ? 'Siguiendo' : 'Seguir'; ?>"
                data-correo="<?php echo isset($_GET['correo']) ? htmlspecialchars($_GET['correo']) : ''; ?>">
        </div>
        <?php
        $contador = 0;
        $img = array(
            'nosabeigual.png',
            'AMI.png'
        );
        // Consulta para obtener todas las canciones
        $sql = "SELECT id, Nombre_Cancion, Nombre_Artista, Album, Genero FROM musica";
        $resultado = $conexion->query($sql);
        if ($resultado->num_rows > 0):
            ?>
            <table>
                <?php while ($consulta = $resultado->fetch_assoc()): ?>
                    <tr>
                        <td><img src="<?php echo $img[$contador]; ?>" class="imagen"></td>
                        <td>
                            <div class="nombre-cancion"><?php echo $consulta['Nombre_Cancion']; ?></div>
                            <div class="nombre-artista"><?php echo $consulta['Nombre_Artista']; ?></div>
                        </td>
                        <td>
                            <div class="album"><?php echo $consulta['Album']; ?></div>
                            <div class="genero">Género: <span class="detalle"><?php echo $consulta['Genero']; ?></span></div>
                        </td>
                        <td>
                            <a href="#" class="agregar" class="agregar-lista" <?php echo "data-imagen='" . htmlspecialchars($contador) .
                                "' data-nombre='" . htmlspecialchars($consulta['Nombre_Cancion']) . "' data-artista='" . htmlspecialchars($consulta['Nombre_Artista']) .
                                "' data-id='" . htmlspecialchars($consulta['id']) . "'"; ?>>
                                Agregar a la fila
                            </a>
                        </td>

                        <td><a href="modificar.php?id=<?php echo $consulta['id']; ?>">Modificar</a></td>
                        <td><a href="eliminar.php?id=<?php echo $consulta['id']; ?>"
                                onclick="return confirm('¿Estás seguro que deseas eliminar esta canción?');">Eliminar</a></td>
                    </tr>
                    <?php
                    $contador++; ?>
                <?php endwhile; ?>
            </table>
        <?php else: ?>
            <p>No se encontraron canciones.</p>
        <?php endif; ?>
    </div>

    <script>
        let imgA = ["nosabeigual.png", "AMI.png"];

        document.querySelectorAll('.agregar').forEach(button => {
            button.addEventListener('click', event => {
                const id = event.target.getAttribute('data-id');
                const imagen = event.target.getAttribute('data-imagen');
                const nombre = event.target.getAttribute('data-nombre');
                const artista = event.target.getAttribute('data-artista');

                const div = document.createElement('div');
                div.classList.add('cancion-en-lista');
                div.classList.add(`cancion-info-${id}`);
                div.innerHTML = `
                <img src="${imgA[imagen]}" class="imagen">
                <div class="nombre-cancion">${nombre}</div>
                <div class="nombre-artista">${artista}</div>
                <button class='eliminar' onclick="eliminar(${id});">Eliminar</button>
        `;

                document.getElementById('lista').appendChild(div);
            });
        });



        function eliminar(id) {
            let cancionEliminar = document.querySelector(`.cancion-info-${id}`); // Selector corregido
            if (cancionEliminar) {
                cancionEliminar.parentNode.removeChild(cancionEliminar);
            }
        }



        // Esperar a que el DOM esté completamente cargado antes de ejecutar el script
        document.addEventListener('DOMContentLoaded', function () {

            // Obtener el botón de seguimiento por su ID
            let seguirBtn = document.getElementById('seguir');

            // Agregar un evento de click al botón
            seguirBtn.addEventListener('click', function (event) {

                // Determinar el nuevo estado de seguimiento (si es 'Seguir' se cambia a 'si', y viceversa)
                let nuevoEstado = seguirBtn.value === 'Seguir' ? 'si' : 'no';

                // Obtener el correo del usuario desde el atributo 'data-correo' del botón
                let correo = seguirBtn.dataset.correo;

                // Crear una solicitud AJAX (XMLHttpRequest) para enviar los datos al servidor
                let xhr = new XMLHttpRequest();

                // Configurar la solicitud POST hacia el mismo script PHP que está generando esta página
                xhr.open('POST', '<?php echo $_SERVER['PHP_SELF']; ?>', true);

                // Establecer el encabezado de la solicitud para indicar que se envían datos codificados como formulario
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

                // Definir lo que sucede cuando la solicitud AJAX finaliza
                xhr.onload = function () {
                    if (xhr.status === 200) {//200 significa que true
                        // Actualizar el valor del botón con la respuesta del servidor (que debería ser 'Siguiendo' o 'Seguir')
                        seguirBtn.value = xhr.responseText.trim();
                    } else {
                        console.log('Error al actualizar el estado de seguir.'); // Mostrar un mensaje de error en la consola si falla la solicitud
                    }
                };
                // Enviar la solicitud con los datos necesarios codificados como formulario
                xhr.send('actualizar_seguir=true&correo=' + encodeURIComponent(correo) + '&nuevo_estado=' + encodeURIComponent(nuevoEstado));
            });
        });
    </script>


    <?php mysqli_close($conexion); ?>
</body>

</html>
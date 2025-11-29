    <?php
    include("conexion.php");
    ?>

    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Hospedaje</title>
        <link rel="stylesheet" href="styles.css"> 
    </head>
    <body>
        <div class="center">
            <br>
            <center>
                <h1>Hotel</h1>
            </center>
            <br>
            <br>

            
            <div class="insertar">
                <a href="Insertar.php" class="insertar"><img src="1.jpg" alt="Insertar"></a>
            </div>

            <?php
            $sql = "SELECT id, Nombre, Apellido_Paterno, Apellido_Materno, Edad, Noches_Pagadas, Habitacion FROM hotel";
            $resultado = $conexion->query($sql);

            if ($resultado->num_rows > 0) {
                echo "<table>";
                echo "<tr>";
                echo "<th>Nombre del cliente</th>";
                echo "<th>Apellido Paterno</th>";
                echo "<th>Apellido Materno</th>";
                echo "<th>Fecha de Nacimiento</th>";
                echo "<th>Noches Pagadas</th>";
                echo "<th>Habitacion</th>";
                echo "<th>Modificar</th>";
                echo "<th>Eliminar</th>";
                echo "</tr>";
                while ($consulta = $resultado->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $consulta['Nombre'] . "</td>";
                    echo "<td>" . $consulta['Apellido_Paterno'] . "</td>";
                    echo "<td>" . $consulta['Apellido_Materno'] . "</td>";
                    echo "<td>" . $consulta['Edad'] . "</td>";
                    echo "<td>" . $consulta['Noches_Pagadas'] . "</td>";
                    echo "<td>" . $consulta['Habitacion'] . "</td>";
                    
                
                    echo "<td><a href='modificar.php?id=" . $consulta['id'] . "' class='modificar'><img src='descarga.jpg' alt='Modificar'></a></td>";
                    
            
                    echo "<td><a href='eliminar.php?id=" . $consulta['id'] . "' class='eliminar' onclick=\"return confirm('¿Estás seguro que deseas eliminar este registro?');\"><img src='descarga.png' alt='Eliminar'></a></td>";
                    
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "No se encontraron resultados.";
            }
            mysqli_close($conexion);
            ?>
        </div>
    </body>
    </html>




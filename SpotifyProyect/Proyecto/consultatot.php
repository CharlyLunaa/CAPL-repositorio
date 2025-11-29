<?php
include("conexion.php");
echo "<br>";
echo"Consulta Total";
echo "<br>";
$sql="SELECT *FROM alumnos";
$resultado=$conexion->query($sql);
echo "<center>";
    if($resultado->num_rows){
        echo "<table border='1'>";
        echo "<tr>";
        echo "<th>Numero de control</th>";
        echo "<th>Nombre</th>";
        echo "<th>Apellido Paterno</th>";
        echo "<th>Apellido Materno</th>";
        echo "<th>Especialidad</th>";
        echo "</tr>";
        while($consulta=($resultado->fetch_assoc())){
            echo "<tr>";
        echo "<td>" . $consulta['Num_cont'] . "</td>";
        echo "<td>" . $consulta['Nombre'] . "</td>";
        echo "<td>" . $consulta['Ape_Pat'] . "</td>";
        echo "<td>" . $consulta['Ape_Mat'] . "</td>";
        echo "<td>" . $consulta['Especialidad'] . "</td>";
        echo "</tr>";
        
            


        }
        echo "</table>";
    }
    echo "</center>";
    mysqli_close($conexion)


?>

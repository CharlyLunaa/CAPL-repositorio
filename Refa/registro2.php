<?php
include ("Conexion.php");

if (isset($_POST['guardar'])) {
    if (
        isset($_POST['noparte'])
        && isset($_POST['descipcion'])
        && isset($_POST['marca'])
        && isset($_POST['ubicacion'])
        && isset($_POST['precio'])
        && isset($_POST['existencia'])
        && isset($_POST['entrada'])
        && isset($_POST['salida'])
        && isset($_POST['costo'])
    ) {
        $noparte = $_POST["noparte"];
        $descipcion = $_POST["descipcion"];
        $marca = $_POST["marca"];
        $ubicacion = $_POST["ubicacion"];
        $precio = $_POST["precio"];
        $existencia = $_POST["existencia"];
        $entrada = $_POST["entrada"];
        $salida = $_POST["salida"];
        $costo = $_POST["costo"];
        $total = ($precio * $existencia) + ($entrada - $salida) * $costo;
        $MA = "";
        if ($total > $costo) {
            $MA = "A"; // Ganancia
        } elseif ($total < $costo) {
            $MA = "D"; // Pérdida
        } else {
            $MA = "B"; // Equilibrio
        }

        $sentencia = $conexion->prepare("INSERT INTO inventario(`no.parte` , descipcion , marca , 
    ubicacion , precio , existencia , entrada , salida , costo , total , `M.A`) 
    VALUES ('$noparte' , '$descipcion' , '$marca' , '$ubicacion' ,'$precio','$existencia' , '$entrada' , '$salida' , '$costo' ,'$total','$MA')");


        $sentencia->execute();

        if ($conexion->affected_rows >= 1) {
            echo 'Filas Agregadas: ' . $conexion->affected_rows;

            header("Location: CRUD.php");
            exit();
        } else {
            echo 'No se Agrego ninguna fila';
        }
    }
} else {
    echo "incorrecto";
}
mysqli_close($conexion);

?>
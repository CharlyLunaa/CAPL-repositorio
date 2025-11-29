<?php
include ("Conexion.php");

if (isset($_POST['guardar'])) {
    $id = $_POST['id'];
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

    $sql = "UPDATE inventario SET `no.parte`='" . $noparte . "', descipcion='" . $descipcion . "', marca='" . $marca . "', ubicacion='" . $ubicacion . "', precio='" . $precio .
        "', existencia='" . $existencia . "', entrada='" . $entrada . "', salida='" . $salida . "', costo='" . $costo . "', total='" . $total . "', `M.A`='" .
        $MA . "' WHERE id='" . $id . "'";

    $sentencia = $conexion->query($sql);

    if ($sentencia) {
        echo 'Filas Modificadas';

        header("Location: CRUD.php");
        //exit();
    } else {
        echo 'No se modificó ninguna fila';
    }
}

mysqli_close($conexion);
?>
<?php
include ("Conexion.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $consulta = ConsultaProductos($conexion, $id);
}

function ConsultaProductos($con, $n_p)
{
    $sql = "SELECT * FROM inventario WHERE (id = '" . $n_p . "')";
    $resultado = mysqli_query($con, $sql) or die(mysqli_error());

    $filas = mysqli_fetch_array($resultado);

    return [
        $filas["id"],
        $filas["no.parte"],
        $filas["descipcion"],
        $filas["marca"],
        $filas["ubicacion"],
        $filas["precio"],
        $filas["existencia"],
        $filas["entrada"],
        $filas["salida"],
        $filas["costo"]
    ];
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Datos BD Escuela</title>
    <style>
        body {
            background-color: rgb(63, 51, 34);
            color: rgb(221, 151, 151);
        }

        #id {
            background-color: #f2f2f2;
            pointer-events: none;
        }
        img{
            display: none;
        }

    </style>
</head>

<body>
    <div>
        <form name="formulario" id="formulario" action="modifica2.php" method="post">
            <b>
                <center>
                    <h1>Modificar datos</h1>
                </center>
            </b>
            <hr>
            <br><br>
            <label for="id">Id: </label>
            <input type="text" id="id" name="id" placeholder="Id" size="20" required
                value="<?php echo $consulta[0] ?>">
            <br><br>
            <label for="noparte">No.parte </label>
            <input type="text" id="noparte" name="noparte" placeholder="No.parte" size="20" required
                value="<?php echo $consulta[1] ?>">
            <br><br>
            <label for="descipcion" class="cartel-textarea">Descripción</label>
            <textarea id="descipcion" name="descipcion" placeholder="Descripción" cols="50" rows="1" required><?php echo $consulta[2] ?></textarea>
            <br><br>
            <label for="marca">Marca: </label>
            <input type="text" id="marca" name="marca" placeholder="Marca" size="15" required value="<?php echo $consulta[3] ?>">
            <br><br>
            <label for="ubicacion">Ubicacion: </label>
            <input type="text" id="ubicacion" name="ubicacion" placeholder="Ubicacion" size="15" required
                value="<?php echo $consulta[4] ?>">
            <br><br>
            <label for="precio">Precio: </label>
            <input type="text" id="precio" name="precio" placeholder="Precio" size="15" required
                value="<?php echo $consulta[5] ?>">
            <br><br>
            <label for="existencia">Existencia: </label>
            <input type="text" id="existencia" name="existencia" placeholder="Existencia" size="20" required
                value="<?php echo $consulta[6] ?>">
            <br><br>
            <label for="entrada">Entrada: </label>
            <input type="text" id="entrada" name="entrada" placeholder="Entrada" size="20" required
                value="<?php echo $consulta[7] ?>">
            <br><br>
            <label for="salida">Salida: </label>
            <input type="text" id="salida" name="salida" placeholder="Salida" size="15" required
                value="<?php echo $consulta[8] ?>">
            <br><br>
            <label for="costo">Costo: </label>
            <input type="text" id="costo" name="costo" placeholder="Costo" size="15" required value="<?php echo $consulta[9] ?>"> 
            <br><br>
            <input type="submit" id="guardar" name="guardar" value="Guardar Registro">
            <input type="button" onclick="salir();" value="Regresar">
            <center>
                <p>Autor: Carlos Adolfo Perez Luna</p>
            </center>
            <script src="modificaralert.js"></script>
        </form>
    </div>
</body>

</html>
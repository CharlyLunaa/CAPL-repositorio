<!DOCTYPE html>
<html lang="es">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Refaccionaria Percal</title>
<link rel="stylesheet" href="disenoCRUD.css">
<style>
    .agre {
        color: burlywood;
    }

    .agre:hover {
        padding: 5px 5px 5px 5px;
        border: 5px solid burlywood;
        background-color: darkgray;
        text-decoration: none;
    }

    .borrar {
        color: red;
    }

    .borrar:hover {
        padding: 5px;
        border: 5px solid yellow;
        background-color: yellowgreen;
    }

    .mod {
        color: blue;
    }

    .mod:hover {
        padding: 5px;
        border: 5px solid gray;
        background-color: grey;
    }

    .registro {
        font-size: 15px;
    }

    body {
        background-color: rgb(105, 105, 105);
        color: black;
    }

    .tabla {
        border-collapse: collapse;
        border-spacing: 10px;
        table-layout: fixed;
        width: 1650px;
        border: 5px black;
        margin-left: auto;
        margin-right: auto;
        text-align: center;
        border-collapse: separate;
        caption-side: top;
    }

    .encabezado {
        height: 100px;
        background-color: rgb(11, 31, 11);
        font-size: 19px;
        font-family: Arial, Helvetica, sans-serif;
        border: groove 6px black;
    }

    .cuerpo {
        height: 70px;
        background-color: green;
        height: 200px;
    }

    .boton {
        width: 1650px;
        margin: 5px auto;
        text-align: center;
    }

    .agregar {
        background-color: rgb(11, 31, 11);
        width: 100%;
        height: 40px;
        border: 2px solid rgb(221, 151, 151);
        font-size: 18px;
        font-family: Arial, Helvetica, sans-serif;
    }

    .buscador {
        text-align: right;
        margin: 5px auto;
        width: 1000px;
    }

    .buscador form {
        display: inline-block;
    }
</style>
</head>

<body>
    <center>
        <h1>Inventario Refaccionaria Percal</h1>
        <hr><br>
    </center>
    <div class='buscador'>
        <form name="formulario" id="formulario" action="consulta.php" method="post">
            <label for="consulta">Buscar: </label>
            <input type="text" id="consulta" name="consulta" placeholder="No.parte" size="20" required>
            <input type="submit" id="aceptar" name="aceptar" value="Buscar">
            <input type="reset" id="aceptar" name="aceptar" value="Limpiar">
        </form>
    </div>
    <?php
    include ("Conexion.php"); ?>
    <div class="registro">Si desea agregar 1 producto de click en: <a href="registro.html"
            class="agre">Agreagar</a><br><br></div>
            <div class="registro">Si desea regresar de click en: <a href="index.php"
            class="agre">Regresar</a><br><br></div>
    <?php

    $sql = "SELECT * FROM inventario";
    $resultado = $conexion->query($sql);
    echo "<form name='formulario' id='formulario' method='post'>";
    if ($resultado->num_rows > 0) {
        echo "<table border='1' class='tabla'>";
        echo "<tr class='encabezado'>
            <th>Id</th>
            <th>No.parte</th>
            <th>Descipcion</th>
            <th>Marca</th>
            <th>Ubicacion</th>
            <th>Precio</th>
            <th>Existencia</th>
            <th>Entrada</th>
            <th>Salida</th>
            <th>Costo</th>
            <th>Total</th>
            <th>M.A</th>
            <th>Operaciones</th>
          </tr>";

        while ($consulta = $resultado->fetch_assoc()) {
            $formato_precio = number_format($consulta['precio'], 2, '.', ',');
            $formato_costo = number_format($consulta['costo'], 2, '.', ',');
            $formato_total = number_format($consulta['total'], 2, '.', ',');

            echo "<tr class='cuerpo'>
                <td>" . $consulta['id'] . "</td>
                <td>" . $consulta['no.parte'] . "</td>
                <td>" . $consulta['descipcion'] . "</td>
                <td>" . $consulta['marca'] . "</td>
                <td>" . $consulta['ubicacion'] . "</td>
                <td>$$formato_precio</td>
                <td>" . $consulta['existencia'] . "</td>
                <td>" . $consulta['entrada'] . "</td>
                <td>" . $consulta['salida'] . "</td>
                <td>$$formato_costo</td>
                <td>$$formato_total</td>
                <td>" . $consulta['M.A'] . "</td>
                <td> 
                <a href='eliminar.php?id=" . $consulta['id'] . "' class='link borrar'>Eliminar</a><br><br>
                <a href='modificar.php?id=" . $consulta['id'] . "' class='link mod' id='link'>Modificar</a>
            </td>
              </tr>";
        }
        echo "</table>";
        echo "</form>";
        echo "<div class='boton'><form action='registro.html'method='post'>
        <input type='submit' id='enviar' name='enviar' class='agregar' value='Agregar(+)'></div>";

    } else {
        echo "No existe la base de datos";
    }
    $conexion->close();
    ?>
    <script src="eliminaralert.js"></script>
</body>

</html>
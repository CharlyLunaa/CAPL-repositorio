<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            background-color: rgb(30, 28, 10);
            color: white;
        }

        .productos {
            margin-top: 20px;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
        }

        .producto {
            width: 30%;
            margin: 10px;
            padding: 10px;
            border: groove 6px black;
            background-color: rgb(15, 20, 10);
            text-align: center;
            box-sizing: border-box;
        }

        .producto img {
            width: 100%;
            height: auto;
            max-width: 120px;
            max-height: 120px;
            display: block;
            margin: 0 auto 10px;
        }

        .header-container {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .header-container h1 {
            margin-left: 20px;
        }

        #comprar {
            background-color: whitesmoke;
            color: black;
            border: none;
            padding: 10px 20px;
            text-align: center;
            font-size: 16px;
            margin-top: 10px;
            cursor: pointer;
            border-radius: 5px;
        }

        #comprar:hover {
            background-color: #49480d;
            color: white;
        }
    </style>
</head>
<?php
session_start();

if (isset($_SESSION['user'])) {
    $usuario = $_SESSION['user'];
    if ($usuario == "admin") {
        echo "<a href='modificarUSER.php?user=$usuario'><img src='logo.jpg' width='30' height='30'></a> | <a href='CRUD.php'><img src='BD.jpg' width='30' height='30'></a> | Bienvenido, $usuario";
    } else {
        echo "<a href='modificarUSER.php?user=$usuario'><img src='logo.jpg' width='30' height='30'></a> | Bienvenido, $usuario";
    }
    $SesionAct = true;
} else {
    echo "<a href='registroUSER.html'>Regístrate</a> / <a href='usuario.html'>Iniciar sesión</a>";
    $SesionAct = false;
}
?>

<body>
    <div class="panel" id="panel"></div>
    <div class="header-container">
        <?php include ("Conexion.php"); ?>
        <h1>Refaccionaria Percal</h1>
    </div>
    <hr>
</body>
<?php

$imagenes = array(
    'img1.jpg',
    'img2.jpg',
    'img4.jpg',
    'img5.jpg'
);
$numIMG = 0;
$sql = "SELECT * FROM inventario";
$resultado = $conexion->query($sql);
echo "<form name='formulario' id='formulario' method='post'>";
if ($resultado->num_rows > 0) {
    echo "<section class='productos'>";
    while ($consulta = $resultado->fetch_assoc()) {

        $formato_precio = number_format($consulta['precio'], 2, '.', ',');

        echo "<div class='producto'>
            <img src='$imagenes[$numIMG]' class='logo' alt='Imagen Refaccionaria Percal' width='120' height='120'>
                <p>No.parte: " . $consulta['no.parte'] . "</p>
                <p>Descripcion: " . $consulta['descipcion'] . "</p>
                <p>Marca: " . $consulta['marca'] . "</p>
                <p>Precio: $$formato_precio</p>
                <p>Cantidad: " . $consulta['existencia'] . "</p>";
        if ($SesionAct) {
            echo "<input type='submit' id='comprar' name='comprar' class='comprar conUSER' value='Comprar'></div>";
        } else {
            echo "<input type='submit' id='comprar' name='comprar' class='comprar sinUSER' value='Comprar'></div>";
        }
        $numIMG++;
    }
    echo "</section>";

} else {
    echo "No existe la base de datos";
}
$conexion->close();
?>
<script scr="alertUser.js">
    document.querySelectorAll('.sinUSER').forEach(link => {
        link.addEventListener('click', event => {
            alert("Inicie sesion");
            event.preventDefault();
        });
    });

    document.querySelectorAll('.conUSER').forEach(link => {
        link.addEventListener('click', event => {
            alert("Producto comprado");
        });
    });
</script>

</html>
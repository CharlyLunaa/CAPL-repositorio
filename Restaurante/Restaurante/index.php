<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gastronomía Beto West</title>
    <style>
        body {
            background-color: burlywood;
            color: black;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .encabezado {
            padding: 20px;
            background-color: bisque;
            text-align: center;
        }

        .encabezado h1 {
            margin: 0;
        }

        .productos {
            background-color: wheat;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            padding: 20px;
            width: 1000px;
            margin: auto;
        }

        .producto {
            background-color: white;
            border: 2px solid black;
            border-radius: 10px;
            width: 30%;
            margin: 10px;
            padding: 20px;
            text-align: center;
        }

        .producto img {
            width: 100%;
            height: auto;
            object-fit: cover;
            border-radius: 10px;
            margin-bottom: 15px;
        }

        .producto p {
            margin: 10px 0;
        }

        button {
            background-color: whitesmoke;
            border: none;
            color: black;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 10px 0;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .Sincomprar {
            background-color: gray;
            border: none;
            color: black;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 10px 0;
            cursor: pointer;
            border-radius: 5px;
        }

        .comprar:hover {
            background-color: wheat;
        }
        #FinalizarCompra:hover {
            background-color: wheat;
        }

        .carrito {
            background-color: white;
            border: 2px solid black;
            border-radius: 10px;
            width: 90%;
            margin: 20px auto;
            padding: 20px;
            box-sizing: border-box;
        }

        h2 {
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="encabezado">
        <h1>Gastronomía Beto West</h1>
    </div>

    <div id="menu">
        <?php
        include("Conexion.php");

        $imagenes = array(
            'foto1.jpg',
            'foto2.jpg',
            'foto3.jpg',
            'foto4.jpg'
        );

        $sql = "SELECT * FROM menu";
        $resultado = $conexion->query($sql);
        echo "<form name='formulario' id='formulario' method='post'>";
        if ($resultado->num_rows > 0) {
            echo "<h2>Menú</h2><hr><section class='productos'>";
            $contador1 = 0;
            while ($consulta = $resultado->fetch_assoc()) {
                $formato_precio = number_format($consulta['precio'], 2, '.', ',');

                echo "<div class='producto'>
                        <img src='$imagenes[$contador1]' class='logo'>
                        <p><strong>Platillo:</strong> " . $consulta['platillo'] . "</p>
                        <p><strong>Descripción:</strong> " . $consulta['descripcion'] . "</p>
                        <p><strong>Precio:</strong> $$formato_precio</p>
                        <p><strong>Tipo:</strong> " . $consulta['tipo'] . "</p>";
                if (isset($_GET['nombre'])) {
                    echo "<button type='button' class='comprar' data-platillo='" . $consulta['platillo'] . "' data-precio='$formato_precio'>Comprar</button></div>";
                } else {
                    echo "<button type='button' class='Sincomprar'>Comprar</button></div>";
                }
                $contador1++;
            }
            echo "</section>";
        } else {
            echo "No existe la base de datos";
        }
        echo "</form>";
        $conexion->close();
        ?>
    </div>
    
        <div class="carrito" id="carrito">
            <h2>Carrito de Compras</h2>
            <?php if (isset($_GET['nombre'])) {
                $nombre = $_GET['nombre'];
                echo "Usuario : $nombre /
                <a id='SalirCuenta' href='index.php'>Cerrar Sesion</a> / 
                <a id='eliminaCuenta' href='eliminar.php?nombre=$nombre'>Eliminar Usuario</a>
                ";
            } ?>

            <ul id="carrito-items"></ul>
            <p>Total: $<span id="total">0.00</span></p>
            <button type="submit" id="FinalizarCompra">Finalizar Compra</button>
        </div>

    <script>

        let total = 0;

        document.querySelectorAll('.Sincomprar').forEach(button => {
            button.addEventListener('click', () => {
                window.location.href = "usuarioRegistro.html";
            });
        });

        document.querySelectorAll('.comprar').forEach(button => {
            button.addEventListener('click', event => {
                const platillo = event.target.getAttribute('data-platillo');
                const precio = parseFloat(event.target.getAttribute('data-precio'));

                total += precio;

                const li = document.createElement('li');
                li.textContent = `${platillo} - $${precio.toFixed(2)}`;
                document.getElementById('carrito-items').appendChild(li);

                document.getElementById('total').textContent = total.toFixed(2);
            });
        });

        document.getElementById('FinalizarCompra').addEventListener('click', () => {
                alert("Gracias por su compra");
        });
        document.querySelectorAll('#eliminaCuenta').forEach(link => {
            link.addEventListener('click', event => {
                var confirmacion = confirm("¿Está seguro?");
                if (!confirmacion) {
                    event.preventDefault();
                }
            });
        });
        document.querySelectorAll('#SalirCuenta').forEach(link => {
            link.addEventListener('click', event => {
                var confirmacion = confirm("¿Está seguro?");
                if (!confirmacion) {
                    event.preventDefault();
                }
            });
        });
    </script>
</body>

</html>

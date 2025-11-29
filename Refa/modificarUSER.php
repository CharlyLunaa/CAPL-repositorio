<style>
    img {
        display: none;
    }
</style>
<?php
include ("Conexion.php");

session_start();

if (isset($_SESSION['user'])) {
    $usuario = $_SESSION['user'];
    $consulta = ConsultaProductos($conexion, $usuario);
}

function ConsultaProductos($con, $n_p)
{
    $sql = "SELECT * FROM usuarios WHERE (user = '" . $n_p . "')";
    $resultado = mysqli_query($con, $sql) or die(mysqli_error());

    $filas = mysqli_fetch_array($resultado);

    return [
        $filas["id"],
        $filas["nombre"],
        $filas["user"],
        $filas["edad"],
        $filas["correo"],
        $filas["pass"],
        $filas["direccion"]
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
            background-color: rgb(30, 28, 10);
            color: rgb(221, 151, 151);
        }

        #id {
            background-color: #f2f2f2;
            pointer-events: none;
        }

        div {
            padding: 20px 10px;
            text-align: center;
            margin: 10px 0;
            font-family: Arial cursive;
            background-color: rgb(36, 36, 36);
            font-size: 20px;
            color: wheat;
        }

        p {
            color: blue;
        }

        .errores {
            color: red;
        }
    </style>
</head>

<body>
    <b>
        <center>
            <h1>Configuracion</h1>
        </center>
    </b>
    <hr>
    <div>
        <p>Modificar datos</p>
        <form name="formulario" id="formulario" action="modificar2USER.php" method="post">
            <label for="id">Id: </label>
            <input type="text" id="id" name="id" placeholder="Nombre" size="20" value="<?php echo $consulta[0] ?>">
            <br><br>
            <label for="nombre">Nombre: </label>
            <input type="text" id="name" name="nombre" placeholder="Nombre" size="20"
                value="<?php echo $consulta[1] ?>">
            <p class="errores" id="errores1"></p>
            <br><br>
            <label for="user">User: </label>
            <input type="text" <?php if ($consulta[2] == "admin") {
                echo "id ='id' id ='user'";
            } else {
                echo "id ='user'";
            } ?>
                name="user" placeholder="User" size="15" value="<?php echo $consulta[2] ?>">
            <p class="errores" id="errores2"></p>
            <br><br>
            <label for="edad">Edad: </label>
            <input type="text" id="edad" name="edad" placeholder="Edad" size="15" value="<?php echo $consulta[3] ?>">
            <p class="errores" id="errores3"></p>
            <br><br>
            <label for="correo">Correo: </label>
            <input type="text" id="email" name="correo" placeholder="Correo" size="15"
                value="<?php echo $consulta[4] ?>">
            <p class="errores" id="errores4"></p>
            <br><br>
            <label for="pass">Contraseña: </label>
            <input type="text" id="pass" name="pass" placeholder="pass" size="15" value="<?php echo $consulta[5] ?>">
            <p class="errores" id="errores5"></p>
            <br><br>
            <label for="dire">Direccion: </label>
            <input type="text" id="dire" name="dire" placeholder="dire" size="20" value="<?php echo $consulta[6] ?>">
            <p class="errores" id="errores6"></p>
            <br><br>
            <input type="submit" id="guardar" name="guardar" value="Guardar Registro">
            <input type="button" onclick="salir();" value="Regresar">
        </form>
    </div>
    <section>
        <div>
            <a class="borrar" href="eliminarUSER.php?id=<?php echo $consulta[0] ?>">
                <p1>eliminar cuenta</p1>
            </a>
        </div>
        <div>
            <a href="logout.php ">
                <p1>cerrar sesion</p1>
            </a>
        </div>
    </section>
    <script>
        function salir() {
            window.location.href = "index.php";
            mysqli_close($conexion);
        }
        document.querySelectorAll('.borrar').forEach(link => {
            link.addEventListener('click', event => {
                var confirmacion = confirm("¿Está seguro de eliminar este elemento?");
                if (!confirmacion) {
                    event.preventDefault();
                }
            });
        });
        const form = document.getElementById("formulario");

        const parrafo1 = document.getElementById("errores1");
        const parrafo2 = document.getElementById("errores2");
        const parrafo3 = document.getElementById("errores3");
        const parrafo4 = document.getElementById("errores4");
        const parrafo5 = document.getElementById("errores5");
        const parrafo6 = document.getElementById("errores6");

        // Datos
        const nombre = document.getElementById("name");
        const user = document.getElementById("user");
        const edad = document.getElementById("edad");
        const email = document.getElementById("email");
        const pass = document.getElementById("pass");
        const dire = document.getElementById("dire");

        // Validaciones
        form.addEventListener("submit", evento => {
            const ValLargo = /^(([^<>()\[\]\\.,;:\s@”]+(\.[^<>()\[\]\\.,;:\s@”]+)*)|(“.+”))@((\[[0–9]{1,3}\.[0–9]{1,3}\.[0–9]{1,3}\.[0–9]{1,3}])|(([a-zA-Z\-0–9]+\.)+[a-zA-Z]{2,}))$/;
            const contraVal = /^(?=.*\d)(?=.*[\u0021-\u002b\u003c-\u0040])(?=.*[A-Z])(?=.*[a-z])\S{8,16}$/;

            let errores1 = "";
            let errores2 = "";
            let errores3 = "";
            let errores4 = "";
            let errores5 = "";
            let errores6 = "";

            if (nombre.value.length < 3) {
                errores1 += "Minimo 3 caracteres de nombre<br>";
            } else if (nombre.value.length > 20) {
                errores1 += "Maximo 20 caracteres de nombre<br>";
            }

            if (user.value.length < 3) {
                errores2 += "Minimo 3 caracteres de nombre<br>";
            } else if (user.value.length > 20) {
                errores2 += "Maximo 20 caracteres de nombre<br>";
            }

            if (edad.value < 18) {
                errores3 += "Minimo 18 años<br>";
            } else if (edad.value > 25) {
                errores3 += "Maximo 25 años <br>";
            }

            if (!ValLargo.test(email.value)) {
                errores4 += "El correo es invalido<br>";
            }

            if (!contraVal.test(pass.value)) {
                errores5 += "La contraseña debe ser de 8 a 16 caracteres con minusculas, mayusculas y 1 digito";
            }

            if (dire.value.length < 10) {
                errores6 += "Minimo 10 caracteres<br>";
            } else if (dire.value.length > 50) {
                errores6 += "Maximo 50 caracteres<br>";
            }

            parrafo1.innerHTML = errores1;
            parrafo2.innerHTML = errores2;
            parrafo3.innerHTML = errores3;
            parrafo4.innerHTML = errores4;
            parrafo5.innerHTML = errores5;
            parrafo6.innerHTML = errores6;

            if (errores1 || errores2 || errores3 || errores4 || errores5 || errores6) {
                evento.preventDefault();
            }
            else {
                document.getElementById('formulario').addEventListener("submit", evento => {
                    var confirmacion = confirm("¿Está seguro de modificar los elementos?");
                    if (!confirmacion) {
                        evento.preventDefault();
                    }
                });
            }
        }); 
    </script>
</body>

</html>
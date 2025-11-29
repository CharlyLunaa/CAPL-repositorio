<?php
$conexion = new mysqli('localhost', 'root', '', 'refaccionaria');

if ($conexion->connect_errno) {
    die('Lo siento hubo un problema con el servidor');
} else {
    echo "<img src='imgRefa.jpg' class='logo' alt='Imagen Refaccionaria Percal' width='120' height='120'>";
}
?>

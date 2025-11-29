<?php
$conexion = new mysqli('localhost', 'root', '', 'restaurante');

if ($conexion->connect_errno) {
    die('Lo siento hubo un problema con el servidor');
}
?>
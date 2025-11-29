<?php
// Configuración de la conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "musica";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['Name'];
    $correo = $_POST['Correo'];
    $contrasena = password_hash($_POST['Contra'], PASSWORD_DEFAULT); // Encriptar la contraseña
    $seguir = 'no';

    // Insertar datos en la base de datos
    $sql = "INSERT INTO registro (Nombre, Correo, Contraseña, seguir) VALUES (?, ?, ?, ?)";

    // Usar prepared statements para prevenir SQL injection
    $stmt = $conn->prepare($sql);

    // Verificar si la preparación de la consulta fue exitosa
    if ($stmt === false) {
        die('Error al preparar la consulta: ' . $conn->error);
    }

    // Enlazar parámetros a la consulta preparada
    $stmt->bind_param("ssss", $nombre, $correo, $contrasena, $seguir);

    // Ejecutar la consulta
    if ($stmt->execute() === TRUE) {
        // Redirigir después de la inserción exitosa
        header("Location: Playlist.php?correo=$correo");
        exit(); // Asegurar que el script se detenga después de la redirección
    } else {
        echo "Error: " . $stmt->error;
    }

    // Cerrar la consulta preparada
    $stmt->close();
}

// Cerrar la conexión a la base de datos
$conn->close();
?>

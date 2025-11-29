<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "musica";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = $_POST['Correo'];
    $contrasena = trim($_POST['Seña']); // Asegúrate de eliminar espacios en blanco

    // Depuración: Mostrar datos recibidos del formulario
    var_dump($_POST); // Verifica los datos recibidos del formulario

    $sql = "SELECT id, Contraseña FROM registro WHERE Correo=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $correo);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $hashed_password = $row['Contraseña'];

        // Depuración: Mostrar la contraseña ingresada y el hash almacenado
        echo "Contraseña ingresada: " . $contrasena . "<br>";
        echo "Contraseña hash almacenada: " . $hashed_password . "<br>";

        if (password_verify($contrasena, $hashed_password)) {
            echo "<script>alert('Inicio de sesión exitoso'); window.location.href='Inicio.html';</script>";
        } else {
            header("Location: Playlist.php?correo=$correo");
        }
    } else {
        echo "<script>alert('Usuario no encontrado'); window.location.href='sesion.html';</script>";
    }
} 

$conn->close();
?>

document.querySelectorAll('.regresar').forEach(link => {
    link.addEventListener('click', event => {
        window.location.href = "CRUD.php";
        mysqli_close($conexion);
    });
});
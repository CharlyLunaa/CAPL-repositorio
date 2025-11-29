document.getElementById('formulario').addEventListener("submit", evento => {
    var confirmacion = confirm("¿Está seguro de modificar los elementos?");
    if (!confirmacion) {
        evento.preventDefault();
    }
});

function salir(){
    window.location.href = "CRUD.php";
    mysqli_close($conexion); 
}
document.querySelectorAll('.borrar').forEach(link => {
    link.addEventListener('click', event => {
        var confirmacion = confirm("¿Está seguro de eliminar este elemento?");
        if (!confirmacion) {
            event.preventDefault();
        }
    });
});

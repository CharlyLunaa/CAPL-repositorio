document.addEventListener("DOMContentLoaded", function() {
    const Form = document.getElementById("Form");
    const submitButton = document.getElementById("submitButton");

    const errorName = document.getElementById("errorName");
    const errorCorreo = document.getElementById("errorCorreo");
    const errorContra = document.getElementById("errorContra");
    const errorTerminos = document.getElementById("errorTerminos");

    Form.addEventListener("submit", function(e) {
        e.preventDefault();

        // Limpiar mensajes de error anteriores
        errorName.textContent = "";
        errorCorreo.textContent = "";
        errorContra.textContent = "";
        errorTerminos.textContent = "";

        let valid = true;
        let valcorreo = /\S+@\S+\.\S+/;
        let valcontra = /^(?=\w*\d)(?=\w*[A-Z])(?=\w*[a-z])\S{8,16}$/;

        const Nombre = document.getElementById("Name");
        const Correo = document.getElementById("Correo");
        const Contra = document.getElementById("Contra");
        const Terminos = document.getElementById("terminos");

        if (Nombre.value.length < 3 || Nombre.value.length > 25) {
            errorName.textContent = "El nombre debe tener entre 3 y 25 caracteres";
            valid = false;
        }

        if (!valcorreo.test(Correo.value)) {
            errorCorreo.textContent = "El correo no es válido";
            valid = false;
        }

        if (!valcontra.test(Contra.value)) {
            errorContra.textContent = "Contraseña no válida. Utiliza de 8 a 16 caracteres con mayúsculas, minúsculas y un dígito.";
            valid = false;
        }

        if (!Terminos.checked) {
            errorTerminos.textContent = "Debes aceptar los términos y condiciones";
            valid = false;
        }

        if (valid) {
            Form.submit();
        }
    });

    // Habilitar/deshabilitar el botón de submit basado en la validación de los campos
    Form.addEventListener("input", function() {
        // Limpiar mensajes de error anteriores
        errorName.textContent = "";
        errorCorreo.textContent = "";
        errorContra.textContent = "";
        errorTerminos.textContent = "";

        let valid = true;
        let valcorreo = /\S+@\S+\.\S+/;
        let valcontra = /^(?=\w*\d)(?=\w*[A-Z])(?=\w*[a-z])\S{8,16}$/;

        const Nombre = document.getElementById("Name");
        const Correo = document.getElementById("Correo");
        const Contra = document.getElementById("Contra");
        const Terminos = document.getElementById("terminos");

        if (Nombre.value.length < 3 || Nombre.value.length > 25) {
            errorName.textContent = "El nombre debe tener entre 3 y 25 caracteres";
            valid = false;
        }

        if (!valcorreo.test(Correo.value)) {
            errorCorreo.textContent = "El correo no es válido";
            valid = false;
        }

        if (!valcontra.test(Contra.value)) {
            errorContra.textContent = "Contraseña no válida. Utiliza de 8 a 16 caracteres con mayúsculas, minúsculas y un dígito.";
            valid = false;
        }

        if (!Terminos.checked) {
            errorTerminos.textContent = "Debes aceptar los términos y condiciones";
            valid = false;
        }

        submitButton.disabled = !valid;
    });
});

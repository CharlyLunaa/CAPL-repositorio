const form = document.getElementById("form");

const parrafo = document.getElementById("bien");
const parrafo1 = document.getElementById("errores1");
const parrafo2 = document.getElementById("errores2");
const parrafo3 = document.getElementById("errores3");
const parrafo4 = document.getElementById("errores4");
const parrafo5 = document.getElementById("errores5");
const parrafo6 = document.getElementById("errores6");


//Datos 
const nombre = document.getElementById("name");
const user = document.getElementById("user");
const edad = document.getElementById("edad");
const email = document.getElementById("email");
const pass = document.getElementById("pass");
const dire = document.getElementById("dire");
// Largo
form.addEventListener("submit", evento => {
    //evento.preventDefault()//Es para que no se envie el formulario

    var ValLargo = /^(([^<>()\[\]\\.,;:\s@”]+(\.[^<>()\[\]\\.,;:\s@”]+)*)|(“.+”))@((\[[0–9]{1,3}\.[0–9]{1,3}\.[0–9]{1,3}\.[0–9]{1,3}])|(([a-zA-Z\-0–9]+\.)+[a-zA-Z]{2,}))$/
    var contraVal = /^(?=.*\d)(?=.*[\u0021-\u002b\u003c-\u0040])(?=.*[A-Z])(?=.*[a-z])\S{8,16}$/
    
    let errores1 = "";
    let errores2 = "";
    let errores3 = "";
    let errores4 = "";
    let errores5 = "";
    let errores6 = "";

    let entrada1 = false;
    let entrada2 = false;
    let entrada3 = false;
    let entrada4 = false;
    let entrada5 = false;
    let entrada6 = false;

    if (nombre.value.length < 3) {
        errores1 += "Minimo 3 caracteres de nombre<br>";
        entrada1 = true;
    }
    else if (nombre.value.length > 20) {
        errores1 += "Maximo 20 caracteres de nombre<br>";
        entrada1 = true;
    }
    if (user.value.length < 3) {
        errores2 += "Minimo 3 caracteres de nombre<br>";
        entrada2 = true;
    }
    else if (user.value.length > 20) {
        errores2 += "Maximo 20 caracteres de nombre<br>";
        entrada2 = true;
    }

    if (edad.value < 18) {
        errores3 += "Minimo 18 años<br>";
        entrada3 = true;
    }
    else if (edad.value > 25) {
        errores3 += "Maximo 25 años <br>";
        entrada3 = true;
    }

    if (!ValLargo.test(email.value)) {
        errores4 += "El correo es invalido<br>";
        entrada4 = true;
    }
    if (!contraVal.test(pass.value)) {
        errores5 += "La contraseña debe ser de 8 a 16 caracteres con minusculas mayusculas y 1 digito";
        entrada5 = true;
    }
    if (dire.value.length < 10) {
        errores6 += "Minimo 10 caracteres de nombre<br>";
        entrada6 = true;
    }
    else if (dire.value.length > 50) {
        errores6 += "Maximo 50 caracteres de nombre<br>";
        entrada6 = true;
        
    }

    //Opcion 1 
    for (var i = 1; i <= 6; i++) {
        if (eval("entrada" + i)) {
            eval("(parrafo" + i + ").innerHTML = errores" + i);
            parrafo.innerHTML = "";
        } else {
            eval("(parrafo" + i + ").innerHTML = ''");
        }
    }
    if(entrada1 || entrada2 || entrada3 || entrada4 || entrada5 || entrada6){
        evento.preventDefault()
    }

    if(!entrada1 && !entrada2 && !entrada3 && !entrada4 && !entrada5 && !entrada6){
        parrafo.innerHTML = "Datos enviados";
    }
})
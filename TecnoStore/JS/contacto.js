var nameFlag = false;
var mailFlag = false;

var nombre = document.getElementById("Nombre");
var correo = document.getElementById("Correo");
var mensaje = document.getElementById("Mensaje");

function NameValidation(){
    var element = nombre;
    var expresion = /^[a-zA-Z]+(([´ ][a-zA-Z ])?[a-zA-Z]*)*$/.test(element.value);
    
    //Validacion
    if (expresion){
        element.style.backgroundColor = "rgba(86, 255, 86, 0.705)";
        element.style.border = " 1px solid #ccc";
        nameFlag = true;
    }else{
        element.style.backgroundColor = "white";
        element.style.border = "1px solid red";
        nameFlag = false;
    }

    if (mailFlag == true && nameFlag == true){
        document.getElementById('Mensaje').disabled = false;
    }
}

function MailValidation(){
    var element = correo;
    var expresion = /^[a-zA-Z0-9+_.-]+@[a-zA-Z0-9.-]+$/.test(element.value);

    //Validacion
    if (expresion){
        element.style.backgroundColor = "rgba(86, 255, 86, 0.705)";
        element.style.border = " 1px solid #ccc";
        var mailFlag = true;
    }else{
        element.style.backgroundColor = "white";
        element.style.border = "1px solid red";
        var mailFlag = false;
    }

    if (mailFlag == true && nameFlag == true){
        document.getElementById('Mensaje').disabled = false;
    }
}

function Clear(){
    nombre.value = "";
    correo.value = "";
    mensaje.value = "";

    nombre.removeAttribute('style');
    correo.removeAttribute('style');
    mensaje.removeAttribute('style');
}
var flag;
function Validar(){
    flag = "";
    NameValidation();
    AgeValidation();
    MailValidation();
    UserValidation();
    PassValidation();
    RepassValidation();

    if (flag=="111111"){
        document.getElementById("regForm").action = "Servicios/userReg.php";
        document.getElementById("regForm").submit();
    }
}

function NameValidation(){
    var element = document.getElementById("name");
    var label = document.getElementById("nameError");
    var expresion = /^[a-zA-Z]+(([´ ][a-zA-Z ])?[a-zA-Z]*)*$/.test(element.value);
    
    //Validacion
    if (expresion){
        element.style.backgroundColor = "rgba(86, 255, 86, 0.705)";
        element.style.border = " 1px solid #ccc";
        label.style.visibility = "hidden";
        flag += "1";
    }else{
        element.style.backgroundColor = "white";
        element.style.border = "1px solid red";
        label.style.visibility = "visible";
        flag += "0";
    }
}

function AgeValidation(){
    var element = document.getElementById("age");
    var label = document.getElementById("ageError");
    
    //Limites
    if (age.value < 1) {
        age.value = "1";
    } 
    else if (age.value > 100) {
        age.value = "100";
    }

    //Validacion
    if (age.value >= 18){
        element.style.backgroundColor = "rgba(86, 255, 86, 0.705)";
        element.style.border = " 1px solid #ccc";
        label.style.visibility = "hidden";
        flag += "1";
    }
    else{
        element.style.backgroundColor = "white";
        element.style.border = "1px solid red";
        label.style.visibility = "visible";
        flag += "0";
    }
}

function MailValidation(){
    var element = document.getElementById("mail");
    var label = document.getElementById("mailError");
    var expresion = /^[a-zA-Z0-9+_.-]+@[a-zA-Z0-9.-]+$/.test(element.value);

    //Validacion
    if (expresion){
        element.style.backgroundColor = "rgba(86, 255, 86, 0.705)";
        element.style.border = " 1px solid #ccc";
        label.style.visibility = "hidden";
        flag += "1";
    }else{
        element.style.backgroundColor = "white";
        element.style.border = "1px solid red";
        label.style.visibility = "visible";
        flag += "0";
    }
}

function UserValidation(){
    var element = document.getElementById("user");
    var label = document.getElementById("userError");
    var expresion = /^([a-zA-Z0-9$-Ñ]){5,}$/.test(element.value);

    //Validacion
    if (expresion){
        element.style.backgroundColor = "rgba(86, 255, 86, 0.705)";
        element.style.border = " 1px solid #ccc";
        label.style.visibility = "hidden";
        flag += "1";
    }else{
        element.style.backgroundColor = "white";
        element.style.border = "1px solid red";
        label.style.visibility = "visible";
        flag += "0";
    }
   
}

function PassValidation(){
    var element = document.getElementById("pass");
    var label = document.getElementById("passError");
    var expresion = /^(?=.*\d)(?=.*[!@#$%^&*-_ñÑ])(?=.*[a-z])(?=.*[A-Z]).{8,}$/.test(element.value);

    //Validacion
    if (expresion){
        element.style.backgroundColor = "rgba(86, 255, 86, 0.705)";
        element.style.border = " 1px solid #ccc";
        label.style.visibility = "hidden";
        flag += "1";
    }else{
        element.style.backgroundColor = "white";
        element.style.border = "1px solid red";
        label.style.visibility = "visible";
        flag += "0";
    }
}

function RepassValidation(){
    var element1 = document.getElementById("pass");
    var element2 = document.getElementById("repass");
    var label = document.getElementById("repassError");

    //Validacion
    if (element1.value == element2.value){
        element2.style.backgroundColor = "rgba(86, 255, 86, 0.705)";
        element2.style.border = " 1px solid #ccc";
        label.style.visibility = "hidden";
        flag += "1";
    }else{
        element2.style.backgroundColor = "white";
        element2.style.border = "1px solid red";
        label.style.visibility = "visible";
        flag += "0";
    }
}

function showHide(){
    const pass = document.getElementById("pass");
    const toggle = document.getElementById("toggle");

    if (pass.type === 'password'){
        pass.setAttribute('type', 'text');
        toggle.setAttribute('src', 'IMG/show.png');
        
    }
    else{
        pass.setAttribute('type', 'password');
        toggle.setAttribute('src', 'IMG/hide.png');
    }
}

function Send(){
    alert('hola');
}


function thisClear(x){
    var name = x.id;

    x.removeAttribute('style');

    document.getElementById(name+"Error").style.visibility = "hidden";

}

function Clear(){
    //Boxes
    document.getElementById("name").removeAttribute('style');
    document.getElementById("user").removeAttribute('style');
    document.getElementById("mail").removeAttribute('style');
    document.getElementById("age").removeAttribute('style');
    document.getElementById("pass").removeAttribute('style');
    document.getElementById("repass").removeAttribute('style');

    //Labels
    document.getElementById("nameError").style.visibility = "hidden";
    document.getElementById("userError").style.visibility = "hidden";
    document.getElementById("mailError").style.visibility = "hidden";
    document.getElementById("ageError").style.visibility = "hidden";
    document.getElementById("passError").style.visibility = "hidden";
    document.getElementById("repassError").style.visibility = "hidden";
    document.getElementById("toggle").setAttribute('src', 'IMG/show.png');
}
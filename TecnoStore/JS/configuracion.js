//FUENTES
document.getElementById("textSize").addEventListener('change', function(){
    let size = document.getElementById("textSize").value;
    if (size == 1){
        document.getElementById("textoPrueba").style.fontSize = "15px";
    } else if (size == 2){
        document.getElementById("textoPrueba").style.fontSize = "20px";
    } else if (size == 3){
        document.getElementById("textoPrueba").style.fontSize = "25px";
    } 
}
);

document.getElementById("textColor").addEventListener('change',function(){
    let color = document.getElementById("textColor");
    document.getElementById("textoPrueba").style.color = color.value;
});



//TEMAS
document.getElementById("bodyColorFondo").addEventListener('change',function(){
    let color = document.getElementById("bodyColorFondo");
    document.body.style.background = color.value;
});

document.getElementById("headerColorFondo").addEventListener('change',function(){
    let color = document.getElementById("headerColorFondo");
    document.getElementById("nav").style.backgroundColor = color.value;
});

document.getElementById("footerColorFondo").addEventListener('change',function(){
    let color = document.getElementById("footerColorFondo");
    document.getElementById("footer").style.backgroundColor = color.value;
});

//FUNCIONES
function Save(indice){
    document.cookie = "Body[" + indice + "]=" + document.body.style.background + ";expires=Thu, 01 Jan 2031 00:00:00 UTC;";
    document.cookie = "Header[" + indice + "]=" + document.getElementById("nav").style.backgroundColor + ";expires=Thu, 01 Jan 2031 00:00:00 UTC;";
    document.cookie = "Footer[" + indice + "]=" + document.getElementById("footer").style.backgroundColor + ";expires=Thu, 01 Jan 2031 00:00:00 UTC;";
    document.cookie = "textSize[" + indice + "]=" + document.getElementById("textoPrueba").style.fontSize + ";expires=Thu, 01 Jan 2031 00:00:00 UTC;";
    document.cookie = "textColor[" + indice + "]=" + document.getElementById("textoPrueba").style.color + ";expires=Thu, 01 Jan 2031 00:00:00 UTC;";

    alert("Configuración Guardada");
}

function Load(indice){
    var Datos = document.cookie.split(";"); 
    var cHeader = document.getElementById("nav");  
    var cFooter = document.getElementById("footer");  
    var cText = document.querySelectorAll("[id='text']");  

    for (var i=0; i<Datos.length; i++){
        if (Datos[i].substring(0,1) == " "){
            Datos[i] = Datos[i].substring(1,Datos[i].length);
        }else {
            Datos[i] = Datos[i].substring(0,Datos[i].length);
        }
    }

    for (var i=0; i<Datos.length; i++){

        //Body
        if(Datos[i].indexOf("Body[" + indice + "]")>=0){
            document.body.style.backgroundColor = Datos[i].substr((Datos[i].indexOf("=")+1),Datos[i].length);
        }
        //Header
        if(Datos[i].indexOf("Header[" + indice + "]")>=0){          
            cHeader.style.backgroundColor = Datos[i].substr((Datos[i].indexOf("=")+1),Datos[i].length);
        }
        //Footer
        if(Datos[i].indexOf("Footer[" + indice + "]")>=0){
            cFooter.style.backgroundColor = Datos[i].substr((Datos[i].indexOf("=")+1),Datos[i].length);
        }
        if(Datos[i].indexOf("textSize[" + indice + "]")>=0){
            let x = Datos[i].substring((Datos[i].indexOf("=")+1),Datos[i].length);
            for (var j=0; j<cText.length; j++) {
                cText[j].style.fontSize = x;
            }
        }
        if(Datos[i].indexOf("textColor[" + indice + "]")>=0){
            let x = Datos[i].substring((Datos[i].indexOf("=")+1),Datos[i].length);
            for (var j=0; j<cText.length; j++) {
                cText[j].style.color = x;
            }           
        }
    }
}

function Reset(indice){
    document.cookie = "Body[" + indice + "]=" + ";expires=Thu, 01 Jan 1970 00:00:00 UTC;";
    document.cookie = "Header[" + indice + "]=" + ";expires=Thu, 01 Jan 1970 00:00:00 UTC;";
    document.cookie = "Footer[" + indice + "]=" + ";expires=Thu, 01 Jan 1970 00:00:00 UTC;";
    document.cookie = "textSize[" + indice + "]=" + ";expires=Thu, 01 Jan 1970 00:00:00 UTC;";
    document.cookie = "textColor[" + indice + "]=" +";expires=Thu, 01 Jan 1970 00:00:00 UTC;";

    alert("Configuración Predeterminada Aplicada");
}
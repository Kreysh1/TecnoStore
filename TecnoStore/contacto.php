<?php
    
	session_start();
    $id = $_SESSION['id'];
    $name = $_SESSION['name'];
    $user = $_SESSION['username'];
    $email = $_SESSION['email'];
    $nivel = $_SESSION['nivel'];

    if ($user == NULL || $user== ''){
        header("location:login.php");
    }
    
    /*session_start();
    $index = $_SESSION['index'];
    $user = $_COOKIE["user"];
    $pass = $_COOKIE["pass"];

    if (!isset($_SESSION['index'])){
        echo $index;
        header("location:login2.php");
    }*/
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/f7197c532d.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="CSS/contacto.css">
    <script src="JS/configuracion.js"></script>
    <title>Contacto</title>
</head>
<body onload="Load(<?php echo $index; ?>);">
    <header>
        <div title="Inicio" class="return"><a href="index.php"><i class="fas fa-arrow-circle-left"></i></a></div>
    </header>
    <div class="content">
        <div class="contact-wrapper">
            <div class="contact-form">
                <h3>Contacto</h3>
                <form method="POST" action="Servicios/send_contactoMail.php" onreset="Clear();">
                    <p>
                        <label>Nombre</label>
                        <input type="text" name="Nombre" id="Nombre" onchange="NameValidation();">
                    </p>
                    <p>
                        <label>Correo</label>
                        <input type="email" name="Correo" id="Correo" onchange="MailValidation();">
                    </p>
                    <p class="block">
                       <label>Mensaje</label> 
                        <textarea disabled name="Mensaje" id="Mensaje" rows="8"></textarea>
                    </p>
                    <div class="button block">
                        <input type="submit" value="Enviar">
                        <input type="reset" value="Reestablecer">  
                    </div>
                </form>
            </div>
            <div class="contact-info" id="footer">
                <h4>Más Información</h4>
                <ul>
                    <li><i class="fas fa-map-marker-alt"></i> Calle Ficticia #11</li>
                    <li><i class="fas fa-phone"></i> (111) 111 111 111</li>
                    <li><i class="fas fa-envelope-open-text"></i> prueba@mail.com</li>
                </ul>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Libero provident ipsam necessitatibus repellendus?</p>
                <p>www.empresa.com</p>
            </div>
        </div>
    </div>
    <script src="JS/contacto.js"></script>
</body>
</html>
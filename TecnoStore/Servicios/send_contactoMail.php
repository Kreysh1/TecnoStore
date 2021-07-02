<?php
require("../PHPMailer/class.phpmailer.php");
require("../PHPMailer/class.smtp.php");

$name = $_POST['Nombre'];
$correo = $_POST['Correo'];
$mensaje = $_POST['Mensaje'];
$ruta_host = 'https://gonzalez-juan-302.000webhostapp.com/';
$ruta_local = 'http://localhost/test1/';

$mail = new PHPMailer(true);
try{
    //Server settings
    $mail->SMTPDebug = 0;                                   //Enable verbose debug output
    $mail->IsSMTP();                                        //Send using SMTP
    $mail->Host = "smtp.gmail.com";                         //Set the SMTP server to send through
    $mail->SMTPAuth = true;                                 //Enable SMTP authentication
    $mail->Username = "tecnostoreuas@gmail.com";            //SMTP username
    $mail->Password = "*Password123";                       //SMTP password
    $mail->SMTPSecure = 'tls';                              //Enable implicit TLS encryption
    $mail->Port = 587;                                      //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('tecnostoreuas@gmail.com', 'TecnoStore/Contacto');
    $mail->addAddress('tecnostoreuas@gmail.com');           //Add a recipient

    //Content
    $mail->isHTML(true);                                    //Set email format to HTML
    $mail->CharSet = "utf-8";                                    
    $mail->Subject = 'TecnoStore - Contacto: ' . $name . '/' . $correo ;
    $mail->Body    = 
    '
        <html> 
        <body> 

        <h1><b>TecnoStore(Contacto)</b></h1>
        <br>
        <h2>Nombre: ' . $name .'</h2>
        <h2>Correo: ' . $correo .'</h2>
        <p>' . $mensaje . '</p>

        </body> 
        </html>
    ';

    $mail->send();
    echo
    '
        <script>
            alert("Mensaje enviado");
            location.href="../contacto.php";
        </script>
    ';
}catch (Exception $e){
    echo 'Hubo un error al enviar el mensaje: ', $mail->ErrorInfo;
}
<?php
require("../PHPMailer/class.phpmailer.php");
require("../PHPMailer/class.smtp.php");

$user = $_GET['user'];
$destinatario = $_GET['email'];
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
    $mail->setFrom('tecnostoreuas@gmail.com', 'TecnoStore');
    $mail->addAddress($destinatario);           //Add a recipient

    //Content
    $mail->isHTML(true);                                    //Set email format to HTML
    $mail->CharSet = "utf-8";                                    
    $mail->Subject = 'TecnoStore - Activación de cuenta';
    $mail->Body    = 
    '
        <html> 
        <body> 

        <h1><b>TecnoStore</b></h1>
        <br>
        <a href="' . $ruta_local . 'TecnoStore/Servicios/account_activation.php?user=' . $user . '&email=' . $destinatario . '">Link de Activación</a>

        </body> 
        </html>
    ';

    $mail->send();
    echo
    '
        <html lang="es">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Correo Enviado</title>
            <link rel="stylesheet" href="../CSS/index.css">
            <link rel="stylesheet" href="../CSS/configuracion.css">
        </head>
        <body id="body" onload="Load(<?php echo $id; ?>);">
            <nav id="nav">
                <ul><a href="../index.php?pagina=1" title="Inicio"><img src="../IMG/TS_Logo.png"></a></ul>
                <ul><li><h1>TecnoStore</h1></li></ul>
            </nav>
            <section class="principal">
                <article class="Articulos">
                    <h1>Link de activación enviado a: ' . $destinatario . '</h1>
                    <br>
                    <a href="../login.php">Iniciar Sesion</a>
                </article>
            </section>
        </body>
        </html>
    ';
}catch (Exception $e){
    echo 'Hubo un error al enviar el mensaje: ', $mail->ErrorInfo;
}

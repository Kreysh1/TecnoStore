<?php
include('conexion2.php');
//conexion con la base de datos y el servidor

$user= $_GET['user'];
$email = $_GET['email'];

$sql_usuarios = "SELECT * FROM t_usuarios WHERE Nick='$user' AND Correo='$email'";
$sentencia_usuarios= $pdo->prepare($sql_usuarios);
$sentencia_usuarios->execute();
$resultado_usuarios=$sentencia_usuarios->fetchAll();

$nick = $resultado_usuarios['0']['Nick'];

$sql_activar = "UPDATE t_usuarios SET Estado='1' WHERE Nick='$user' AND Correo='$email'";
$sentencia_activar= $pdo->prepare($sql_activar);
$sentencia_activar->execute();

echo 
'
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Configuracion</title>
        <script src="https://kit.fontawesome.com/f7197c532d.js" crossorigin="anonymous"></script>
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
                <h1>Cuenta Activada</h1>
                <br>
                <a href="../login.php" title="Inicio">Iniciar Sesion</a>
            </article>
        </section>
    </body>
    </html>

';
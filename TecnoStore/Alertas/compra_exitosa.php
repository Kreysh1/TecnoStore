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
    <title>Configuracion</title>
    <script src="https://kit.fontawesome.com/f7197c532d.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../CSS/index.css">
    <link rel="stylesheet" href="../CSS/configuracion.css">
</head>
<body id="body" onload="Load(<?php echo $id; ?>);">
    <nav id="nav">
        <ul><a href="index.php" title="Inicio"><img src="../IMG/TS_Logo.png"></a></ul>
        <ul><li><h1>TecnoStore</h1></li></ul>
    </nav>
    <section class="principal">
        <article class="Articulos">
            <h1>Compra exitosa</h1>
            <br>
            <a href="../index.php" title="Inicio">Volver al inicio</a>
        </article>
    </section>
</body>
</html>
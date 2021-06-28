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
    <link rel="stylesheet" href="CSS/index.css">
    <link rel="stylesheet" href="CSS/configuracion.css">
</head>
<body id="body" onload="Load(<?php echo $id; ?>);">
    <nav id="nav">
        <ul><a href="index.php" title="Inicio"><img src="IMG/TS_Logo.png"></a></ul>
        <ul><li><h1>TecnoStore</h1></li></ul>
        <ul>
            <div class="options-place">
                <?php 
                    if ($nivel == '1'){
                        echo '<li><a href="gestor.php" title="Gestión de Productos"><i class="fas fa-box"></i></a></li>';
                    }
                ?>
                <li><a href="" title="Perfil"><i class="far fa-user-circle"></i></a>
                    <ul>
                        <li><a href="">ID: <?php echo $id; ?></a></li>
                        <li><a href="">Usuario: <?php echo $user; ?></a></li>
                        <li><a href="">Correo: <?php echo $email; ?></a></li>
                        <hr>
                        <li><a href="Servicios/cerrarSesion.php"><i class="fa fa-sign-out" aria-hidden="true"></i> Cerrar Sesión</a></li>
                    </ul>
                </li>              
                <li><a href="carrito.php" title="Carrito"><i class="fas fa-shopping-cart"></i></a></li>
                <li><a href="contacto.php" title="Contacto"><i class="fas fa-envelope"></i></a></li>
                <li><a href="configuracion.php" title="Configuración"><i class="fas fa-cog"></i></a></li>
            </div> 
        </ul>
    </nav>
    <section class="principal">
        <article class="Articulos">
            <h1>Fuentes</h1>
            <hr>
            Tamaño:
            <select id="textSize">
                <option value="1">Chico</option>
                <option value="2">Mediano</option>
                <option value="3">Grande</option>
            </select>
            <br>
            Color: 
            <input type= "color" id="textColor">
            <h2 id="textoPrueba">Texto de Prueba</h2>

            <h1>Temas</h1>
            <hr>
            Color de Body: <input type="color" id="bodyColorFondo">
            <br>
            Color de Header: <input type="color" id="headerColorFondo">
            <br>
            Color de Footer: <input type="color" id="footerColorFondo">
        </article>
    </section>
    <div class="Buttons">
        <button onclick="Save(<?php echo $id; ?>)">Guardar</button>
        <button onclick="Reset(<?php echo $index; ?>)">Reset</button>
    </div>
    <script src="JS/configuracion.js"></script>
</body>
<footer id="footer">
    <h1 id="text">Soy un Footer</h1>
</footer>
</html>
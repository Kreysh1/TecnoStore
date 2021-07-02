<?php

    include_once('Servicios/conexion2.php');

    //Llamada a los articulos de la base de datos
    $p = $_GET['p'];
    $cArticulos = $_GET['cArticulos'];;
    $sql_productos = "SELECT * FROM t_productos WHERE ID='$p'";
    $sentencia_productos= $pdo->prepare($sql_productos);
    $sentencia_productos->execute();
    $resultado_productos=$sentencia_productos->fetchAll();
    
	session_start();
    $id = $_SESSION['id'];
    $name = $_SESSION['name'];
    $user = $_SESSION['username'];
    $email = $_SESSION['email'];
    $nivel = $_SESSION['nivel'];
    $i = 0;
    $total = 0;

    if ($user == NULL || $user== ''){ 
        header("location:login.php");
    }

    if ($nivel != '1'){
        header("location:index.php");
    }
    
    if(isset($_GET['ID'])){
        $_SESSION['id-product'] = $_GET['ID'];
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
    <title>Gestor de Productos</title>
	<script type="text/javascript" src="JS/jquery-3.4.1.min.js"></script>
    <script src="https://kit.fontawesome.com/f7197c532d.js" crossorigin="anonymous"></script>
	<script src="JS/gestor.js"></script>
    <script src="JS/configuracion.js"></script>
    <link rel="stylesheet" href="CSS/index.css">
    <link rel="stylesheet" href="CSS/gestor.css">
</head>
<body onload="Load(<?php echo $id; ?>);">
    <nav id="nav">
        <ul><a href="index.php?pagina=1" title="Inicio"><img src="IMG/TS_Logo.png"></a></ul>
        <ul><li><h1>TecnoStore</h1></li></ul>
        <ul>
            <div class="options-place">
                <?php 
                    if ($nivel == '1' || $nivel == '2'){
                        echo '<li><a href="gestor.php" title="Gestor"><i class="fas fa-box"></i></a></li>';
                        echo '<li><a href="reportes.php" title="Reportes"><i class="fas fa-chart-bar"></i></a></li>';
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
    <div class="main-content">
        <div class="title-section">Datos de envío</div>
        <hr>
        <!-- FORMULARIO DE PRODUCTOS -->
        <form id="productForm" action="Servicios/buy_products.php?producto=<?php echo $_GET['p']?>&qCompra=<?php echo $_GET['cArticulos']?>" method="POST" enctype="multipart/form-data">
            <div class="container">
                <div class="left-content">
                    <div class="input-box">
                        <span class="details">Nombre completo</span>
                        <input type="text" id="nombre" name="nombre" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Colonia</span>
                        <input type="text" id="nombre" name="nombre" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Calle</span>
                        <input type="text" id="nombre" name="nombre" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Código postal</span>
                        <input type="text" id="nombre" name="nombre" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Número exterior</span>
                        <input type="text" id="nombre" name="nombre" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Teléfono de contacto</span>
                        <input type="text" id="nombre" name="nombre" required>
                    </div>
                    <div class="button">
                        <input type="submit" name="confirmar" value="Confirmar Compra">
                    </div>
                </div>
                <div class="right-content">
                    <div class="content-page">
                        <div class="productos-lista">
                            <!-- Aqui se generan los productos -->
                            <?php foreach($resultado_productos as $producto): $i++;?>
                                
                                <div class="productos-caja">                       
                                    <div class="producto">
                                        <img src="Uploads/<?php echo $producto['Imagen'] ?>">
                                        <div class="detalles-medio">
                                            <div class="detalles-titulo" id="text"><?php echo $producto['Nombre'] ?></div>
                                            <div class="detalles-descripcion"><?php echo $producto['Descripcion'] ?></div>
                                        </div>
                                        <div class="detalles-precio">$<?php echo $producto['Precio']?></div>
                                        <div class="detalles-cantidad"><?php echo $cArticulos ?> x <?php echo $producto['Precio'] ?> </div>
                                        <?php $total += $producto['Precio'] * $cArticulos?> 
                                    </div>                           
                                </div>
                                <h1>Total a Pagar: $<?php echo $total?></h1>
                            <?php endforeach ?>
                        </div>                
                    </div>
                </div>
            </div>
        </form>
    </div> 
</body>
</html>
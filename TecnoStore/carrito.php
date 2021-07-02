<?php

    include_once('Servicios/conexion2.php');

    //Llamada a los productos de la base de datos
    $sql_productos = 'SELECT * FROM t_carrito';
    $sentencia_productos= $pdo->prepare($sql_productos);
    $sentencia_productos->execute();
    $resultado_productos=$sentencia_productos->fetchAll();

    $total = 0;
    
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
    <title>Carrito</title>
    <script src="https://kit.fontawesome.com/f7197c532d.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="CSS/index.css">
    <link rel="stylesheet" href="CSS/carrito.css">
    <script src="JS/configuracion.js"></script>
</head>
<body onload="Load(<?php echo $index; ?>);">
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
    <div class="container cartPage">
        <table>
            <tr>
                <th>Producto</th>
                <th>Subtotal</th>
            </tr>
            <?php foreach($resultado_productos as $producto):?>
                <tr>
                    <td>
                        <div class="cartInfo">
                            <img src="Uploads/<?php echo $producto['Imagen'] ?>">
                            <div>
                                <p><?php echo $producto['Nombre'] ?></p>
                                <small><?php echo $producto['Descripcion'] ?></small>
                                <br>
                                <small>$<?php echo $producto['Precio'] ?>x<?php echo $producto['Cantidad'] ?></small>
                                <br>
                                <a href="Servicios/remove_cart.php?ID=<?php echo $producto['ID_Carrito'] ?>">Eliminar</a>
                            </div>
                        </div>
                    </td>
                    <td>$<?php echo $producto['Subtotal'] ?></td>
                </tr>
            <?php $total += $producto['Subtotal']; endforeach; ?>
        </table>
        <div class="totalPrice">
            <table>
                <tr>
                    <td>Total:</td>
                    <td>$<?php echo number_format($total,2) ?></td>
                </tr>
            </table>
        </div>
        <footer id="footer">
            <form id="buyForm" action="Servicios/buy_cart.php" method="POST">
                <h1>Envío a Calle Ficticia #11111 C.P 11111, Ciudad, Municipio</h1>
                <input type="hidden" name="id_user" value="<?php echo $id?>">
                <button class="btnCompra" type="submit">Pagar</button>
            </form>
        </footer>
    </div> 
</body>
</html>
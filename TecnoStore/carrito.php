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
    <div class="container cartPage">
        <table>
            <tr>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Subtotal</th>
            </tr>
            <tr>
                <td>
                    <div class="cartInfo">
                        <img src="IMG/Motorola_1.JPG">
                        <div>
                            <p>Nombre del Producto</p>
                            <small>Precio: $100.00</small>
                            <br>
                            <a href="">Eliminar</a>
                        </div>
                    </div>
                </td>
                <td><input type="number" value="1"></td>
                <td>$100.00</td>
            </tr>
            <tr>
                <td>
                    <div class="cartInfo">
                        <img src="IMG/Motorola_1.JPG">
                        <div>
                            <p>Nombre del Producto</p>
                            <small>Precio: $100.00</small>
                            <br>
                            <a href="">Eliminar</a>
                        </div>
                    </div>
                </td>
                <td><input type="number" value="1"></td>
                <td>$100.00</td>
            </tr>
            <tr>
                <td>
                    <div class="cartInfo">
                        <img src="IMG/Motorola_1.JPG">
                        <div>
                            <p>Nombre del Producto</p>
                            <small>Precio: $100.00</small>
                            <br>
                            <a href="">Eliminar</a>
                        </div>
                    </div>
                </td>
                <td><input type="number" value="1"></td>
                <td>$100.00</td>
            </tr>
            <tr>
                <td>
                    <div class="cartInfo">
                        <img src="IMG/Motorola_1.JPG">
                        <div>
                            <p>Nombre del Producto</p>
                            <small>Precio: $100.00</small>
                            <br>
                            <a href="">Eliminar</a>
                        </div>
                    </div>
                </td>
                <td><input type="number" value="1"></td>
                <td>$100.00</td>
            </tr>
            <tr>
                <td>
                    <div class="cartInfo">
                        <img src="IMG/Motorola_1.JPG">
                        <div>
                            <p>Nombre del Producto</p>
                            <small>Precio: $100.00</small>
                            <br>
                            <a href="">Eliminar</a>
                        </div>
                    </div>
                </td>
                <td><input type="number" value="1"></td>
                <td>$100.00</td>
            </tr>
            <tr>
                <td>
                    <div class="cartInfo">
                        <img src="IMG/Motorola_1.JPG">
                        <div>
                            <p>Nombre del Producto</p>
                            <small>Precio: $100.00</small>
                            <br>
                            <a href="">Eliminar</a>
                        </div>
                    </div>
                </td>
                <td><input type="number" value="1"></td>
                <td>$100.00</td>
            </tr>
        </table>
        <div class="totalPrice">
            <table>
                <tr>
                    <td>Total</td>
                    <td>$600.00</td>
                </tr>
            </table>
        </div>
        <footer id="footer">
            <div>
                <h1>Envío a Calle Ficticia #11111 C.P 11111, Ciudad, Municipio</h1>
                <button class="btnCompra" type="submit">Pagar</button>
            </div>
        </footer>
    </div> 
</body>
</html>
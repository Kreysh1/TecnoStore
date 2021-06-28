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

    if ($nivel != '1'){
        header("location:index.php");
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
    <div class="main-content">
        <div class="title-section">Gestor de Productos</div>
        <hr>
        <!-- FORMULARIO DE PRODUCTOS -->
        <form id="productForm" action="Servicios/upload_products.php" method="POST" enctype="multipart/form-data">
            <div class="container">
                <div class="left-content">
                    <div class="input-box">
                        <span class="details">Nombre</span>
                        <input type="text" id="nombre" name="nombre" placeholder="Producto" value="<?php if(isset($_GET["Name"])){ echo $_GET["Name"];} ?>" oninput="thisClear(this)"; required>
                    </div>
                    <div class="input-box">
                        <span class="details">Descripción</span>
                        <textarea id="descripcion" name="descripcion" rows="8"><?php if(isset($_GET["Desc"])){ echo $_GET["Desc"];} ?></textarea>
                    </div>
                    <div class="input-box">
                        <span class="details">Precio</span>
                        <input type="number" id="precio" name="precio" value="1.00" min="1" step="any" oninput="thisClear(this)"; required>
                    </div>
                    <div class="input-box">
                        <span class="details">Cantidad</span>
                        <input type="number" id="cantidad" name="cantidad" value="1" min="1" oninput="thisClear(this)"; required>
                    </div>
                    <div class="input-box">
                        <span class="details">Imagen</span>
                        <input type="file" id="imagen" name="imagen" oninput="thisClear(this)"; required>
                    </div>
                    <div class="button">
                        <input type="submit" name="guardarProducto" value="Guardar">
                    </div>
                </div>
                <div class="right-content">
                    <div class="content-page">
                        <div class="productos-lista">
                            <div class="productos-caja">                       
                                <div class="producto">
                                    <img src="Uploads/Motorola_1.JPG">
                                    <div class="detalles-medio">
                                        <div class="detalles-titulo" id="text">Nombre</div>
                                        <div class="detalles-descripcion">Descripción</div>
                                    </div>
                                    <div class="detalles-precio">$100.00</div>
                                    <div class="producto-overlay"><p>No Disponible</p></div>
                                </div>                           
                                <div class="comandos">
                                    <li><a title="Modificar" href="gestor.php?Name=Cascasa de celular&Desc=Aqui hay descripcion"><i class="far fa-edit"></i></a></li>
                                    <li><a href=""><i class="fas fa-edit"></i></a></li>
                                    <li><a href=""><i class="far fa-trash-alt"></i></a></li>
                                </div>
                            </div>
                            <div class="productos-caja">
                                <div class="producto">
                                    <img src="Uploads/Motorola_1.JPG">
                                    <div class="detalles-medio">
                                        <div class="detalles-titulo" id="text">Nombre</div>
                                        <div class="detalles-descripcion">Descripción</div>
                                    </div>
                                    <div class="detalles-precio">Precio</div>
                                    <div class="producto-overlay2"><p>No Disponible</p></div>
                                </div>
                                <div class="comandos">
                                    <li><a href=""><i class="fas fa-edit"></i></a></li>
                                    <li><a href=""><i class="far fa-edit"></i></a></li>
                                    <li><a href=""><i class="far fa-trash-alt"></i></a></li>
                                </div>
                            </div>
                            <div class="productos-caja">
                                <div class="producto">
                                    <img src="Uploads/Motorola_1.JPG">
                                    <div class="detalles-medio">
                                        <div class="detalles-titulo" id="text">Nombre</div>
                                        <div class="detalles-descripcion">Descripción</div>
                                    </div>
                                    <div class="detalles-precio">Precio</div>
                                    <div class="producto-overlay"><p>No Disponible</p></div>
                                </div>
                                <div class="comandos">
                                    <li><a href=""><i class="fas fa-edit"></i></a></li>
                                    <li><a href=""><i class="far fa-edit"></i></a></li>
                                    <li><a href=""><i class="far fa-trash-alt"></i></a></li>
                                </div>
                            </div>
                        </div>                
                    </div>
                </div>
            </div>
        </form>
        <div class="title-section">Gestor de Usuarios</div>
        <hr>
        <!-- FORMULARIO DE USUARIOS -->
        <form id="productForm" method="POST">
            <div class="container">
                <div class="left-content">
                    <div class="input-box">
                        <span class="details">Nombre Completo</span>
                        <input type="text" id="name" name="nombreUsuario" placeholder="Ingresa tu nombre" oninput="thisClear(this)"; required>
                    </div>
                    <div class="input-box">
                        <span class="details">Edad</span>
                        <input type="number" id="age" name="ageUsuario" placeholder="Ingresar edad" oninput="thisClear(this)"; required>
                    </div>
                    <div class="input-box">
                        <span class="details">Correo Electrónico</span>
                        <input type="text" id="mail" name="correoUsuario" placeholder="ejemplo@correo.com" oninput="thisClear(this)"; required>
                    </div>
                    <div class="input-box">
                        <span class="details">Usuario</span>
                        <input type="text" id="user" name="nickUsuario" placeholder="Ingresa tu usuario" oninput="thisClear(this)"; required>
                    </div>
                    <div class="input-box">
                        <span class="details">Contraseña</span>
                        <input type="password" id="pass" name="passUsuario" placeholder="Ingresa una contraseña" oninput="thisClear(this)"; required>
                    </div>
                </div>
                <div class="right-content">
                    <div class="content-page">
                    </div>
                </div>
            </div>
        </form>
    </div> 
</body>
</html>
<?php

    include_once('Servicios/conexion2.php');

    //Llamada a los productos de la base de datos
    $sql_productos = 'SELECT * FROM t_productos';
    $sentencia_productos= $pdo->prepare($sql_productos);
    $sentencia_productos->execute();
    $resultado_productos=$sentencia_productos->fetchAll();

    //Llamada a los usuarios de la base de datos
    $sql_usuarios = 'SELECT * FROM t_usuarios';
    $sentencia_usuarios= $pdo->prepare($sql_usuarios);
    $sentencia_usuarios->execute();
    $resultado_usuarios=$sentencia_usuarios->fetchAll();
    
	session_start();
    $id = $_SESSION['id'];
    $name = $_SESSION['name'];
    $user = $_SESSION['username'];
    $email = $_SESSION['email'];
    $nivel = $_SESSION['nivel'];
    $i = 0;
    $x = 0;

    if ($user == NULL || $user== ''){ 
        header("location:login.php");
    }

    if ($nivel == '3'){
        header("location:index.php");
    }
    
    //No es la mejor forma de hacerlo ***
    if(isset($_GET['ID'])){
        $_SESSION['id-product'] = $_GET['ID'];
    }

    if(isset($_GET['ID2'])){
        $_SESSION['id-user'] = $_GET['ID2'];
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
    <script src="JS/validacion.js"></script>
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
        <div class="title-section">Gestor de Productos</div>
        <hr>
        <!-- FORMULARIO DE PRODUCTOS -->
        <form id="productForm" action="Servicios/upload_products.php" method="POST" enctype="multipart/form-data">
            <div class="container">
                <div class="left-content">
                    <div class="input-box">
                        <span class="details">Nombre</span>
                        <input type="text" id="nombre" name="nombre" value="<?php echo isset($_GET["Edit"]) ? $resultado_productos[$_GET["Edit"]]['Nombre'] : '' ?>" placeholder="Producto" oninput="thisClear(this)"; required>
                    </div>
                    <div class="input-box">
                        <span class="details">Descripción</span>
                        <textarea id="descripcion" name="descripcion" rows="8" placeholder="*Escribir una Descripcion*"><?php echo isset($_GET["Edit"]) ? $resultado_productos[$_GET["Edit"]]['Descripcion'] : '' ?></textarea>
                    </div>
                    <div class="input-box">
                        <span class="details">Precio</span>
                        <input type="number" id="precio" name="precio" value="<?php echo isset($_GET["Edit"]) ? $resultado_productos[$_GET["Edit"]]['Precio'] : '1.00' ?>" min="1" step="any" oninput="negativeValidation(this)"; required>
                    </div>
                    <div class="input-box">
                        <span class="details">Cantidad</span>
                        <input type="number" id="cantidad" name="cantidad" value="<?php echo isset($_GET["Edit"]) ? $resultado_productos[$_GET["Edit"]]['Cantidad'] : '1' ?>" min="1" oninput="negativeValidation(this)"; required>
                    </div>
                    <div class="input-box">
                        <span class="details">Imagen</span>
                        <input type="file" id="imagen" name="imagen" oninput="thisClear(this)"; <?php echo isset($_GET["Edit"]) ? '' : 'required' ?>>
                    </div>
                    <div class="button">
                        <?php echo isset($_GET["Edit"]) ? 
                            '<input type="submit" name="editProducto" value="Guardar Cambios">' :
                            '<input type="submit" name="altaProducto" value="Agregar Producto">' 
                        ?>
                            <button><a href="gestor.php">Reestablecer</a></button>
                    </div>
                </div>
                <div class="right-content">
                    <div class="content-page">
                        <div class="productos-lista">
                            <!-- Aqui se generan los productos -->
                            <?php foreach($resultado_productos as $producto): $x++;?>
                                
                                <div class="productos-caja">                       
                                    <div class="producto">
                                        <img src="Uploads/<?php echo $producto['Imagen'] ?>">
                                        <div class="detalles-medio">
                                            <div class="detalles-titulo" id="text"><?php echo $producto['Nombre'] ?></div>
                                            <div class="detalles-descripcion"><?php echo $producto['Descripcion'] ?></div>
                                        </div>
                                        <div class="detalles-precio">$<?php echo $producto['Precio'] ?></div>
                                        <div class="detalles-cantidad">Stock disponible: <?php echo $producto['Cantidad'] ?> </div>
                                        <?php echo $producto['Estado']==0 ? '<div class="producto-overlay"><p>No Disponible</p></div>' : '' ?>
                                    </div>                           
                                    <div class="comandos">
                                        <li><a title="Editar" href="gestor.php?Edit=<?php echo $x-1 ?>&ID=<?php echo $producto['ID']?>"><i class="far fa-edit"></i></a></li>
                                        <li><?php echo $producto['Estado']==0 ? '<a href="Servicios/availability_products.php?ID=' . $producto['ID'] . '&New_Status=1' . '"title="Dar de Alta"><i class="far fa-caret-square-up"></i></a>' : '<a href="Servicios/availability_products.php?ID=' . $producto['ID'] . '&New_Status=0' . '"title="Dar de Baja"><i class="far fa-caret-square-down"></i></a>' ?></li>
                                        <li><a href=""><i class="far fa-trash-alt"></i></a></li>
                                    </div>
                                </div>
                            <?php endforeach ?>
                        </div>                
                    </div>
                </div>
            </div>
        <?php if($nivel=='1'): ?>
            </form>
            <div class="title-section">Gestor de Usuarios</div>
            <hr>
            <!-- FORMULARIO DE USUARIOS -->
            <form id="productForm" action="Servicios/upload_users.php" method="POST">
                <div class="container">
                    <div class="left-content">
                        <div class="input-box">
                            <span class="details">Nombre Completo</span>
                            <input type="text" id="name" name="nombreUsuario" placeholder="Ingresa tu nombre" value="<?php echo isset($_GET["Edit2"]) ? $resultado_usuarios[$_GET["Edit2"]]['Nombre'] : '' ?>" oninput="thisClear(this)"; required>
                        </div>
                        <div class="input-box">
                            <span class="details">Edad</span>
                            <input type="number" id="age" name="ageUsuario" placeholder="Ingresar edad" value="<?php echo isset($_GET["Edit2"]) ? $resultado_usuarios[$_GET["Edit2"]]['Edad'] : '' ?>" oninput="thisClear(this)"; required>
                        </div>
                        <div class="input-box">
                            <span class="details">Correo Electrónico</span>
                            <input type="text" id="mail" name="correoUsuario" placeholder="ejemplo@correo.com" value="<?php echo isset($_GET["Edit2"]) ? $resultado_usuarios[$_GET["Edit2"]]['Correo'] : '' ?>" oninput="thisClear(this)"; required>
                        </div>
                        <div class="input-box">
                            <span class="details">Usuario</span>
                            <input type="text" id="user" name="nickUsuario" placeholder="Ingresa tu usuario" value="<?php echo isset($_GET["Edit2"]) ? $resultado_usuarios[$_GET["Edit2"]]['Nick'] : '' ?>" oninput="thisClear(this)"; required>
                        </div>
                        <div class="input-box">
                            <span class="details">Contraseña</span>
                            <input type="password" id="pass" name="passUsuario" placeholder="<?php echo isset($_GET["Edit2"]) ? 'Ingresa nueva contraseña' : 'Ingresa una contraseña' ?>" oninput="thisClear(this)";>
                        </div>
                        <?php if(isset($_GET['ID2']) && $_GET['ID2'] != $id): ?>
                            <div >
                                <label for="admin">Privilegios de Administrador: </label>
                                <input type="checkbox" id="admin" name="admin" value="<?php echo isset($_GET["Edit2"]) ? $resultado_usuarios[$_GET["Edit2"]]['Nivel'] : '2' ?>" <?php if (isset($_GET["Edit2"]) && $resultado_usuarios[$_GET["Edit2"]]['Nivel'] == '1') { echo "checked='checked'"; } ?>>
                            </div>
                        <?php endif?>
                        <br>
                        <div class="button">
                            <?php echo isset($_GET["Edit2"]) ? 
                                '<input type="submit" name="editUsuario" value="Guardar Cambios">' :
                                '<input type="submit" name="altaUsuario" value="Agregar Usuario">' 
                            ?>
                                <button><a href="gestor.php">Reestablecer</a></button>
                        </div>
                    </div>
                    <div class="right-content">
                        <div class="content-page">
                            <div class="productos-lista">
                                <!-- Aqui se generan los usuarios -->
                                <?php foreach($resultado_usuarios as $usuario): $i++;?>
                                    
                                    <div class="productos-caja">                       
                                        <div class="producto">
                                            <img src="IMG/Perfil.png">
                                            <div class="detalles-medio">
                                                <div class="detalles-titulo" id="text"><?php echo $usuario['Nombre'] ?></div>
                                                <div class="detalles-descripcion">
                                                    Edad: <?php echo $usuario['Edad'] ?>
                                                    <br>
                                                    <?php echo $usuario['Correo'] ?>
                                                </div>
                                            </div>
                                            <div class="detalles-precio"><?php echo $usuario['Nick'] ?></div>
                                            <div class="detalles-cantidad">Permisos: <?php if($usuario['Nivel']=='1'){echo 'Administrador';}elseif($usuario['Nivel']=='2'){echo 'Empleado';}else{echo 'Usuario Web';} ?> </div>
                                            <?php echo $usuario['Estado']==0 ? '<div class="producto-overlay"><p>No Disponible</p></div>' : '' ?>
                                        </div>                           
                                        <div class="comandos">
                                            <li><a title="Editar" href="gestor.php?Edit2=<?php echo $i-1 ?>&ID2=<?php echo $usuario['ID']?>"><i class="far fa-edit"></i></a></li>
                                            <li><?php echo $usuario['Estado']==0 ? '<a href="Servicios/availability_users.php?ID=' . $usuario['ID'] . '&New_Status=1' . '"title="Dar de Alta"><i class="far fa-caret-square-up"></i></a>' : '<a href="Servicios/availability_users.php?ID=' . $usuario['ID'] . '&New_Status=0' . '"title="Dar de Baja"><i class="far fa-caret-square-down"></i></a>' ?></li>
                                            <li><a href=""><i class="far fa-trash-alt"></i></a></li>
                                        </div>
                                    </div>

                                <?php endforeach ?>
                            </div> 
                        </div>
                    </div>
                </div>
            </form>
        <?php endif; ?>
    </div> 
</body>
</html>
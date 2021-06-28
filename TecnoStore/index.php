<?php
    include_once('Servicios/conexion2.php');

    //Llamada a los articulos de la base de datos
    $sql = 'SELECT * FROM t_productos WHERE Estado=1';
    $sentencia= $pdo->prepare($sql);
    $sentencia->execute();
    $resultado=$sentencia->fetchAll();

    session_start();
    $id = $_SESSION['id'];
    $name = $_SESSION['name'];
    $user = $_SESSION['username'];
    $email = $_SESSION['email'];
    $nivel = $_SESSION['nivel'];

    if ($user == NULL || $user== ''){
        header("location:login.php");
    }

    $total_articulos = $sentencia->rowCount();
    $articulos_x_pagina = 6;

    $paginas = $total_articulos/$articulos_x_pagina;
    $paginas = ceil($paginas);

    
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
    <title>TecnoStore</title>
	<script type="text/javascript" src="JS/jquery-3.4.1.min.js"></script>
    <script src="https://kit.fontawesome.com/f7197c532d.js" crossorigin="anonymous"></script>
	<script src="JS/index.js"></script>
    <script src="JS/configuracion.js"></script>
    <link rel="stylesheet" href="CSS/index.css">
</head>
<body onload="Load(<?php echo $id; ?>);">
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
    <div class="second-bar">
        <div>
            <li class="search-place">
            <input type="text" id="searchBar" placeholder="Buscar...">
            <button><i class="fas fa-search"></i></button>    
            </li>
        </div>
    </div>
    <div class="main-content">
        <div class="product-filter">
            <div class="title-section">Filtrar Productos</div>
            <hr>
            <div class="subtitle-section">Marcas</div>
            <div class="list-group">
                <ul>
                    <li>
                    <input type="checkbox">
                    <label for="Marca">Samsung</label>
                    </li>
                    <li>
                    <input type="checkbox">
                    <label for="Marca">Huawei</label>
                    </li>
                </ul>  
            </div>
            <div class="subtitle-section">Tipos</div>
            <div class="list-group">
                <ul>
                    <li>
                        <input type="checkbox">
                        <label for="Tipo">Pantallas</label>
                    </li>
                    <li>
                        <input type="checkbox">
                        <label for="Tipo">Fundas</label>
                    </li>
                </ul>  
            </div>
            <button>Aplicar Filtros</button>
        </div> 
    </div>
    <div class="content-page">
        <div class="title-section">Productos</div>
        <hr>
        <div class="products-list" id="space-list">
            <!-- Aqui se generan los productos -->
            <?php
            if(!$_GET){
                header('Location:index.php?pagina=1');
            }
            if($_GET['pagina'] > $paginas || $_GET['pagina'] <= 0){
                header('Location:index.php?pagina=1');
            }
            
            $iniciar = ($_GET['pagina']-1)*$articulos_x_pagina;

            $sql_articulos = 'SELECT * FROM t_productos WHERE Estado=1 LIMIT :iniciar,:num_articulos';
            $sentencia_articulos= $pdo->prepare($sql_articulos);
            $sentencia_articulos->bindParam(':iniciar', $iniciar, PDO::PARAM_INT);
            $sentencia_articulos->bindParam(':num_articulos', $articulos_x_pagina, PDO::PARAM_INT);
            $sentencia_articulos->execute();

            $resultado_articulos=$sentencia_articulos->fetchAll();
            
            ?>

            <?php foreach($resultado_articulos as $articulo): ?>

                <div class="product-box">
                    <a href="producto.php?p=<?php echo $articulo['ID'] ?>">
                        <div class="product">
                            <img src="Uploads/<?php echo $articulo['Imagen'] ?>">
                            <div class="detail-middle">
                                <div class="detail-title" id="text"><?php echo $articulo['Nombre'] ?></div>
                                <div class="detail-description"><?php echo $articulo['Descripcion'] ?></div>
                            </div>
                            <div class="detail-price">$<?php echo $articulo['Precio'] ?></div>
                        </div>
                    </a>
                </div>

            <?php endforeach ?>
        </div>
        <div class="nav-page">
            <ul class="page-item">
                <li class="page-link <?php echo $_GET['pagina']<=1 ? 'disabled' : '' ?>">
                    <a href="index.php?pagina=<?php echo $_GET['pagina']-1 ?>">
                        Anterior
                    </a>
                </li>

                <?php for($i=0;$i<$paginas;$i++): ?>
                <li class="page-link <?php echo $_GET['pagina']==$i+1 ? 'active' : '' ?>">
                    <a href="index.php?pagina=<?php echo $i+1 ?>">
                        <?php echo $i+1 ?>
                    </a>
                </li>
                <?php endfor ?>

                <li class="page-link <?php echo $_GET['pagina']>=$paginas ? 'disabled' : '' ?>">
                    <a href="index.php?pagina=<?php echo $_GET['pagina']+1 ?>">
                        Siguiente
                    </a>
                </li>
            </ul>           
        </div>
    </div> 
</body>
</html>
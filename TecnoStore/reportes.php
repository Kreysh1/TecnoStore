<?php

    include_once('Servicios/conexion2.php');

    session_start();
    $id = $_SESSION['id'];
    $name = $_SESSION['name'];
    $user = $_SESSION['username'];
    $email = $_SESSION['email'];
    $nivel = $_SESSION['nivel'];

    $option = 0;

    if ($user == NULL || $user== ''){ 
        header("location:login.php");
    }

    if ($nivel == '3'){
        header("location:index.php");
    }

    $currentDate = new DateTime();
    
    if(isset($_POST['tipo'])){
        //Productos mas vendidos
        if($_POST['tipo']=='1'){
            $sql_productos = "SELECT Nombre,Vendidos FROM t_productos WHERE Vendidos>0 ORDER BY Vendidos DESC";
            $sentencia_productos= $pdo->prepare($sql_productos);
            $sentencia_productos->execute();
            $resultado_productos=$sentencia_productos->fetchAll();
        }
        //Productos menos vendidos
        if($_POST['tipo']=='2'){
            $sql_productos = "SELECT Nombre,Vendidos FROM t_productos WHERE Vendidos>0 ORDER BY Vendidos ASC";
            $sentencia_productos= $pdo->prepare($sql_productos);
            $sentencia_productos->execute();
            $resultado_productos=$sentencia_productos->fetchAll();
        }
        //Productos que generan mas ganancias
        if($_POST['tipo']=='3'){
            $sql_productos = "SELECT Nombre,Ganancias FROM t_productos WHERE Ganancias>0 ORDER BY Ganancias DESC";
            $sentencia_productos= $pdo->prepare($sql_productos);
            $sentencia_productos->execute();
            $resultado_productos=$sentencia_productos->fetchAll();
        }
        //Productos que generan menos ganancias
        if($_POST['tipo']=='4'){
            $sql_productos = "SELECT Nombre,Ganancias FROM t_productos WHERE Ganancias>0 ORDER BY Ganancias ASC";
            $sentencia_productos= $pdo->prepare($sql_productos);
            $sentencia_productos->execute();
            $resultado_productos=$sentencia_productos->fetchAll();
        }
        //Clientes que compran mas productos
        if($_POST['tipo']=='5'){
            $sql_clientes = "SELECT Nombre,Compras FROM t_usuarios WHERE Compras>0 ORDER BY Compras DESC";
            $sentencia_clientes= $pdo->prepare($sql_clientes);
            $sentencia_clientes->execute();
            $resultado_clientes=$sentencia_clientes->fetchAll();
        }
        //Clientes que generan mas ingresos
        if($_POST['tipo']=='6'){
            $sql_clientes = "SELECT Nombre,Gastos FROM t_usuarios WHERE Gastos>0 ORDER BY Gastos DESC";
            $sentencia_clientes= $pdo->prepare($sql_clientes);
            $sentencia_clientes->execute();
            $resultado_clientes=$sentencia_clientes->fetchAll();
        }
        //Ventas del dia
        if($_POST['tipo']=='7'){

            $fecha_actual = $currentDate->format('Y-m-d');
            $fecha1 = $fecha_actual . " 00:00:00";
            $fecha2 = $fecha_actual . " 23:59:59";

            $sql_ventas = "SELECT Nick,P_Nombre,Cantidad,Precio,Total,Fecha FROM t_ventas WHERE Fecha BETWEEN '$fecha1' AND '$fecha2'";
            $sentencia_ventas= $pdo->prepare($sql_ventas);
            $sentencia_ventas->execute();
            $resultado_ventas=$sentencia_ventas->fetchAll();

        }
        //Ventas por rango de fechas
        if($_POST['tipo']=='8'){

            $fecha_actual = $currentDate->format('Y-m-d');
            $fecha1 = $_POST['fecha_inicio'] . " 00:00:00";
            $fecha2 = $_POST['fecha_final'] . " 23:59:59";

            $sql_ventas = "SELECT Nick,P_Nombre,Cantidad,Precio,Total,Fecha FROM t_ventas WHERE Fecha BETWEEN '$fecha1' AND '$fecha2'";
            $sentencia_ventas= $pdo->prepare($sql_ventas);
            $sentencia_ventas->execute();
            $resultado_ventas=$sentencia_ventas->fetchAll();

        }
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
    <title>Estadisticas</title>
	<script type="text/javascript" src="JS/jquery-3.4.1.min.js"></script>
    <script src="https://kit.fontawesome.com/f7197c532d.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.4.0/chart.js"></script>
	<script src="JS/gestor.js"></script>
    <script src="JS/configuracion.js"></script>
    <link rel="stylesheet" href="CSS/index.css">
    <link rel="stylesheet" href="CSS/estadisticas.css">
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
        <div class="title-section">Estadisticas <?php echo isset($_POST['tipo']) ? $_POST['tipo'] : '' ?></div>
        <hr>
        <form id="reportForm" action="reportes.php?pagina=1" method="POST">
            <label> Tipo de Consulta : </label>
            <select name="option" onchange="document.getElementById('tipo').value=option.options[this.selectedIndex].value;">
                <option value="0" disabled selected>--Seleccionar tipo de consulta--</option>
                <option value="1"<?php if(isset($_POST['tipo']) && $_POST['tipo']=='1'){echo 'selected';} ?>>Productos mas vendidos</option>
                <option value="2"<?php if(isset($_POST['tipo']) && $_POST['tipo']=='2'){echo 'selected';} ?>>Productos menos vendidos</option>
                <option value="3"<?php if(isset($_POST['tipo']) && $_POST['tipo']=='3'){echo 'selected';} ?>>Productos con mas mas ingresos</option>
                <option value="4"<?php if(isset($_POST['tipo']) && $_POST['tipo']=='4'){echo 'selected';} ?>>Productos con menos ingresos</option>
                <option value="5"<?php if(isset($_POST['tipo']) && $_POST['tipo']=='5'){echo 'selected';} ?>>Clientes que compran mas productos</option>
                <option value="6"<?php if(isset($_POST['tipo']) && $_POST['tipo']=='6'){echo 'selected';} ?>>Clientes que generan mas ingresos</option>
                <option value="7"<?php if(isset($_POST['tipo']) && $_POST['tipo']=='7'){echo 'selected';} ?>>Ventas del día</option>
                <option value="8"<?php if(isset($_POST['tipo']) && $_POST['tipo']=='8'){echo 'selected';} ?>>Ventas por rango de fecha</option>
            </select>
            <input type="hidden" name="tipo" id="tipo" value="" />
            <input type="submit" name="generar" value="Generar"/>
            <input type="date" name=fecha_inicio />
            <input type="date" name=fecha_final />
        </form>
        <div class="container">
            <div class="left-content">
        <!-- Aquí se generan las tablas -->
            <?php if(isset($_POST['tipo']) && $_POST['tipo']=='1'): ?>
                <table>
                    <caption><b>Productos mas vendidos</b></caption>
                    <tr>
                        <th>Nombre de Producto</th>
                        <th>Cantidad</th>
                    </tr>
                    <?php foreach($resultado_productos as $producto): ?>
                    <tr>
                        <td><?php echo $producto['Nombre'] ?></td>
                        <td><?php echo $producto['Vendidos'] ?></td>
                    </tr>
                    <?php endforeach;?>
                </table>   
            <?php endif ?>
            <?php if(isset($_POST['tipo']) && $_POST['tipo']=='2'): ?>
                <table>
                    <caption><b>Productos menos vendidos</b></caption>
                    <tr>
                        <th>Nombre de Producto</th>
                        <th>Cantidad</th>
                    </tr>
                    <?php foreach($resultado_productos as $producto): ?>
                    <tr>
                        <td><?php echo $producto['Nombre'] ?></td>
                        <td><?php echo $producto['Vendidos'] ?></td>
                    </tr>
                    <?php endforeach; ?>
                </table>   
            <?php endif ?>
            <?php if(isset($_POST['tipo']) && $_POST['tipo']=='3'): ?>
                <table>
                    <caption><b>Productos con mas ingresos</b></caption>
                    <tr>
                        <th>Nombre de Producto</th>
                        <th>Ingreso</th>
                    </tr>
                    <?php foreach($resultado_productos as $producto): ?>
                    <tr>
                        <td><?php echo $producto['Nombre'] ?></td>
                        <td>$<?php echo $producto['Ganancias'] ?></td>
                    </tr>
                    <?php endforeach; ?>
                </table>   
            <?php endif ?>
            <?php if(isset($_POST['tipo']) && $_POST['tipo']=='4'): ?>
                <table>
                    <caption><b>Productos con menos ingresos</b></caption>
                    <tr>
                        <th>Nombre de Producto</th>
                        <th>Ingreso</th>
                    </tr>
                    <?php foreach($resultado_productos as $producto): ?>
                    <tr>
                        <td><?php echo $producto['Nombre'] ?></td>
                        <td>$<?php echo $producto['Ganancias'] ?></td>
                    </tr>
                    <?php endforeach; ?>
                </table>   
            <?php endif ?>
            <?php if(isset($_POST['tipo']) && $_POST['tipo']=='5'): ?>
                <table>
                    <caption><b>Clientes que compran mas productos</b></caption>
                    <tr>
                        <th>Nombre de Cliente</th>
                        <th>Cantidad</th>
                    </tr>
                    <?php foreach($resultado_clientes as $cliente): ?>
                    <tr>
                        <td><?php echo $cliente['Nombre'] ?></td>
                        <td><?php echo $cliente['Compras'] ?></td>
                    </tr>
                    <?php endforeach; ?>
                </table>   
            <?php endif ?>
            <?php if(isset($_POST['tipo']) && $_POST['tipo']=='6'): ?>
                <table>
                    <caption><b>Clientes que generan mas ingresos</b></caption>
                    <tr>
                        <th>Nombre de Cliente</th>
                        <th>Ingresos</th>
                    </tr>
                    <?php foreach($resultado_clientes as $cliente): ?>
                    <tr>
                        <td><?php echo $cliente['Nombre'] ?></td>
                        <td>$<?php echo $cliente['Gastos'] ?></td>
                    </tr>
                    <?php endforeach; ?>
                </table>   
            <?php endif ?>
            <?php if(isset($_POST['tipo']) && $_POST['tipo']=='7'): ?>
                <table class="ventas">
                    <caption><b>Ventas del día</b></caption>
                    <tr>
                        <th>Usuario</th>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Precio</th>
                        <th>Ganancias</th>
                        <th>Fecha</th>
                    </tr>
                    <?php foreach($resultado_ventas as $venta): ?>
                    <tr>
                        <td><?php echo $venta['Nick'] ?></td>
                        <td><?php echo $venta['P_Nombre'] ?></td>
                        <td><?php echo $venta['Cantidad'] ?></td>
                        <td>$<?php echo $venta['Precio'] ?></td>
                        <td>$<?php echo $venta['Total'] ?></td>
                        <td><?php echo $venta['Fecha'] ?></td>
                    </tr>
                    <?php endforeach; ?>
                </table>
            <?php endif ?>
            <?php if(isset($_POST['tipo']) && $_POST['tipo']=='8'): ?>
                <table class="ventas">
                    <caption><b>Ventas del () al ()</b></caption>
                    <tr>
                        <th>Usuario</th>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Precio</th>
                        <th>Ganancias</th>
                        <th>Fecha</th>
                    </tr>
                    <?php foreach($resultado_ventas as $venta): ?>
                    <tr>
                        <td><?php echo $venta['Nick'] ?></td>
                        <td><?php echo $venta['P_Nombre'] ?></td>
                        <td><?php echo $venta['Cantidad'] ?></td>
                        <td>$<?php echo $venta['Precio'] ?></td>
                        <td>$<?php echo $venta['Total'] ?></td>
                        <td><?php echo $venta['Fecha'] ?></td>
                    </tr>
                    <?php endforeach; ?>
                </table>
            <?php endif ?>
        <!-- /Aquí se generan las tablas -->
            </div>
            <?php if(isset($_POST['tipo']) && !($_POST['tipo']=='7' || $_POST['tipo']=='8')): ?>
                <div class="right-content">
                    <div class="content-page">
                        <canvas id="myChart" ></canvas>
                    </div>
                </div>
            <?php endif ?>
        </div>
    </div>
    <?php 
    if(isset($_POST['tipo'])){
        if($_POST['tipo']=='1' || $_POST['tipo']=='2'){ echo
            "
                <script>
                    var ctx = document.getElementById('myChart').getContext('2d');
                    var myChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: ['". $resultado_productos['0']['Nombre'] ."', '". $resultado_productos['1']['Nombre'] ."', '". $resultado_productos['2']['Nombre'] ."', '". $resultado_productos['3']['Nombre'] ."', '". $resultado_productos['4']['Nombre'] ."'],
                            datasets: [{
                                label: '# de Ventas',
                                data: [". $resultado_productos['0']['Vendidos'] .", ". $resultado_productos['1']['Vendidos'] .", ". $resultado_productos['2']['Vendidos'] .", ". $resultado_productos['3']['Vendidos'] .", ". $resultado_productos['4']['Vendidos'] ."],
                                backgroundColor: [
                                    'rgba(255, 99, 132, 0.2)',
                                    'rgba(54, 162, 235, 0.2)',
                                    'rgba(255, 206, 86, 0.2)',
                                    'rgba(75, 192, 192, 0.2)',
                                    'rgba(153, 102, 255, 0.2)',
                                ],
                                borderColor: [
                                    'rgba(255, 99, 132, 1)',
                                    'rgba(54, 162, 235, 1)',
                                    'rgba(255, 206, 86, 1)',
                                    'rgba(75, 192, 192, 1)',
                                    'rgba(153, 102, 255, 1)',
                                ],
                            }]
                        }
                    });
                </script>
            ";
        }
        if($_POST['tipo']=='3' || $_POST['tipo']=='4'){ echo
            "
                <script>
                    var ctx = document.getElementById('myChart').getContext('2d');
                    var myChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: ['". $resultado_productos['0']['Nombre'] ."', '". $resultado_productos['1']['Nombre'] ."', '". $resultado_productos['2']['Nombre'] ."', '". $resultado_productos['3']['Nombre'] ."', '". $resultado_productos['4']['Nombre'] ."'],
                            datasets: [{
                                label: '$ ingresos',
                                data: [". $resultado_productos['0']['Ganancias'] .", ". $resultado_productos['1']['Ganancias'] .", ". $resultado_productos['2']['Ganancias'] .", ". $resultado_productos['3']['Ganancias'] .", ". $resultado_productos['4']['Ganancias'] ."],
                                backgroundColor: [
                                    'rgba(255, 99, 132, 0.2)',
                                    'rgba(54, 162, 235, 0.2)',
                                    'rgba(255, 206, 86, 0.2)',
                                    'rgba(75, 192, 192, 0.2)',
                                    'rgba(153, 102, 255, 0.2)',
                                ],
                                borderColor: [
                                    'rgba(255, 99, 132, 1)',
                                    'rgba(54, 162, 235, 1)',
                                    'rgba(255, 206, 86, 1)',
                                    'rgba(75, 192, 192, 1)',
                                    'rgba(153, 102, 255, 1)',
                                ],
                            }]
                        }
                    });
                </script>
            ";
        }
        if($_POST['tipo']=='5'){ echo
            "
                <script>
                    var ctx = document.getElementById('myChart').getContext('2d');
                    var myChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: ['". $resultado_clientes['0']['Nombre'] ."', '". $resultado_clientes['1']['Nombre'] ."', '". $resultado_clientes['2']['Nombre'] ."', '". $resultado_clientes['3']['Nombre'] ."', '". $resultado_clientes['4']['Nombre'] ."'],
                            datasets: [{
                                label: '# de Ventas',
                                data: [". $resultado_clientes['0']['Compras'] .", ". $resultado_clientes['1']['Compras'] .", ". $resultado_clientes['2']['Compras'] .", ". $resultado_clientes['3']['Compras'] .", ". $resultado_clientes['4']['Compras'] ."],
                                backgroundColor: [
                                    'rgba(255, 99, 132, 0.2)',
                                    'rgba(54, 162, 235, 0.2)',
                                    'rgba(255, 206, 86, 0.2)',
                                    'rgba(75, 192, 192, 0.2)',
                                    'rgba(153, 102, 255, 0.2)',
                                ],
                                borderColor: [
                                    'rgba(255, 99, 132, 1)',
                                    'rgba(54, 162, 235, 1)',
                                    'rgba(255, 206, 86, 1)',
                                    'rgba(75, 192, 192, 1)',
                                    'rgba(153, 102, 255, 1)',
                                ],
                            }]
                        }
                    });
                </script>
            ";
        }
        if($_POST['tipo']=='6'){ echo
            "
                <script>
                    var ctx = document.getElementById('myChart').getContext('2d');
                    var myChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: ['". $resultado_clientes['0']['Nombre'] ."', '". $resultado_clientes['1']['Nombre'] ."', '". $resultado_clientes['2']['Nombre'] ."', '". $resultado_clientes['3']['Nombre'] ."', '". $resultado_clientes['4']['Nombre'] ."'],
                            datasets: [{
                                label: '# de Ventas',
                                data: [". $resultado_clientes['0']['Gastos'] .", ". $resultado_clientes['1']['Gastos'] .", ". $resultado_clientes['2']['Gastos'] .", ". $resultado_clientes['3']['Gastos'] .", ". $resultado_clientes['4']['Gastos'] ."],
                                backgroundColor: [
                                    'rgba(255, 99, 132, 0.2)',
                                    'rgba(54, 162, 235, 0.2)',
                                    'rgba(255, 206, 86, 0.2)',
                                    'rgba(75, 192, 192, 0.2)',
                                    'rgba(153, 102, 255, 0.2)',
                                ],
                                borderColor: [
                                    'rgba(255, 99, 132, 1)',
                                    'rgba(54, 162, 235, 1)',
                                    'rgba(255, 206, 86, 1)',
                                    'rgba(75, 192, 192, 1)',
                                    'rgba(153, 102, 255, 1)',
                                ],
                            }]
                        }
                    });
                </script>
            ";
        }
    }
    ?>
</body>
</html>
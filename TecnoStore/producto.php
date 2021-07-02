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

    $p = $_GET["p"];
    $cantidad = 0;
    
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
    <title>Producto</title>
	<script type="text/javascript" src="JS/jquery-3.4.1.min.js"></script>
    <script src="https://kit.fontawesome.com/f7197c532d.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="CSS/index.css">
    <script src="JS/configuracion.js"></script>
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
        <div class="content-page2">
            <form id="buyForm" action="Servicios/redir.php" method="GET">
				<div class="part1">
					<img id="idimg">
				</div>
                <div class="part2">
                    <h2 id="idtitle"></h2>
                    <h1 id="idprice"></h1>
                    <h3 id="iddescription"></h3>
                    <h4 id="idstock"></h4>
                    Cantidad de Artículos: <input type="number" name="cArticulos" id="cantidad" value="1" min="1"><br>
                    <input type="hidden" name="p" class="cantidad" value="<?php echo $_GET["p"]; ?>">
                    <input type="submit" name="comprar" class="comprar" value="Comprar ahora">
                    <input type="submit" name="carrito" class="comprar" value="Agregar al carrito">
                    
                   <!-- FORMULARIO DE USUARIOS  <button disabled><a href="Servicios/add_cart.php?producto=<?php echo $_GET["p"]; ?>&cantidad=">Agregar al carrito</a></button> > -->
                </div>
            </form>
        </div>
    </div>
    <script type="text/javascript">
		var p='<?php echo $_GET["p"]; ?>';
	</script>
    <script type="text/javascript">
		$(document).ready(function($){
			$.ajax({
				url:'Servicios/get_products.php',
				type:'POST',
				data:{},
				success:function(data){
					console.log(data);
					let html='';
					for (var i = 0; i < data.datos.length; i++) {
						if (data.datos[i].ID==p) {
							document.getElementById("idimg").src="Uploads/"+data.datos[i].Imagen;
							document.getElementById("idtitle").innerHTML=data.datos[i].Nombre;
							document.getElementById("idprice").innerHTML=formato_precio(data.datos[i].Precio);
							document.getElementById("iddescription").innerHTML=data.datos[i].Descripcion;
                            document.getElementById("idstock").innerHTML="Stock Disponible:"+data.datos[i].Cantidad;
						}
					}
				},
				error:function(err){
					console.error(err);
				}
			});
		});
		function formato_precio(valor){
			//10.99
			let svalor=valor.toString();
			let array=svalor.split(".");
			return "$"+array[0]+".<span>"+array[1]+"</span>";
		}
	</script>   
</body>
</html>
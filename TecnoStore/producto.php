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
        <div class="content-page">
            <section>
				<div class="part1">
					<img id="idimg">
				</div>
				<div class="part2">
					<h2 id="idtitle"></h2>
					<h1 id="idprice"></h1>
					<h3 id="iddescription"></h3>
					<button>Comprar ahora</button>
                    <button>Agregar al carrito</button>
				</div>
			</section>
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
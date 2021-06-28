<?php
if (isset($_POST["login"])){
	if(isset($_COOKIE["user"])){
		$user=$_COOKIE["user"];
		$pass=$_COOKIE["pass"];
		for ($index=0 ; $index < count($user); $index ++){
			if(($user[$index] == $_POST["nickUsuario"]) && ($pass[$index] == $_POST["passUsuario"])){
				$bandera = true;
				break;
			}else{
				$bandera = false;
			}	
		}
		if ($bandera==true){
			session_start();
			$_SESSION['index'] = $index;
			//echo "Bienvenido";
			header("location:index.php");
		}else{
			echo'
				<script>
					alert("Datos Incorrectos");
				</script>
			';
		}
	}else{
		echo "No hay cookie existente";
	}
}
if (isset($_POST["mostrar"])){
	if(isset($_COOKIE["user"])){
		$user=$_COOKIE["user"];
		$pass=$_COOKIE["pass"];
		echo "USUARIOS <br>";
		for ($index=0 ; $index < count($user); $index ++){
			echo "$user[$index]:$pass[$index]<br>";
		}
	}else{
		echo "No existen usuarios";
	}
}
if (isset($_POST["borrar"])){
	if(isset($_COOKIE["user"])){
		$user=$_COOKIE["user"];
		$pass=$_COOKIE["pass"];
		for ($index=0 ; $index < count($user); $index ++){
			setcookie("user[$index]","",time()-3600, "/");
        	setcookie("pass[$index]","",time()-3600, "/");
		}
		echo "Cookies Eliminadas";	
	}
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenidos a TecnoStore</title>
	<link rel="stylesheet" href="CSS/index.css">
    <link rel="stylesheet" href="CSS/login.css">
</head>
<body>
	<nav>
        <ul><a href="index.php"><img src="IMG/TS_Logo.png"></a></ul>
        <ul><li><h1>TecnoStore</h1></li></ul>
    </nav>
    <div class="main-content">
		<div class="content-page">
			<form  method="POST">
				<h3>Iniciar sesión</h3>
				<input type="text" name="nickUsuario" placeholder="Usuario">
				<input type="password" name="passUsuario" placeholder="Contraseña">
				<input type="submit" name="login" value="Ingresar"></input>
				<input type="submit" name="mostrar" value="Mostrar Usuarios"></input>
				<input type="submit" name="borrar" value="Eliminar Cookies de usuario"></input>
			</form>
			<a class="registro" href="registro2.php">Registrarme</a>
		</div>
	</div>
</body>
</html>
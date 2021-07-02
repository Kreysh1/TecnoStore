<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenidos a TecnoStore</title>
	<script src="https://kit.fontawesome.com/f7197c532d.js" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="CSS/index.css">
    <link rel="stylesheet" href="CSS/login.css">
</head>
<body>
	<nav>
        <ul><a href="index.php?pagina=1"><img src="IMG/TS_Logo.png"></a></ul>
        <ul><li><h1>TecnoStore</h1></li></ul>
    </nav>
    <div class="main-content">
		<div class="content-page">
			<form action="Servicios/validarLogin.php" method="POST">
				<h3>Iniciar sesión</h3>
				<input type="text" name="nickUsuario" placeholder="Usuario">
				<input type="password" name="passUsuario" placeholder="Contraseña">
				<button type="submit">Ingresar</button>
			</form>
			<a class="registro" href="registro.php">Registrarme</a>
		</div>
	</div>
	<div class="GIT">
		<a href="https://github.com/Kreysh1/TecnoStore"><i class="fab fa-github"></i></a>
	</div>
</body>
</html>
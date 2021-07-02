<?php
include('conexion.php');
	//conexion con la base de datos y el servidor
	$db = mysqli_select_db($con,$dbname) or die(mysqli_error($con));

	//obtenemos los valores del formulario
	$nombre = $_POST['nombreUsuario'];
    $nick = strtoupper($_POST['nickUsuario']);
	$edad  = $_POST['ageUsuario'];
	$email = $_POST['correoUsuario'];
	$pass = $_POST['passUsuario'];
	$rpass = $_POST['repassUsuario'];
	$nivel = "3";
	$estado = "0";

	$sql="SELECT * FROM t_usuarios WHERE Nick='$nick'";
	$result=mysqli_query($con,$sql);

	$filas=mysqli_num_rows($result);

	if (!($filas>0)){
		//se encripta la contraseña
		$contraseñaUser = md5($pass);
		//ingresamos la informacion a la base de datos
		mysqli_query($con,"INSERT INTO t_usuarios (Nombre,Edad,Nick,Correo,Pass,Nivel,Estado) VALUES('$nombre','$edad','$nick','$email','$contraseñaUser','$nivel','$estado')") or die(mysqli_error($con));
		echo'
			<script>
				location.href="send_confirmationMail.php?user=' . $nick . '&email=' . $email . '";
			</script>
		';
	}
	else{
		echo'
			<script>
				alert("Este usuario ya existe");
				location.href="../registro.php";
			</script>
		';
	}	
?>
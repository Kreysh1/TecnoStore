<?php
include('conexion.php');
	//conexion con la base de datos y el servidor
	$db = mysqli_select_db($con,$dbname) or die("<h2>Error de Conexion</h2>");

	//obtenemos los valores del formulario
	$nombre = $_POST['nombreUsuario'];
    $nick = strtoupper($_POST['nickUsuario']);
	$email = $_POST['correoUsuario'];
	$pass = $_POST['passUsuario'];
	$rpass = $_POST['repassUsuario'];
	$nivel = "3";

	$sql="SELECT * FROM t_usuarios WHERE Nick='$nick'";
	$result=mysqli_query($con,$sql);

	$filas=mysqli_num_rows($result);

	if (!($filas>0)){
		//se encripta la contraseña
		$contraseñaUser = md5($pass);
		//ingresamos la informacion a la base de datos
		mysqli_query($con,"INSERT INTO t_usuarios VALUES('','$nombre','$nick','$email','$contraseñaUser','$nivel')") or die("<h2>Error Guardando los datos</h2>");
		echo'
			<script>
				alert("Registro Exitoso");
				location.href="../registro.php";
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
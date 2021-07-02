<?php
include('conexion.php');
$username=strtoupper($_POST['nickUsuario']);
$password=MD5($_POST['passUsuario']);

$sql="SELECT * FROM t_usuarios WHERE Nick='$username' and Pass='$password'";
$result=mysqli_query($con,$sql);

while($row=mysqli_fetch_array($result)){
	$id=$row['ID'];
	$name=$row['Nombre'];
	$user=$row['Nick'];
	$email=$row['Correo'];
	$nivel=$row['Nivel'];
	$estado=$row['Estado'];
}

$filas=mysqli_num_rows($result);

if($filas>0){
	if($estado=='1'){
		session_start();
		$_SESSION['id']=$id;
		$_SESSION['name']=$name;
		$_SESSION['username']=$user;
		$_SESSION['email']=$email;
		$_SESSION['nivel']=$nivel;
		mysqli_free_result($result);
		mysqli_close($con);
		header("location:../index.php");
	}else{
		echo'
			<script>
				alert("Usuario Deshabilitado");
				location.href="../login.php";
			</script>
		';
	}
}
else{
    echo'
		<script>
			alert("Datos Incorrectos");
			location.href="../login.php";
		</script>
	';
}
?>
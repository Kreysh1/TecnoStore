<?php
include('conexion.php');
$username=strtoupper($_POST['nickUsuario']);
$password=MD5($_POST['passUsuario']);

$sql="SELECT * FROM t_usuarios WHERE Nick='$username' and Pass='$password'";
$result=mysqli_query($con,$sql);

$filas=mysqli_num_rows($result);

if ($filas>0){
    session_start();
	while($row=mysqli_fetch_array($result)){
		$_SESSION['id']=$row['ID'];
		$_SESSION['name']=$row['Nombre'];
		$_SESSION['username']=$row['Nick'];
		$_SESSION['email']=$row['Correo'];
		$_SESSION['nivel']=$row['Nivel'];
	}
	mysqli_free_result($result);
	mysqli_close($con);
    header("location:../index.php");
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
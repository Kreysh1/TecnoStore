<?php
include('conexion.php');
$response=new stdClass();

$user = $_SESSION['username'];

$datos=[];
$i=0;
$sql="select * from t_usuarios where Nick=$user";
$result=mysqli_query($con,$sql);
while($row=mysqli_fetch_array($result)){
	$obj=new stdClass();
	$obj->ID=$row['ID'];
	$obj->Nombre=$row['Nombre'];
	$obj->Nick=$row['Nick'];
	$obj->Correo=$row['Correo'];
	$obj->Nivel=$row['Nivel'];
	$datos[$i]=$obj;
	$i++;
}
$response->datos=$datos;

mysqli_close($con);
header('Content-Type: application/json');
echo json_encode($response);
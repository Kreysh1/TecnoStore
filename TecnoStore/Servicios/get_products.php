<?php
include('conexion.php');
$response=new stdClass();

$datos=[];
$i=0;
$sql="select * from t_productos where Estado=1";
$result=mysqli_query($con,$sql);
while($row=mysqli_fetch_array($result)){
	$obj=new stdClass();
	$obj->ID=$row['ID'];
	$obj->Nombre=$row['Nombre'];
	$obj->Descripcion=$row['Descripcion'];
	$obj->Precio=$row['Precio'];
	$obj->Imagen=$row['Imagen'];
	$datos[$i]=$obj;
	$i++;
}
$response->datos=$datos;

mysqli_close($con);
header('Content-Type: application/json');
echo json_encode($response);
<?php
include('conexion.php');
//conexion con la base de datos y el servidor
$db = mysqli_select_db($con,$dbname) or die(mysqli_error($con));

$new_status = $_GET['New_Status'];
$id_product= $_GET['ID'];
$sql= "UPDATE t_productos SET Estado='$new_status' WHERE ID='$id_product'";
mysqli_query($con,$sql) or die(mysqli_error($con));
header("location:../gestor.php");
mysqli_close($con);
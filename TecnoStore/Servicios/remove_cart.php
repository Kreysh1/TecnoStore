<?php
include_once('conexion2.php');


//Llamada a los productos de la base de datos
$id_carrito = $_GET['ID'];
$sql_productos = "DELETE FROM t_carrito WHERE ID_Carrito='$id_carrito'";
$sentencia_productos= $pdo->prepare($sql_productos);
$sentencia_productos->execute();
$resultado_productos=$sentencia_productos->fetchAll();
header("location:../carrito.php");
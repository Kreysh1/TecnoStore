<?php
include_once('conexion2.php');


//Llamada a los productos de la base de datos
$id_producto = $_GET['p'];
$sql_productos = "SELECT * FROM t_productos WHERE ID='$id_producto'";
$sentencia_productos= $pdo->prepare($sql_productos);
$sentencia_productos->execute();
$resultado_productos=$sentencia_productos->fetchAll();

session_start();
$Id_user= $_SESSION['id'];
$id_product = $resultado_productos['0']['ID'];
$nombre=  $resultado_productos['0']['Nombre'];
$descripcion=  $resultado_productos['0']['Descripcion'];
$precio=  $resultado_productos['0']['Precio'];
$cantidad= $_GET['cArticulos'];
$subtotal = $precio * $cantidad;
$imagen=  $resultado_productos['0']['Imagen'];

$sql_recorrido = "SELECT COUNT(*) FROM t_carrito WHERE ID_Producto='$id_product'";
$sentencia_recorrido= $pdo->prepare($sql_recorrido);
$sentencia_recorrido->execute();
$resultado_recorrido=$sentencia_recorrido->fetchColumn();

if($resultado_productos['0']['Cantidad']>0){

    if($resultado_recorrido>0){
        $sql_carrito= "UPDATE t_carrito SET Cantidad='$cantidad', Subtotal='$subtotal' WHERE ID_Producto=$id_product";
        $sentencia_carrito= $pdo->prepare($sql_carrito);
        $sentencia_carrito->execute();
        $resultado_carrito=$sentencia_carrito->fetchAll();
        header("location:../carrito.php");
    }else{
        $sql_carrito = "INSERT INTO t_carrito(ID_Usuario,ID_Producto,Nombre,Descripcion,Precio,Cantidad,Subtotal,Imagen) VALUES('$Id_user','$id_product','$nombre','$descripcion','$precio','$cantidad','$subtotal','$imagen')";
        $sentencia_carrito= $pdo->prepare($sql_carrito);
        $sentencia_carrito->execute();
        $resultado_carrito=$sentencia_carrito->fetchAll();
        header("location:../carrito.php");
    }

}else{
    echo'
			<script>
				alert("La cantidad excede el stock disponible");
                location.href="../index.php";
			</script>
		';
}






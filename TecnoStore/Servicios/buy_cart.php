<?php
include_once('conexion2.php');

//Recuperar Variables
$id_user = $_POST['id_user'];

//Llamada a los productos del carrito de la base de datos
$sql_carrito = "SELECT * FROM t_carrito WHERE ID_Usuario='$id_user'";
$sentencia_carrito= $pdo->prepare($sql_carrito);
$sentencia_carrito->execute();
$resultado_carrito=$sentencia_carrito->fetchAll();

//Fecha actual
$currentDate = new DateTime();
$fecha_actual = $currentDate->format('Y-m-d\TH:i:s.v');

//Realizar la compra del carrito
foreach($resultado_carrito as $carrito):
    $id_product = $carrito['ID_Producto'];
    $name_product = $carrito['Nombre'];
    $precio_product = $carrito['Precio'];
    $cantidad_product = $carrito['Cantidad'];
    $subtotal_product = $carrito['Subtotal'];

    //Datos de productos
    $sql_producto = "SELECT * FROM t_productos WHERE ID='$id_product'";
    $sentencia_producto= $pdo->prepare($sql_producto);
    $sentencia_producto->execute();
    $datos_producto=$sentencia_producto->fetchAll();
    //var_dump($datos_producto);

    //Nuevos datos de Producto
    $new_quantity = $datos_producto['0']['Cantidad'] - $cantidad_product;
    $vendidos = $datos_producto['0']['Vendidos'] + $cantidad_product;
    $ganancias = $datos_producto['0']['Ganancias'] + $subtotal_product;

    //Datos de usuario
    $sql_usuario = "SELECT * FROM t_usuarios WHERE ID='$id_user'";
    $sentencia_usuario= $pdo->prepare($sql_usuario);
    $sentencia_usuario->execute();
    $datos_usuario=$sentencia_usuario->fetchAll();

    //Nuevos datos de Usuario
    $name_user = $datos_usuario['0']['Nombre'];
    $compras = $datos_usuario['0']['Compras'] + $cantidad_product;
    $gastos = $datos_usuario['0']['Gastos'] + $subtotal_product;

    //Actualizar datos de producto
    $sql_product= "UPDATE t_productos SET Cantidad='$new_quantity',Vendidos='$vendidos',Ganancias='$ganancias' WHERE ID='$id_product'";
    $sentencia_product= $pdo->prepare($sql_product);
    $sentencia_product->execute();

    //Actualizar datos de usuario
    $sql_user= "UPDATE t_usuarios SET Compras='$compras',Gastos='$gastos' WHERE ID='$id_user'";
    $sentencia_user= $pdo->prepare($sql_user);
    $sentencia_user->execute();

    //Insertar datos de venta
    $sql_sale= "INSERT INTO t_ventas(ID_Usuario,Nick,ID_Producto,P_Nombre,Cantidad,Precio,Total,Fecha) VALUES('$id_user','$name_user','$id_product','$name_product','$cantidad_product','$precio_product','$subtotal_product','$fecha_actual');";
    $sentencia_sale= $pdo->prepare($sql_sale);
    $sentencia_sale->execute();


    

endforeach;

//Borrar carrito
$sql_cart= "DELETE FROM t_carrito WHERE ID_Usuario='$id_user'";
$sentencia_cart= $pdo->prepare($sql_cart);
$sentencia_cart->execute();

header("location:../Alertas/compra_exitosa.php");
<?php
include('conexion.php');
//conexion con la base de datos y el servidor
$db = mysqli_select_db($con,$dbname) or die(mysqli_error($con));

//Recuperar Variables
session_start();
$id_user = $_SESSION['id'];
$id_product= $_GET['p'];
$quantity= $_GET['cArticulos'];

//Consultas a Base de Datos
$result=mysqli_query($con,"SELECT * FROM t_productos WHERE ID='$id_product'");
$datos_producto=mysqli_fetch_array($result);
$result_user=mysqli_query($con,"SELECT * FROM t_usuarios WHERE ID='$id_user'");
$datos_usuario =mysqli_fetch_array($result_user);


//Nuevos datos de Producto
$precio = $datos_producto['Precio'];
$new_quantity=$datos_producto['Cantidad']-$quantity;
$vendidos = $datos_producto['Vendidos'] + $quantity;
$ganancias = $datos_producto['Ganancias']  + ($precio * $quantity);
$productname = $datos_producto['Nombre'];

//Nuevos datos de Usuario
$username=$datos_usuario['Nombre'];
$compras = $datos_usuario['Compras'] + $quantity;
$gastos = $datos_usuario['Gastos'] + ($precio * $quantity);

//Registro de venta
$currentDate = new DateTime();
$fecha_actual = $currentDate->format('Y-m-d\TH:i:s.v');
$total = $precio * $quantity;

if($datos_producto['Cantidad']>0 && $new_quantity>=0){
    //Actualizar datos de producto
    $sql_product= "UPDATE t_productos SET Cantidad='$new_quantity',Vendidos='$vendidos',Ganancias='$ganancias' WHERE ID='$id_product'";
    mysqli_query($con,$sql_product) or die(mysqli_error($con));

    //Actualizar datos de usuario
    $sql_user= "UPDATE t_usuarios SET Compras='$compras',Gastos='$gastos' WHERE ID='$id_user'";
    mysqli_query($con,$sql_user) or die(mysqli_error($con));

    //Insertar datos de venta
    $sql_sale= "INSERT INTO t_ventas(ID_Usuario,Nick,ID_Producto,P_Nombre,Cantidad,Precio,Total,Fecha) VALUES('$id_user','$username','$id_product','$productname','$quantity','$precio','$total','$fecha_actual');";
    mysqli_query($con,$sql_sale) or die(mysqli_error($con));

    header("location:../Alertas/compra_exitosa.php");
    mysqli_close($con);   
}else{
    mysqli_close($con); 
    echo'
			<script>
				alert("La cantidad excede el stock disponible");
                location.href="../index.php";
			</script>
		';
}
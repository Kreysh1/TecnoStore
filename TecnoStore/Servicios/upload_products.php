<?php
include('conexion.php');
//conexion con la base de datos y el servidor
$db = mysqli_select_db($con,$dbname) or die(mysqli_error($con));

if(isset($_POST['altaProducto'])){

    //Obtener POST del formulario
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
	$precio = $_POST['precio'];
	$cantidad = $_POST['cantidad'];

    //Obtener el archivo (imagen)
    $file = $_FILES['imagen'];
        //print_r($file);

    //Separar los datos
    $fileName = $_FILES['imagen']['name'];
    $fileTmpName = $_FILES['imagen']['tmp_name'];
    $fileSize = $_FILES['imagen']['size'];
    $fileError = $_FILES['imagen']['error'];
    $fileType = $_FILES['imagen']['type'];

    //Extensión
    $fileExt = explode('.', $fileName);
    $fileActualExt = strtoupper(end($fileExt));

    $allowed = array('JPG', 'JPEG', 'PNG');

    if (in_array($fileActualExt, $allowed)){
        if($fileError === 0){
            if($fileSize < 2000000){
                $fileNameNew = uniqid('', true).".".$fileActualExt;
                $fileDestination = '../Uploads/'.$fileNameNew;
                move_uploaded_file($fileTmpName,$fileDestination);
                $sql= "INSERT INTO t_productos (Nombre,Descripcion,Precio,Cantidad,Estado,Imagen) VALUES('$nombre','$descripcion','$precio','$cantidad','1','$fileNameNew');";
                mysqli_query($con,$sql) or die(mysqli_error($con));
                echo 'Producto Registrado';
                mysqli_close($con);
                header("location:../gestor.php");
            }else{
                echo "Tu archivo no debe exceder los 2Mb";
            }
        }else{
            echo "Hubo un error al subir tu archivo";
        }
    }else{
        echo "Tipo de archivo incorrecto";
    }
}

if(isset($_POST['editProducto'])){
    session_start();
    $id_product= $_SESSION['id-product'];
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
	$precio = $_POST['precio'];
	$cantidad = $_POST['cantidad'];

    //Obtener el archivo (imagen)
    $file = $_FILES['imagen'];
        //print_r($file);

    //Separar los datos
    $fileName = $_FILES['imagen']['name'];
    if($fileName!=''){
        $fileTmpName = $_FILES['imagen']['tmp_name'];
        $fileSize = $_FILES['imagen']['size'];
        $fileError = $_FILES['imagen']['error'];
        $fileType = $_FILES['imagen']['type'];

        //Extensión
        $fileExt = explode('.', $fileName);
        $fileActualExt = strtoupper(end($fileExt));

        $allowed = array('JPG', 'JPEG', 'PNG');

        if (in_array($fileActualExt, $allowed)){
            if($fileError === 0){
                if($fileSize < 2000000){
                    $fileNameNew = uniqid('', true).".".$fileActualExt;
                    $fileDestination = '../Uploads/'.$fileNameNew;
                    move_uploaded_file($fileTmpName,$fileDestination);
                    $sql= "UPDATE t_productos SET Nombre='$nombre', Descripcion='$descripcion', Precio='$precio', Cantidad='$cantidad', Imagen='$fileNameNew' WHERE ID=$id_product";
                    mysqli_query($con,$sql) or die(mysqli_error($con));
                    echo 'Producto Modificado';
                    mysqli_close($con);
                    header("location:../gestor.php");
                }else{
                    echo "Tu archivo no debe exceder los 2Mb";
                }
            }else{
                echo "Hubo un error al subir tu archivo";
            }
        }else{
            echo "Tipo de archivo incorrecto";
        }
    }else{
        $sql= "UPDATE t_productos SET Nombre='$nombre', Descripcion='$descripcion', Precio='$precio', Cantidad='$cantidad' WHERE ID=$id_product";
        mysqli_query($con,$sql) or die(mysqli_error($con));
        echo 'Producto Modificado';
        mysqli_close($con);
        header("location:../gestor.php");
    }
}
    
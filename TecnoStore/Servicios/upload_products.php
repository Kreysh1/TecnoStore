<?php
    include('conexion.php');
	//conexion con la base de datos y el servidor
	$db = mysqli_select_db($con,$dbname) or die("<h2>Error de Conexion</h2>");

    //Obtener POST del formulario
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
	$precio = $_POST['precio'];
	$cantidad = $_POST['cantidad'];
    $estado = '1';

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
                mysqli_query($con,"INSERT INTO t_productos VALUES('','$nombre','$descripcion','$precio','$cantidad','$estado','$fileNameNew')") or die("<h2>Error Guardando los datos</h2>");
            }else{
                echo "Tu archivo no debe exceder los 2Mb";
            }
        }else{
            echo "Hubo un error al subir tu archivo";
        }
    }else{
        echo "Tipo de archivo incorrecto";
    }

    
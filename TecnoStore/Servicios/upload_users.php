<?php
include('conexion.php');
//conexion con la base de datos y el servidor
$db = mysqli_select_db($con,$dbname) or die(mysqli_error($con));

if(isset($_POST['altaUsuario'])){

    //Obtener POST del formulario
    $nombre = $_POST['nombreUsuario'];
    $edad = $_POST['ageUsuario'];
	$email = $_POST['correoUsuario'];
	$nick = strtoupper($_POST['nickUsuario']);
    $contraseñaUser = MD5($_POST['passUsuario']);

    if(isset($_POST['admin']) && $_POST['admin']=='1'){
        $nivel = "1";
    }else{
        $nivel = "2";
    }

    $estado = "1";

    $sql= "INSERT INTO t_usuarios (Nombre,Edad,Nick,Correo,Pass,Nivel,Estado) VALUES('$nombre','$edad','$nick','$email','$contraseñaUser','$nivel','$estado')";
        mysqli_query($con,$sql) or die(mysqli_error($con));
        //echo 'Usuario Registrado';
        mysqli_close($con);
        header("location:../gestor.php");
}
if(isset($_POST['editUsuario'])){
    session_start();
    $id_user= $_SESSION['id-user'];
    $nombre = $_POST['nombreUsuario'];
    $edad = $_POST['ageUsuario'];
	$email = $_POST['correoUsuario'];
	$nick = strtoupper($_POST['nickUsuario']);
    $contraseñaUser = MD5($_POST['passUsuario']);

    if(isset($_POST['admin']) && $_POST['admin']!='1'){
        $nivel = "1";
    }else{
        $nivel = "2";
    }
    
    $estado = "1";

    if(isset($_POST['passUsuario']) && $_POST['passUsuario']==''){
        $sql= "UPDATE t_usuarios SET Nombre='$nombre', Edad='$edad', Nick='$nick', Correo='$email', Nivel='$nivel', Estado='$estado' WHERE ID=$id_user";
    }else{
        $contraseñaUser = MD5($_POST['passUsuario']);
        $sql= "UPDATE t_usuarios SET Nombre='$nombre', Edad='$edad', Nick='$nick', Correo='$email', Pass='$contraseñaUser' , Nivel='$nivel', Estado='$estado' WHERE ID=$id_user";
    }
    
    mysqli_query($con,$sql) or die(mysqli_error($con));
    //echo 'Usuario Modificado';
    mysqli_close($con);
    header("location:../gestor.php");

}
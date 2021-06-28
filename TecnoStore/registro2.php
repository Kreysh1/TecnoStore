<?php
$msg="";
    if (isset($_POST["registrar"])){

        if (isset($_COOKIE["user"])){
            $arreglo=$_COOKIE["user"];
            $indice=count($arreglo);
            $user=$_POST["nickUsuario"];
            $pass=$_POST["passUsuario"];
            $bandera = false;
            for ($index=0 ; $index < count($arreglo); $index ++){
                if ($arreglo[$index] == $user) {
                    $bandera = true;
                    break;
                }
            }
            if ($bandera!=true){
            setcookie("user[$indice]",$user,time()+(60 * 60 * 24 * 365 * 20), "/");
            setcookie("pass[$indice]",$pass,time()+(60 * 60 * 24 * 365 * 20), "/");
            $msg="Registro Existoso";
            }else{
                $msg="Este nombre de usuario ya existe";
            }
            
        }else{
            $user=$_POST["nickUsuario"];
            $pass=$_POST["passUsuario"];
            setcookie("user[0]",$user,time()+(60 * 60 * 24 * 365 * 20), "/");
            setcookie("pass[0]",$pass,time()+(60 * 60 * 24 * 365 * 20), "/");
            $msg="Cookie creada y usuario registrado";
        }
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="CSS/registro.css">
    <script src="https://kit.fontawesome.com/f7197c532d.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.2/rollups/aes.js"></script>
</head>
<body>
    <header>
        <div title="Inicio de Sesión" class="return"><a href="login2.php"><i class="fas fa-arrow-circle-left"></i></a></div>
    </header>
    <div class="container">
    <div class="title">Registro</div>
    <div class="content">
    <form id="regForm"  method="POST" onreset="Clear();">
        <div class="user-details">
        <div class="input-box">
            <span class="details">Usuario</span>
            <input type="text" id="user" name="nickUsuario" placeholder="Ingresa tu usuario"required>
        </div>
        <div class="input-box">
            <span class="details">Contraseña</span>
            <input type="password" id="pass" name="passUsuario" placeholder="Ingresa una contraseña"required>
        </div>
        <img src="IMG/show.png" id="toggle" onclick="showHide();">
        </div>
        <?php
            echo $msg;
        ?>
        <div class="button">
        <input type="submit" name="registrar" value="Registrar">
        <input type="reset" value="Reestablecer">
        </div>
    </form>
    </div>
    </div>
</body>
</html>
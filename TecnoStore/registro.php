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
    <script src="JS/registro.js"></script>
</head>
<body>
    <header>
        <div title="Inicio de Sesión" class="return"><a href="login.php"><i class="fas fa-arrow-circle-left"></i></a></div>
    </header>
    <div class="container">
    <div class="title">Registro</div>
    <div class="content">
    <form id="regForm" method="POST" onreset="Clear();">
        <div class="user-details">
            <div class="input-box">
                <span class="details">Nombre Completo</span>
                <input type="text" id="name" name="nombreUsuario" placeholder="Ingresa tu nombre" oninput="thisClear(this)"; required>
                <label style="visibility:hidden; font-size: small; color: red;" id="nameError">Solo letras y espacios</label>
            </div>
            <div class="input-box">
                <span class="details">Usuario</span>
                <input type="text" id="user" name="nickUsuario" placeholder="Ingresa tu usuario" oninput="thisClear(this)"; required>
                <label style="visibility:hidden; font-size: small; color: red;" id="userError">No espacios, no símbolos especiales (minimo 5 caracteres)</label>
            </div>
            <div class="input-box">
                <span class="details">Correo Electronico</span>
                <input type="text" id="mail" name="correoUsuario" placeholder="ejemplo@correo.com" oninput="thisClear(this)"; required>
                <label style="visibility:hidden; font-size: small; color: red;" id="mailError">Correo Inválido</label>
            </div>
            <div class="input-box">
                <span class="details">Edad</span>
                <input type="number" id="age" name="ageUsuario" placeholder="Ingresar edad" oninput="thisClear(this)"; required>
                <label style="visibility:hidden; font-size: small; color: red;" id="ageError">Debes ser mayor de 18 años</label>
            </div>
            <div class="input-box">
                <span class="details">Contraseña</span>
                <input type="password" id="pass" name="passUsuario" placeholder="Ingresa una contraseña" oninput="thisClear(this)"; required>
                <label style="visibility:hidden; font-size: small; color: red;" id="passError">Utilizar letras, al menos un número, al menos un símbolo especial, al menos 8 caracteres</label>
            </div>
            <img src="IMG/show.png" id="toggle" onclick="showHide();">
            <div class="input-box">
                <span class="details">Confirmar Contraseña</span>
                <input type="password" id="repass" name="repassUsuario" placeholder="Confirmar contraseña" oninput="thisClear(this)"; required>
                <label style="visibility:hidden; font-size: small; color: red;" id="repassError">Las contraseñas no coinciden</label>
            </div>
        </div>
        <div class="button">
            <input type="button" value="Registrar" onclick="Validar()";>
            <input type="reset" value="Reestablecer">
        </div>
    </form>
    </div>
    </div>
</body>
</html>
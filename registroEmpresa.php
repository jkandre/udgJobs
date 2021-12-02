<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>udg-Jobs</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="css/base.css">
    <link rel="stylesheet" href="css/registroEmpresa.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500&display=swap');
    </style>
</head>
<body>
    <div class="nav container">
        <a class="nav_logo" href="index.php">
            <img src="img/logo.png" alt="">
            <p>udg-Jobs</p>
        </a>
        <div class="nav_buscador">
            <form action="" method="post">
                <input type="text" placeholder="Busca una vacante">
            </form>
        </div>
        <div class="nav_botones">
            <a class="botonBlanco btn" href="login.php">Log In</a>
            <a class="botonBlanco btn" href="registro.php">Registrarse</a>
        </div>
    </div>
    <div class="main">
        <div class="registroEmpresa container">
            <div class="registroEmpresa_text">
                <h1>Unete y contacta a los mejores profesionales</h1>
            </div>
            <div class="registroEmpresa_form">
                <form action="formularios.php" method="post" name="formRegEmpresa" onsubmit="return validarPass()">
                    <h3>Registra tu Empresa</h3>
                    <input type="text" placeholder="Nombre de Empresa" name="nombre" required>
                    <input type="email" placeholder="Correo" name="correo" required>
                    <input type="password" placeholder="Contraseña" name="pass1" required>
                    <input type="password" placeholder="Confirmar contraseña" name="pass2" required>
                    <p>Si tu empresa ya esta registrada <a href="login.php">ingresa</a> </p>
                    <button type="submit" name="btnRegEmpresa">Registrar</button>
                </form>
            </div>
        </div>
    </div>
    <div class="footer container">
        <div class="footer_logo">
            <img src="img/logo.png" alt="">
            <p>udg-Jobs</p>
        </div>
        <div class="footer_franja"></div>
        <div class="footer_derechos">
            <p>udg-Jobs. 2021</p>
        </div>
    </div>
    <script>
        function validarPass() {
            let pass1 = document.forms["formRegEmpresa"]["pass1"].value;
            let pass2 = document.forms["formRegEmpresa"]["pass2"].value;
            if (pass1!=pass2) {
                alert("Las contraseñas no coinciden");
                return false;
            }
        }
    </script>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>udg-Jobs</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="css/base.css">
    <link rel="stylesheet" href="css/login.css">
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
                <input type="text" placeholder="Busca una vacante" name="inputNav">
            </form>
        </div>
        <div class="nav_botones">
            <a class="botonBlanco btn" href="registro.php">Registrarse</a>
        </div>
    </div>
    <div class="main">
        <div class="login container">
            <div class="login_imagen"></div>
            <div class="login_form">
                <form action="formularios.php" method="post" name="formLogin">
                    <h3>Inicia Sesion</h3>
                    <input type="email" placeholder="Correo academico" name="correo" required>
                    <input type="password" placeholder="Contraseña" name="pass" required>
                    <button type="submit" name="btnLogin">Login</button>
                    <p>Si aun no tienes una cuenta <a href="registro.php">registrate</a> 
                        hoy mismo, es gratis</p>
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
</body>
</html>
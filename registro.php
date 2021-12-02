<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>udg-Jobs</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="css/base.css">
    <link rel="stylesheet" href="css/registro.css">
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
        </div>
    </div>
    <div class="main">
        <div class="registro container">
            <div class="registro_form">
                <form action="formularios.php" method="post" name="formRegUsuario" onsubmit="return validarPass()">
                    <h3>Registrate gratis</h3>
                    <div class="registro_nombres">
                        <input type="text" placeholder="Nombre" name="nombre" required>
                        <input type="text" placeholder="Apellido" name="apellido" required>
                    </div>
                    <input type="email" placeholder="Correo academico" name="correo" required>
                    <input type="password" placeholder="Contraseña" name="pass1" required>
                    <input type="password" placeholder="Confirma la contraseña" name="pass2" required>
                    <button type="submit" name="btnRegUsuario">Registrate</button>
                </form>
            </div>
            <div class="registro_imagen">
                <div class="registroEmpresa">
                    <h1>Registra tu empresa aqui...</h1>
                    <a href="registroEmpresa.php" class="btn">Registrar</a>
                </div>
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
            let pass1 = document.forms["formRegUsuario"]["pass1"].value;
            let pass2 = document.forms["formRegUsuario"]["pass2"].value;
            if (pass1!=pass2) {
                alert("Las contraseñas no coinciden");
                return false;
            }
        }
    </script>
</body>
</html>
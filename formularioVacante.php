<?php
    include('conexion.php');
    $con=conectar();

    session_start();
    error_reporting(0);
    $id;
    if(isset($_GET['id'])){
        $id = $_GET['id'];
    }
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>udg-Jobs</title>
    <!--Iconos Google-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <!--Iconos fontawesome-->
    <script src="https://kit.fontawesome.com/4311011c35.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/base.css">
    <link rel="stylesheet" href="css/formularioVacante.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500&display=swap');
    </style>

    <!--API de google-->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=&callback=iniciarMapa"></script>
</head>
<body onload="iniciarMapa()">
    <div class="nav container">
        <a class="nav_logo" href="index.php">
            <img src="img/logo.png" alt="">
            <p>udg-Jobs</p>
        </a>
        <div class="nav_buscador">
            <!--
            <form action="" method="post">
                <input type="text" placeholder="Busca una vacante">
            </form>
            -->
            <p class="sesion">Bienvenido: <?php echo($_SESSION['nombre']) ?></p>
            <a href="empresaHome.php?id=<?php echo $id?>">Home</a>
        </div>
        <div class="nav_botones">
            <!--
            <a class="botonBlanco btn" href="">Log In</a>
            <a class="botonBlanco btn" href="">Registrarse</a>
            -->
            
            <form action="" method="post">
                <button class="cerrarSesion"><i class="fas fa-sign-out-alt"></i></button>
            </form>
        </div>
    </div>
    <div class="main">
        <div class="formVacante container">
            <form action="formularios.php?id=<?php echo $id?>" method="post" name="formVacante">
                <h3>Nueva vacante</h3>
                <input type="text" placeholder="Nombre vacante" name="vacante" required>
                <input type="number" placeholder="Sueldo mensual" min="4251" name="sueldo" required>
                <div class="jornada">
                    <p>Jornada laboral</p>
                    <div>
                        <div>
                            <label for="jornada4">4</label>
                            <input type="radio" name="jornadaRadio" value="4" id="jornada4">
                        </div>
                        <div>
                            <label for="jornada6">6</label>
                            <input type="radio" name="jornadaRadio" value="6" id="jornada6">
                        </div>
                        <div>
                            <label for="jornada8">8</label>
                            <input type="radio" name="jornadaRadio" value="8" id="jornada8" checked>
                        </div>
                        <div>
                            <label for="jornada10">10</label>
                            <input type="radio" name="jornadaRadio" value="10" id="jornada10">
                        </div>
                        <div>
                            <label for="jornada12">12</label>
                            <input type="radio" name="jornadaRadio" value="12" id="jornada12">
                        </div>
                    </div>
                </div>
                <div>
                    <p>Descripcion del puesto</p>
                    <textarea name="descripcion" id="" maxlength="300" required></textarea>
                </div>
                <div>
                    <p>Requisitos</p>
                    <textarea name="Requisitos" id="" maxlength="300" required></textarea>
                </div>
                <div class="coordenadas">
                    <input type="number" placeholder="Latitud" value="20.659808" id="latitud" name="lat" readonly>
                    <input type="number" placeholder="Longitud" value="-103.324529" id="longitud" name="lng" readonly>
                </div>
                <div id="mapa"></div>
                <div class="botonesForm">
                    <button type="submit" name="btnRegVacante">Registrar</button>
                    <a href="empresaHome.php?id=<?php echo $id?>" class="btn">Cancelar</a>
                </div>
            </form>
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
    function iniciarMapa(){
        var latitud = 20.659808;
        var longitud = -103.324529

        coordenadas={
            lng: longitud, 
            lat: latitud
        }
        generarMapa(coordenadas);
    }

    function generarMapa(coordenadas){
        var mapa = new google.maps.Map(document.getElementById('mapa'), 
        {
            zoom: 12, 
            center: new google.maps.LatLng(coordenadas.lat, coordenadas.lng)
        });

        marcador = new google.maps.Marker({
            map: mapa,
            draggable: true,
            position: new google.maps.LatLng(coordenadas.lat, coordenadas.lng)
        });

        marcador.addListener('dragend', function(event){
            document.getElementById("latitud").value = this.getPosition().lat();
            document.getElementById("longitud").value = this.getPosition().lng();
        })
    }
</script>
</body>
</html>
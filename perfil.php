<?php
    include('conexion.php');
    $con=conectar();

    session_start();
    error_reporting(0);

    
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
    <link rel="stylesheet" href="css/perfil.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500&display=swap');
    </style>

    <!--API de google-->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=&callback=iniciarMapa"></script>
</head>
<body onload="iniciarMapa()">
    <div class="nav container">
        <a class="nav_logo" href="#">
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
            <a href="busqueda.php">Busqueda</a>
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
        <div class="usuario container">
            <div class="datos container">
                <div class="foto">
                    <img src="img/user.png" alt="">
                </div>
                <div class="personal">
                <?php 
                    if(isset($_GET['id'])){
                        $id = $_GET['id'];
                        $query = "SELECT * FROM `usuario` WHERE `idUsuario`='$id'";

                        $resultado = mysqli_query($con, $query);
                        if(mysqli_num_rows($resultado)>0){
                            $row=mysqli_fetch_array($resultado);
                        }
                    }
                ?>
                    <h2>Nombre: <?php echo $row['nombre']?></h2>
                    <h3>Correo: <?php echo $row['correo']?></h3>
                    <h3>Contraseña: <?php echo $row['contrasena']?></h3>
                </div>
            </div>
            <div class="preferencias container">
                <form action="formularios.php?id=<?php echo $row['idUsuario']?>" method="post" name="formPesos">
                    <div class="mapaUser">
                        <p>Ingresa tu direccion</p>
                        <div class="coordenadas">
                            <input type="number" placeholder="Latitud" value="<?php echo $row['latitud']?>" id="latitud" name="lat" readonly required>
                            <input type="number" placeholder="Longitud" value="<?php echo $row['longitud']?>" id="longitud" name="lng" readonly required>
                        </div>
                        <div id="mapa"></div>
                    </div>
                    <div class="jornadaUser">
                        <p>Cuantas horas buscas en un trabajo</p>
                        <div>
                            <div>
                                <label for="jornada4">4</label>
                                <input type="radio" name="jornadaRadio" value="4" id="jornada4" required>
                            </div>
                            <div>
                                <label for="jornada6">6</label>
                                <input type="radio" name="jornadaRadio" value="6" id="jornada6" required>
                            </div>
                            <div>
                                <label for="jornada8">8</label>
                                <input type="radio" name="jornadaRadio" value="8" id="jornada8" checked required>
                            </div>
                            <div>
                                <label for="jornada10">10</label>
                                <input type="radio" name="jornadaRadio" value="10" id="jornada10" required>
                            </div>
                            <div>
                                <label for="jornada12">12</label>
                                <input type="radio" name="jornadaRadio" value="12" id="jornada12" required>
                            </div>
                        </div>
                    </div>
                    <div class="importancia">
                        <p>En un trabajo que es mas importante para ti</p>
                        <div>
                            <div>
                                <label for="salarioRadio">Salario</label>
                                <input type="radio" name="importancia" value="sal" id="salarioRadio" checked required>
                            </div>
                            <div>
                                <label for="distanciaRadio">Distancia</label>
                                <input type="radio" name="importancia" value="dist" id="distanciaRadio" required>
                            </div>
                        </div>
                    </div>
                    <div class="botones">
                        <button type="submit" name="btnPesos" class="btn">Guardar</button>
                    </div>
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
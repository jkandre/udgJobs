<?php
    include('conexion.php');
    $con=conectar();

    session_start();
    error_reporting(0);
    $id;
    if(isset($_GET['id'])){
        $id = $_GET['id'];
    }
    $busq;
    if(isset($_GET['busqueda'])){
        $busq = $_GET['busqueda'];
    }

    function distance($lat1, $lon1, $lat2, $lon2, $unit) {
 
        $theta = $lon1 - $lon2;
        $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $miles = $dist * 60 * 1.1515;
        $unit = strtoupper($unit);
       
        if ($unit == "K") {
          return ($miles * 1.609344);
        } else if ($unit == "N") {
            return ($miles * 0.8684);
          } else {
              return $miles;
            }
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
    <link rel="stylesheet" href="css/busqueda.css">
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
            <!--
            <form action="" method="post">
                <input type="text" placeholder="Busca una vacante">
            </form>
            -->
            <p class="sesion">Bienvenido: <?php echo($_SESSION['nombre']) ?></p>
            <a href="perfil.php?id=<?php echo $id?>">Perfil</a>
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
        <div class="empleos container">
            <form class="empleos_busqueda" action="busquedaFuncion.php" method="get">
                <input type="hidden" name="id" value="<?php echo $id?>">
                <input type="text" placeholder="Ej. Sistemas informaticos, Quimico, etc..."  name="busqueda">
                <button>Buscar</button>
            </form>
            <div class="empleos_orden">
                <p>Ordenar por: </p>
                <div class="orden_opciones">
                    <form action="busquedaFuncion.php" method="get">
                        <input type="hidden" name="id" value="<?php echo $id?>">
                        <input type="hidden" name="busqAlg" value="<?php echo $busq?>">
                        <button type="submit" name="btnAlg">Algoritmo</button>
                    </form>
                    <form action="busquedaFuncion.php" method="get">
                        <input type="hidden" name="id" value="<?php echo $id?>">
                        <input type="hidden" name="busqFecha" value="<?php echo $busq?>">
                        <button type="submit" name="btnFecha">Fecha</button>
                    </form>
                    <form action="busquedaFuncion.php" method="get">
                        <input type="hidden" name="id" value="<?php echo $id?>">
                        <input type="hidden" name="busqSueldo" value="<?php echo $busq?>">
                        <button type="submit" name="btnSueldo">Sueldo</button>
                    </form>
                </div>
            </div>
            <p>Resultados de la busqueda:</p>
            <div class="empleos_resultados">
                <?php
                    if(isset($_GET['busqueda'])){
                        $query;
                        $lat;
                        $lng;
                        $jor;
                        $top;
                        $busq=$_GET['busqueda'];
                        if(isset($_GET['orden'])){
                            $orden=$_GET['orden'];
                            if($orden=="fecha"){
                                $query = "SELECT v.`nombre` AS nombreV, v.`sueldo`, v.`jornada`, v.`descripcion`, v.`requisitos`, v.`fecha`, e.`nombre` AS nombreE FROM `vacante` AS v INNER JOIN `empresa` AS e ON v.`idEmpresa`=e.`idEmpresa` WHERE v.`nombre` LIKE '%$busq%' ORDER BY v.`fecha` DESC;";
                            }else if($orden=="sueldo"){
                                $query = "SELECT v.`nombre` AS nombreV, v.`sueldo`, v.`jornada`, v.`descripcion`, v.`requisitos`, v.`fecha`, e.`nombre` AS nombreE FROM `vacante` AS v INNER JOIN `empresa` AS e ON v.`idEmpresa`=e.`idEmpresa` WHERE v.`nombre` LIKE '%$busq%' ORDER BY v.`sueldo` DESC;";
                            }else if($orden=="dijkstra"){
                                $query = "SELECT `idUsuario`, `latitud`, `longitud`, `jornada`, `top` FROM `usuario` WHERE `idUsuario` = '$id';";
                                
                                $resultado = mysqli_query($con, $query);
                                if(mysqli_num_rows($resultado)>0){
                                    $row=mysqli_fetch_array($resultado);
                                    $lat=$row['latitud'];
                                    $lng=$row['longitud'];
                                    $jor=$row['jornada'];
                                    $top=$row['top'];

                                    if($top=='sal'){
                                        $query = "SELECT v.`nombre` AS nombreV, v.`sueldo`, v.`jornada`, v.`descripcion`, v.`requisitos`, v.`fecha`, v.`latitud`, v.`longitud`, e.`nombre` AS nombreE, ST_Distance_Sphere(POINT(v.longitud, v.latitud), POINT('$lng', '$lat'))/1000 as distances FROM `vacante` AS v INNER JOIN `empresa` AS e ON v.`idEmpresa`=e.`idEmpresa` WHERE v.`nombre` LIKE '%$busq%' AND v.`jornada`<='$jor' ORDER BY v.`sueldo` DESC, distances ASC;";

                                        $resultado = mysqli_query($con, $query);
                                        if(mysqli_num_rows($resultado)>0){
                                            while($row=mysqli_fetch_array($resultado)){
                                                ?>
                                                    <a class="resultados_vacante" href="">
                                                        <div class="nombreFecha">
                                                            <h3><?php echo $row['nombreV']?></h3>
                                                            <p><?php echo $row['fecha']?></p>
                                                        </div>
                                                        <p class="vacante_subtitulos"><?php echo $row['nombreE']?></p>
                                                        <p class="vacante_subtitulos">$<?php echo $row['sueldo']?> al mes</p>
                                                        <p class="vacante_subtitulos">Jornada: <?php echo $row['jornada']?> horas</p>
                                                        <p class="vacante_descripcion"><?php echo $row['descripcion']?></p>
                                                        <p class="vacante_descripcion"><?php echo $row['requisitos']?></p>
                                                    </a>
                                                <?php
                                            }
                                        }

                                        $query = "SELECT v.`nombre` AS nombreV, v.`sueldo`, v.`jornada`, v.`descripcion`, v.`requisitos`, v.`fecha`, v.`latitud`, v.`longitud`, e.`nombre` AS nombreE, ST_Distance_Sphere(POINT(v.longitud, v.latitud), POINT('$lng', '$lat'))/1000 as distances FROM `vacante` AS v INNER JOIN `empresa` AS e ON v.`idEmpresa`=e.`idEmpresa` WHERE v.`nombre` LIKE '%$busq%' AND v.`jornada`>'$jor' ORDER BY v.`sueldo` DESC, distances ASC;";
                                    }else if($top=='dist'){
                                        $query = "SELECT v.`nombre` AS nombreV, v.`sueldo`, v.`jornada`, v.`descripcion`, v.`requisitos`, v.`fecha`, v.`latitud`, v.`longitud`, e.`nombre` AS nombreE, ST_Distance_Sphere(POINT(v.longitud, v.latitud), POINT('$lng', '$lat'))/1000 as distances FROM `vacante` AS v INNER JOIN `empresa` AS e ON v.`idEmpresa`=e.`idEmpresa` WHERE v.`nombre` LIKE '%$busq%' AND v.`jornada`<='$jor' ORDER BY distances ASC, v.`sueldo` DESC;";

                                        $resultado = mysqli_query($con, $query);
                                        if(mysqli_num_rows($resultado)>0){
                                            while($row=mysqli_fetch_array($resultado)){
                                                ?>
                                                    <a class="resultados_vacante" href="">
                                                        <div class="nombreFecha">
                                                            <h3><?php echo $row['nombreV']?></h3>
                                                            <p><?php echo $row['fecha']?></p>
                                                        </div>
                                                        <p class="vacante_subtitulos"><?php echo $row['nombreE']?></p>
                                                        <p class="vacante_subtitulos">$<?php echo $row['sueldo']?> al mes</p>
                                                        <p class="vacante_subtitulos">Jornada: <?php echo $row['jornada']?> horas</p>
                                                        <p class="vacante_descripcion"><?php echo $row['descripcion']?></p>
                                                        <p class="vacante_descripcion"><?php echo $row['requisitos']?></p>
                                                    </a>
                                                <?php
                                            }
                                        }

                                        $query = "SELECT v.`nombre` AS nombreV, v.`sueldo`, v.`jornada`, v.`descripcion`, v.`requisitos`, v.`fecha`, v.`latitud`, v.`longitud`, e.`nombre` AS nombreE, ST_Distance_Sphere(POINT(v.longitud, v.latitud), POINT('$lng', '$lat'))/1000 as distances FROM `vacante` AS v INNER JOIN `empresa` AS e ON v.`idEmpresa`=e.`idEmpresa` WHERE v.`nombre` LIKE '%$busq%' AND v.`jornada`>'$jor' ORDER BY distances ASC, v.`sueldo` DESC;";
                                    }
                                }
                            }
                        }else{
                            $query = "SELECT v.`nombre` AS nombreV, v.`sueldo`, v.`jornada`, v.`descripcion`, v.`requisitos`, v.`fecha`,e.`nombre` AS nombreE FROM `vacante` AS v INNER JOIN `empresa` AS e ON v.`idEmpresa`=e.`idEmpresa` WHERE v.`nombre` LIKE '%$busq%';";
                        }
                        $resultado = mysqli_query($con, $query);
                        if(mysqli_num_rows($resultado)>0){
                            while($row=mysqli_fetch_array($resultado)){
                ?>
                <a class="resultados_vacante" href="">
                    <div class="nombreFecha">
                        <h3><?php echo $row['nombreV']?></h3>
                        <p><?php echo $row['fecha']?></p>
                    </div>
                    <p class="vacante_subtitulos"><?php echo $row['nombreE']?></p>
                    <p class="vacante_subtitulos">$<?php echo $row['sueldo']?> al mes</p>
                    <p class="vacante_subtitulos">Jornada: <?php echo $row['jornada']?> horas</p>
                    <p class="vacante_descripcion"><?php echo $row['descripcion']?></p>
                    <p class="vacante_descripcion"><?php echo $row['requisitos']?></p>
                </a>
                <?php
                            }
                        }
                    }
                ?>
                <!--AQUI SE ACTUALIZARA A AJAX-->
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
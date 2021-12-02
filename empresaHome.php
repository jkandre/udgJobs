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
    <link rel="stylesheet" href="css/empresaHome.css">
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
        <div class="vacantes container">
            <a class="btn" href="formularioVacante.php?id=<?php echo $id ?>">Publicar vacante</a>
            <?php 
                $query = "SELECT * FROM `vacante` WHERE `idEmpresa`='$id'";

                $resultado = mysqli_query($con, $query);
                if(mysqli_num_rows($resultado)>0){
                    while($row=mysqli_fetch_array($resultado)){
            ?>
            <a class="vacante" href="">
                

                <h3><?php echo $row['nombre']?></h3>
                <p class="vacante_subtitulos">$<?php echo $row['sueldo']?> al mes</p>
                <p class="vacante_subtitulos">Jornada: <?php echo $row['jornada']?> horas</p>
                <p class="vacante_descripcion"><?php echo $row['descripcion']?></p>
                <p style="font-weight: 500">Requisitos:</p>
                <p class="vacante_descripcion"><?php echo $row['requisitos']?></p>
                
                
            </a>
            <?php
                    }
                }
            ?>
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
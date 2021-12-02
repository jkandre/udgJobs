<?php
    if(isset($_POST['btnRegEmpresa'])){
        registrarEmpresa();
    }

    if(isset($_POST['btnRegUsuario'])){
        registrarUsuario();
    }

    if(isset($_POST['btnPesos'])){
        registrarPesos();
    }

    if(isset($_POST['btnRegVacante'])){
        registrarVacante();
    }

    if(isset($_POST['btnLogin'])){
        login();
    }

    function registrarEmpresa(){
        include('conexion.php');
        $con=conectar();
        $nombre=$_POST['nombre'];
        $correo=$_POST['correo'];
        $pass=$_POST['pass1'];

        $query = "INSERT INTO `empresa`(`nombre`, `correo`, `contrasena`) VALUES ('$nombre', '$correo', '$pass')";

        $resultado = mysqli_query($con, $query);

        mysqli_close($con);

        header("Location: login.php");
        die();
    }

    function registrarUsuario(){
        include('conexion.php');
        $con=conectar();
        $nombre=$_POST['nombre'];
        $apellido=$_POST['apellido'];
        $correo=$_POST['correo'];
        $pass=$_POST['pass1'];

        $query = "INSERT INTO `usuario`(`nombre`, `apellido`, `correo`, `contrasena`) VALUES ('$nombre', '$apellido', '$correo', '$pass')";

        $resultado = mysqli_query($con, $query);

        mysqli_close($con);

        header("Location: login.php");
        die();
    }

    function registrarPesos(){
        include('conexion.php');
        $con=conectar();

        $lat=$_POST['lat'];
        $lng=$_POST['lng'];
        $jornada=$_POST['jornadaRadio'];
        $top=$_POST['importancia'];
        $id=$_GET['id'];

        $query = "UPDATE `usuario` SET `latitud`=$lat,`longitud`=$lng,`jornada`=$jornada,`top`='$top' WHERE `idUsuario` = $id";

        $resultado = mysqli_query($con, $query);

        mysqli_close($con);

        header("Location: busqueda.php?id=$id");
        die();
    }

    function registrarVacante(){
        include('conexion.php');
        $con=conectar();
        $vacante=$_POST['vacante'];
        $sueldo=$_POST['sueldo'];
        $jornada=$_POST['jornadaRadio'];
        $desc=$_POST['descripcion'];
        $req=$_POST['Requisitos'];
        $lat=$_POST['lat'];
        $lng=$_POST['lng'];
        $id=$_GET['id'];

        $query = "INSERT INTO `vacante`(`nombre`, `sueldo`, `jornada`, `descripcion`, `requisitos`, `latitud`, `longitud`, `idEmpresa`) VALUES ('$vacante', '$sueldo', '$jornada', '$desc', '$req', '$lat', '$lng', '$id')";

        $resultado = mysqli_query($con, $query);

        mysqli_close($con);

        header("Location: empresaHome.php?id=$id");
        die();
    }

    function login(){
        include('conexion.php');
        $con=conectar();
        $correo=$_POST['correo'];
        $pass=$_POST['pass'];

        $query = "SELECT * FROM `usuario` WHERE `correo`='$correo' AND `contrasena`='$pass'";

        $resultado = mysqli_query($con, $query);
        if(mysqli_num_rows($resultado)>0){
            $row=mysqli_fetch_array($resultado);
            $nombre= $row['nombre'];
            session_start();
            $_SESSION['nombre']=$nombre;
            $idUser=$row['idUsuario'];
            header("Location: perfil.php?id=$idUser");
        }else{
            $query = "SELECT * FROM `empresa` WHERE `correo`='$correo' AND `contrasena`='$pass'";
            $resultado = mysqli_query($con, $query);
            if(mysqli_num_rows($resultado)>0){
                $row=mysqli_fetch_array($resultado);
                $nombre= $row['nombre'];
                session_start();
                $_SESSION['nombre']=$nombre;
                $idEmpresa=$row['idEmpresa'];
                header("Location: empresaHome.php?id=$idEmpresa");
            }else{
                header("Location: login.php");
            }
        }
        
        mysqli_close($con);
        die();
    }

?>
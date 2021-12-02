<?php
    function conectar(){
        $baseDatos="udgJobs";
        $usuario="root";
        $contrasena="";
        $servidor="localhost";

        $con = mysqli_connect($servidor, $usuario, $contrasena, $baseDatos);
        if($con->connect_errno){
           die(); 
        }else{
            return $con;
        }
        
    }
?>
<?php
    if(isset($_GET['busqueda'])){
        buscar();
    }

    if(isset($_GET['btnFecha'])){
        ordenarFecha();
    }

    if(isset($_GET['btnSueldo'])){
        ordenarSueldo();
    }

    if(isset($_GET['btnAlg'])){
        ordenarDijkstra();
    }

    function buscar(){
        $id=$_GET['id'];
        $busq=$_GET['busqueda'];
        header("Location: busqueda.php?id=$id&busqueda=$busq");
        die();
    }

    function ordenarFecha(){
        $id=$_GET['id'];
        $busq=$_GET['busqFecha'];
        $ord='fecha';
        header("Location: busqueda.php?id=$id&busqueda=$busq&orden=$ord");
        die();
    }

    function ordenarSueldo(){
        $id=$_GET['id'];
        $busq=$_GET['busqSueldo'];
        $ord='sueldo';
        header("Location: busqueda.php?id=$id&busqueda=$busq&orden=$ord");
        die();
    }

    function ordenarDijkstra(){
        $id=$_GET['id'];
        $busq=$_GET['busqAlg'];
        $ord='dijkstra';
        header("Location: busqueda.php?id=$id&busqueda=$busq&orden=$ord");
        die();
    }
?>
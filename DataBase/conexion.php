<?php
    include_once("configuracion.php");

    // proceso de iniciar sesiones
    session_start();  

    // crear variable de conexion
    $link = mysqli_connect($host, $user, $password, $database);
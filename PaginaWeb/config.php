<?php
/*
$server = "fdb31.125mb.com";
$user = "3927906_aerasens";
$pass = "aerasens2021";
$database = "users_aerasens";
*/
/*CREACIÓN DE LAS VARIABLES ASOCIADAS A LOS DATOS DE LA BASE DE DATOS, TALES COMO
EL NOMBRE DE LA BASE DE DATOS, USUARIO Y CONTRASEÑA DE ACCESO, AL IGUAL QUE EL NOMBRE DE LA BASE DE DATOS.*/
$server = "localhost";
$user = "root";
$pass = "";
$database = "users_aerasens";

/*SE DECLARA UNA VARIABLE ASOCIADA A UNA ESTRCTURA CON 4 PARÁMETROS:
SERVIDOR, USUARIO, CONTRASEÑA Y BASE DE DATOS. EN CASO DE NO PODERSE
CONECTAR LA FUNCIÓN DEVUELVE UN FALSE.*/
$conn = mysqli_connect($server, $user, $pass, $database);

/*VERIFICA LA CONEXIÓN REALIZADA A LA BASE DE DATOS, Y MUESTRA UN MENSAJE SI HUBO UN ERROR.*/
if (!$conn) {
    die("<script>alert('CONEXIÓN FALLIDA!.')</script>");
}

?>

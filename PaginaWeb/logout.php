<?php
/*ENLAZA LA SECCIÓN ACTUAL A ESTA PÁGINA.*/
session_start();
/*FINALIZA LA SESIÓN ACTUAL.*/
session_destroy();
/*UNA VEZ SE REALIZA ESTO, SE DEVUELVE A LA PÁGINA DE INICIO DE SESIÓN*/
header("Location: index.php");

?>

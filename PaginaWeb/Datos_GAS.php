
<?php
/*ENLAZA LA SESIÓN CON ESTE ARCHIVO*/
session_start();
/*EN CASO QUE LA SESIÓN NO ESTÉ ACTIVA, DEVOLVERÁ A LA PÁGINA DE INICIO DE SESIÓN.*/
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
}
?>

<html>
<head>

<meta charset="utf-8">
<title>
Graficas del GAS
</title>

<style>
/*DISEÑO DE FONDO Y AJUSTE DE CENTRADO Y ALTURA.*/
body {
  height: 1000px;
    background-image: url("https://www.teahub.io/photos/full/79-795180_fresh-flower-wallpaper-hd.jpg");
    background-size: cover;
    background-repeat:no-repeat;
    background-position: center center;
    font-family: Bahnschrift;
   }

</style>
<!--DISEÑO DEL BOTON DE CIERRE DE SESION.-->
<style type="text/css">
  .boton_1{
    text-decoration: none;
    padding: 3px;
    padding-left: 10px;
    padding-right: 10px;
    font-family: Bahnschrift;
    font-weight: 300;
    font-size: 25px;
    font-style: italic;
    color: #006505;
    background-color: #82b085;
    border-radius: 15px;
    border: 10px double #006505;
  }
  .boton_1:hover{
    opacity: 0.6;
    text-decoration: none;
  }
</style>


</head>


<body>
  <!--AJUSTE DE LA TABLA DE ENCABEZADO O DE TÍTULO.-->
  <table width="100%" align="center" border="10" cellspacing="0" cellpadding="0" style="background-color:#FFFFE0;">
  <tr>
  <td>
  <fieldset>
    <center>
      <!--SE ESCRIBE UN MENSAJE DE BIENVENIDA JUNTO CON EL NOMBRE DEL USUARIO INGRESADO.-->
    <?php echo "<h1>Bienvenido! " . $_SESSION['username'] . "</h1>"; ?>
  </center>
  <center><p>-PORTAL WEB DE AERASENS-</p></center>
    <center> <b> <p style = "font-family:Bahnschrift;font-size:30px"> GRÁFICAS DE LA VARIACIÓN DE LA CONCENTRACIÓN DE GASES EN EL AMBIENTE <br><b> </p></center>
    <br>
  </fieldset>
  </td>
  </tr>
  </table>

  <!--AQUÍ SE INCLUYEN LAS GRÁFICAS DE LÍNEAS DE LA MEDICIÓN DE LOS SENSORES.-->
  <iframe width="488" height="260" style="border: 5px solid #C6E2FF;" src="https://thingspeak.com/channels/1486425/charts/1?bgcolor=%23ffffff&color=%23d62020&dynamic=true&results=60&title=Gas+Metano&type=line&xaxis=Hora+de+Medici%C3%B3n&yaxis=PPM+de+Concentraci%C3%B3n+del+Gas"></iframe>
  <iframe width="488" height="260" style="border: 5px solid #C6E2FF;" src="https://thingspeak.com/channels/1486425/charts/2?bgcolor=%23ffffff&color=%23d62020&dynamic=true&results=60&title=Gas+Natural&type=line&xaxis=Hora+de+Medici%C3%B3n&yaxis=PPM+de+Concentraci%C3%B3n+del+Gas"></iframe>
  <iframe width="488" height="260" style="border: 5px solid #C6E2FF;" src="https://thingspeak.com/channels/1486425/charts/3?bgcolor=%23ffffff&color=%23d62020&dynamic=true&results=60&title=Gas+de+Mon%C3%B3xido+de+Carbono&type=line&xaxis=Hora+de+Medici%C3%B3n&yaxis=PPM+de+Concentraci%C3%B3n+del+Gas"></iframe>

  <!--AQUÍ SE INCLUYEN LOS CUADROS DE LOS ULTIMOS DATOS REGISTRADOS DE LA MEDICIÓN DE LOS SENSORES.-->
  <iframe width="480" height="110" style="border: 9px solid #03083C;" src="https://thingspeak.com/channels/1486425/widgets/359441"></iframe>
  <iframe width="480" height="110" style="border: 9px solid #03083C;" src="https://thingspeak.com/channels/1486425/widgets/359443"></iframe>
  <iframe width="480" height="110" style="border: 9px solid #03083C;" src="https://thingspeak.com/channels/1486425/widgets/359457"></iframe>

  <!--AQUÍ SE INCLUYEN LOS MEDIDORES DE GAS DE PPM DE LOS DATOS DE LOS SENSORES.-->
  <iframe width="475" height="250" style="border: 11px solid #00CED1;" src="https://thingspeak.com/channels/1486425/widgets/359858"></iframe>
  <iframe width="475" height="250" style="border: 11px solid #00CED1;" src="https://thingspeak.com/channels/1486425/widgets/359859"></iframe>
  <iframe width="475" height="250" style="border: 11px solid #00CED1;" src="https://thingspeak.com/channels/1486425/widgets/359860"></iframe>

  <!--SE INCLUYE EL BOTÓN DE CIERRE DE SESIÓN EN LA SECCIÓN INFERIOR DE LA PÁGINA.-->
  <center>
  <a href="logout.php" class="boton_1">CERRAR SESIÓN</a>
</center>

</body>

</html>

<?php
/*Limpia la Página de cualquier mensaje o WARNINGS inesperados.*/
error_reporting(0);
/*Incluye el código de preconfiguración de la base de datos.*/
include 'config.php';
/*Inicio de Sesión desde esta página.*/
session_start();
/*Establece una sesión tal que cuando el usuario este en línea
lo mantenga en la página de las gráficas.*/
if (isset($_SESSION['username'])) {
    header("Location: Datos_GAS.php");
}

/*Cuando el usuario dé click en el Botón SUBMIT, o el formulario fue enviado ejecuta: */
if (isset($_POST['submit'])) {
  /*Guarda lo ingresado por el usuario en la casilla del correo en una variable.*/
	$email = $_POST['email'];
  /*Guarda lo ingresado por el usuario en la casilla de la clave en una variable.*/
	$password = $_POST['password'];

  /*Accede a la base de datos y busca si lo ingresado corresponde a un correo
  y contraseña válida en la base de datos.*/
	$sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
  /*Guarda en una variable la estructura de datos resultado de la función.*/
	$result = mysqli_query($conn, $sql);
  /*Accede al dato de la estructura NUM_ROWS y verifica si existe
  algún dato.*/
	if ($result->num_rows > 0) { /*SI existe el dato, ejecuta la siguiente línea.*/
    /*La función siguiente devuelve el array asociado a los datos extraídos.*/
		$row = mysqli_fetch_assoc($result);
    /*Del Array obtenido, se extrae el dato el nombre de USUARIO
     y se guarda en la sesión actual.*/
		$_SESSION['username'] = $row['username'];
    /*Redirige al usuario a la página de los datos.*/
		header("Location: Datos_GAS.php");
	} else { /*Ejecuta esta línea si no se encuentra la cuenta asociada.*/
		echo "<script>alert('ERROR! Las credenciales son incorrectas. Inténtelo de Nuevo.')</script>";
	}
}

?>

<!DOCTYPE html>
<html>
<head>
  <!--LLAMADO DEL TIPO DE CARACTERES A USAR-->
	<meta charset="utf-8">
  <!--LLAMADO A LA HOJA CSS DE ESTILO DE PÁGINA.-->
   <link rel="stylesheet" type="text/css" href="configs/style.css">
   <!--NOMBRE DE LA PESTAÑA DE LA PÁGINA-->
	<title>Aerasens WEB</title>
</head>
<body>
  <!--EN CADA TEXTO SE LLAMA LA CLASE CONTAINER DEFINIDA PREVIAMENTE
 EN LA HOJA STYLE.CSS. EN LA SIGUIENTE LÍNEA SE ESCRIBE EL ENCABEZADO
DEL CUADRO DE INICIO.-->
	<div class="container">
		<form action="" method="POST" class="login-email">
			<p class="login-text" style="font-size: 2rem; font-weight: 800;">INICIO DE SESIÓN EN AERASENS WEB</p>
      <!--AQUÍ SE DECLARAN LAS CASILLAS OBLIGATORIAS PARA EL INICIO DE SESIÓN-->
      <!--LA LÍNEA PHP ECHO, AYUDA A MOSTRAR LO QUE EL USUARIO INGRESÓ
    RECOMENDANDO QUE DEBE CAMBIAR EL DATO.-->
			<div class="input-group">
				<input type="email" placeholder="Correo Electrónico" name="email" value="<?php echo $email; ?>" required>
			</div>
			<div class="input-group">
				<input type="password" placeholder="Clave de Usuario" name="password" value="<?php echo $_POST['password']; ?>" required>
			</div>
      <!--AQUÍ SE MUESTRA EL BOTÓN DE INGRESO Y EL TIPO DE BOTÓN.-->
			<div class="input-group">
				<button name="submit" class="btn">Iniciar Sesión</button>
			</div>
      <!--VÍNCULO AL ARCHIVO DE REGISTRO-->
			<p class="login-register-text"><center>No tiene una cuenta con Nosotros?</center> <center>Cree una Ahora:</center>. <a href="register.php"><center>Registrar Aquí.</center></a>.</p>
		</form>
	</div>
</body>
</html>

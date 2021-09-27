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
  /*Guarda lo ingresado por el usuario en la nombre de usuario del correo en una variable.*/
	$username = $_POST['username'];
  /*Guarda lo ingresado por el usuario en la casilla del correo en una variable.*/
	$email = $_POST['email'];
  /*Guarda lo ingresado por el usuario en la casilla de la clave en una variable.*/
	$password = ($_POST['password']);
  /*Guarda lo ingresado por el usuario en la casilla de la confirmación de la clave en una variable.*/
	$cpassword = ($_POST['cpassword']);

/*AQUÍ SE PREGUNTA SI LA CONTRASEÑA INGRESADA ES IGUAL A LA DE CONFIRMACIÓN.*/
	if ($password == $cpassword) { /*SI LO ES, EJECUTA...*/
    /*HACE UNA BÚSQUEDA A LA BASE DE DATOS CON LOS DATOS INGRESADOS.*/
		$sql = "SELECT * FROM users WHERE email='$email'";
    /*Guarda en una variable la estructura de datos resultado de la función.*/
		$result = mysqli_query($conn, $sql);
    /*Accede al dato de la estructura NUM_ROWS y verifica si existe
    algún dato.*/
		if (!$result->num_rows > 0) { /*SI NO EXISTE EL DATO...*/
      /*INGRESA A LA BASE DE DATOS LOS VALORES REGISTRADOS
      POR EL USUARIO.*/
			$sql = "INSERT INTO users (username, email, password)
					VALUES ('$username', '$email', '$password')";
          /*NUEVAMENTE ACCEDE A LA BASE DE DATOS Y PREGUNTA SI EL DATO
          DEVUELTO ES VERDADERO, ES DECIR, A CONFIRMAR SI LA ESCRITURA
          FUE CORRECTA.*/
			$result = mysqli_query($conn, $sql);
			if ($result) {
				echo "<script>alert('Registro de Usuario completado! Proceda a Iniciar Sesión.')</script>";
				$username = "";
				$email = "";
				$_POST['password'] = "";
				$_POST['cpassword'] = "";
			} else {
				echo "<script>alert('ERROR! Inténtelo de Nuevo')</script>";
			}
		} else {
			echo "<script>alert('ERROR! Email ya registrado.')</script>";
		}

	} else {
		echo "<script>alert('Contraseña NO es correcta!')</script>";
	}
}

?>

<!DOCTYPE html>
<html>
<head>
  <style>
  body  {
  background-image: url("https://www.wallpaperbetter.com/wallpaper/972/685/78/the-great-fresh-air-2K-wallpaper.jpg");
  background-color: #cccccc;
}
  </style>
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
            <p class="login-text" style="font-size: 2rem; font-weight: 800;">REGISTRO EN AERASENS WEB</p>
			<div class="input-group">
        <!--AQUÍ SE DECLARAN LAS CASILLAS OBLIGATORIAS PARA EL REGISTRO-->
        <!--LA LÍNEA PHP ECHO, AYUDA A MOSTRAR LO QUE EL USUARIO INGRESÓ
         RECOMENDANDO QUE DEBE CAMBIAR EL DATO.-->
				<input type="text" placeholder="Username" name="username" value="<?php echo $username; ?>" required>
			</div>
			<div class="input-group">
				<input type="email" placeholder="Correo Electrónico" name="email" value="<?php echo $email; ?>" required>
			</div>
			<div class="input-group">
				<input type="password" placeholder="Clave" name="password" value="<?php echo $_POST['password']; ?>" required>
            </div>
            <div class="input-group">
				<input type="password" placeholder="Confirmar Clave" name="cpassword" value="<?php echo $_POST['cpassword']; ?>" required>
			</div>
      <!--AQUÍ SE MUESTRA EL BOTÓN DE REGISTRO Y EL TIPO DE BOTÓN.-->
			<div class="input-group">
				<button name="submit" class="btn">Registrarse</button>
			</div>
      <!--VÍNCULO AL ARCHIVO DE REGISTRO-->
			<p class="login-register-text"><center>Ya tiene una cuenta con Nosotros? </center><center><a href="index.php">Inicie sesión Aquí.</a></center>.</p>
		</form>
	</div>
</body>
</html>

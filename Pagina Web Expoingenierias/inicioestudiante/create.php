<?php

	//Declaracion de variables
	require 'database.php';

		$nombreError = null;
		$apellidoPError = null;
		$apellidoMError = null;
		$correoError = null;
		$matriculaError   = null;
		$passError = null;
		$confircontraError = null;



	if ( !empty($_POST)) {

		$nombre = $_POST['nombre'];
		$apellidoP = $_POST['apellidoP'];
		$apellidoM = $_POST['apellidoM'];
		$correo = $_POST['correo'];
		$matricula = $_POST['matricula'];
		$pass = $_POST['pass'];
		$confircontra = $_POST['confircontra'];

		// Validar inputs
		$valid = true;

		if (empty($nombre)) {
			$nombreError = 'Ingrese un nombre para continuar';
			$valid = false;
		}
		if (empty($apellidoP)) {
			$apellidoPError = 'Ingrese un apellido paterno para continuar';
			$valid = false;
		}
		if (empty($apellidoM)) {
			$apellidoMError = 'Ingrese un apellido materno para continuar';
			$valid = false;
		}
		if (empty($correo)) {
			$correoError = 'Ingrese un correo para continuar';
			$valid = false;
		}
		if (empty($matricula)) {
			$matriculaError = 'Ingrese una matrícula para continuar';
			$valid = false;
		}
		if (empty($pass)) {
			$passError = 'Ingrese una contraseña para continuar';
			$valid = false;
		}
		if (empty($confircontra)) {
			$confircontraError = 'Vuelva a ingresar su contraseña para continuar';
			$valid = false;
		}

		// Insertar data
		if ($valid) {
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = 'INSERT INTO estudiante (id_estudiante, nombre, apellidoPaterno, apellidoMaterno, correo, contraseña) values(?, ?, ?, ?, ?, ?)';
			$q = $pdo->prepare($sql);
			
			$q->execute(array($matricula, $nombre ,$apellidoP, $apellidoM, $correo, $pass));
			
			Database::disconnect();
			header("Location: index.php");
		}
	}
?>

<script>  
    function verifyPassword() {  
        var pw = document.getElementById("pass").value;
        var vpw = document.getElementById("confircontra").value; 
        //check empty password field  
        if(pw != vpw) {  
            document.getElementById("message").innerHTML = "Las contraseñas no coinciden";  
            return false;   
        }  
        
        //minimum password length validation  
        if(pw.length < 8) {  
            document.getElementById("message").innerHTML = "La contraseña debe tener mas de 8 caracteres";  
            return false;  
        }  
        
        //maximum length of password validation  
        if(pw.length > 50) {  
            document.getElementById("message").innerHTML = "La contraseña no puede tener mas de 50 caracteres";  
            return false;  
        } else {  
            alert("Creación de cuenta exitosa");  
        }  
    }  
</script>  

<!DOCTYPE html>
<html>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href='https://fonts.googleapis.com/css?family=Inter' rel='stylesheet'>

	<head>
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<link rel="icon" href="img/miniicon.png">
		<title>Registrar Estudiante</title>
		<meta charset = "utf-8" />
	</head>

	<body>

        <div class="scrollogo">
			<table align="center">
				<tr>
					<td align="center" style="width: 33.33%;"><h1 style="font-size: 35px;"><strong>Registrar Estudiante</strong></h1></td>
					<td align="center" style="width: 33.33%;" class="logo"> <img src="https://admision.tec.mx/expo-ingenierias/images/logo-expo.svg" style="width: 45%;"></td>
					<td align="center" style="width: 33.33%;"> <img src="https://javier.rodriguez.org.mx/itesm/2014/tecnologico-de-monterrey-blue.png" style="width: 45%;"></td>
				</tr>
			</table>
			<hr size="4px" color="#b8b4b4">
		</div>

		<form class="form-horizontal" action="create.php" method="post" onsubmit ="return verifyPassword()">

            <center>
                <div align="left">
                    <p style="color:#646464"><strong> Nombre(s) y apellidos</strong>
                </div>
            </center>

            <center>
                <div align="center">
                    <input type="text" id="nombre" name="nombre" required maxlength="30" placeholder="  Nombre(s)" size="50"  class="input" value="<?php echo !empty($nombre)?$nombre:'';?>">
                    <?php if (($nombreError != null)) ?>
                        <span class="help-inline"><?php echo $nombreError;?></span>
                </div>
            </center>

            <center>
                <div align="center">
                    <input type="text" id="apellidoP" name="apellidoP" required maxlength="30" placeholder="  Apellido Pat." size="50" class="input2" value="<?php echo !empty($apellidoP)?$apellidoP:'';?>"><input type="text" id="apellidoM" name="apellidoM" required maxlength="30" placeholder="  Apellido Mat." size="50" class="input2" value="<?php echo !empty($apellidoM)?$apellidoM:'';?>">
                        <?php if (($apellidoPError != null)) ?>
                            <span class="help-inline"><?php echo $apellidoPError;?></span>
                        <?php if (($apellidoPError != null)) ?>
                            <span class="help-inline"><?php echo $apellidoMError;?></span>
                </div>
            </center>

            <center>
                <div align="left">
                    <p style="color:#646464"><strong> Correo electrónico</strong>
                </div>
            
            </center>
            
            <center>
                <div align="center">
                    <input type="text" id="correo" name="correo" required maxlength="30" placeholder="  Identificador" size="70" class="input" value="<?php echo !empty($correo)?$correo:'';?>">
                        <?php if (($correoError != null)) ?>
                            <span class="help-inline"><?php echo $correoError;?></span>
                </div>      
            </center>

            <center>
                <div align="left">
                    <p style="color:#646464"><strong> Matricula</strong>
                </div>
            </center>    

            <center>
                <div align="center">
                    <input type="text" id="matricula" name="matricula" required maxlength="30" placeholder="  XXXXXXXXX" size="10" class="input" value="<?php echo !empty($matricula)?$matricula:'';?>">
                        <?php if (($matriculaError != null)) ?>
                            <span class="help-inline"><?php echo $matriculaError;?></span>
                </div>
            </center>

			
            <center>
                <div align="left">
                    <p style="color:#646464"><strong> Contraseña</strong>
                </div>
            </center>    

            <center>
                <div align="center">
                    <input type="password" id="pass" name="pass" required maxlength="30" placeholder="  contraseña" size="70" class="input" value="<?php echo !empty($pass)?$pass:'';?>">
                        <?php if (($passError != null)) ?>
                            <span class="help-inline"><?php echo $passError;?></span>
                </div>
            </center>

			
            <center>
                <div align="left">
                    <p style="color:#646464"><strong> Confirma tu contraseña</strong>
                </div>
            </center>    

            <center>
                <div align="center">
                    <input type="password" id="confircontra" name="confircontra" required maxlength="30" placeholder="  Vuelve a escribir tu clave" size="70" class="input" value="<?php echo !empty($confircontra)?$confircontra:'';?>">
						<?php if (($confircontraError != null)) ?>
                            <span class="help-inline"><?php echo $confircontraError;?></span>
                </div>
            </center>

			<center>
                <div align="center">
					<span id = "message" style="color: #646464"><strong> </strong></span>
                </div>
            </center>
            
            <br>

            <center>
                <div class="botonborde">
                    <button align="center" class="botonfinal" id="botonfinal" type="submit"><strong>Crear cuenta</strong></button>
                </div>
            </center>

            <br>

            <center>
                <div class="botonborde2">
                    <button align="center" class="botonfinal2"><strong><a href="index.php" class="alv">Regresar</a></strong></button>
                </div>
            </center>
			
		</form>

		<p class="footer">@2023<a href="https://tec.mx/es">Tecnológico de Monterrey.</a></p>

	</body>

</html>
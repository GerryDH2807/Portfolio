<?php

	//Declaracion de variables
	require 'database.php';

	$id = null;
	if ( !empty($_GET['id'])) {
		$id = $_REQUEST['id'];
	}

	if($id=="Estudiante"){$xd=" A seguida de 8 números.";}
	elseif($id=="Juez"){$xd=" X seguida de 8 números.";}
	elseif($id=="Profesor"){$xd=" L seguida de 8 números.";}
	

		$nombreError = null;
		$apellidoPError = null;
		$apellidoMError = null;
		$correoError = null;
		$matriculaError   = null;

	if ( !empty($_POST)) {

		$nombre = $_POST['nombre'];
		$apellidoP = $_POST['apellidoP'];
		$apellidoM = $_POST['apellidoM'];
		$correo = $_POST['correo'];
		$matricula = $_POST['matricula'];

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
		if (empty($matricula)||strlen($matricula)!=9||($id=="Estudiante" and $matricula[0]!="A")||($id=="Profesor" and $matricula[0]!="L")||($id=="Juez" and $matricula[0]!="X")) {
			$matriculaError = 'Ingrese una matrícula correcta para continuar.';
			$valid = false;
		}
		
		// Insertar data
		if ($valid) {

			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			if($matricula[0]=="A" and strlen($matricula)==9){	
				// delete data
				$sql2 = 'INSERT INTO estudiante (id_estudiante, nombre, apellidoPaterno, apellidoMaterno, correo) values(?, ?, ?, ?, ?)';
				$q2 = $pdo->prepare($sql2);
				$q2->execute(array($matricula, $nombre ,$apellidoP, $apellidoM, $correo));
				Database::disconnect();
				header("Location: http://lab403azms01.itesm.mx/TC2005B_401_3/Gerry/incioadmin/admin.php");

			}

			elseif($matricula[0]=="L"){
				// delete data
				$sql4 = 'INSERT INTO profesor (id_profesor, nombre, apellidoPaterno, apellidoMaterno, correo) values(?, ?, ?, ?, ?)';
				$q4 = $pdo->prepare($sql4);
				$q4->execute(array($matricula, $nombre ,$apellidoP, $apellidoM, $correo));
				Database::disconnect();
				header("Location: http://lab403azms01.itesm.mx/TC2005B_401_3/Gerry/incioadmin/admin.php");
			}

			elseif($matricula[0]=="X"){
				// delete data
				$sql5 = 'INSERT INTO juez (id_juez, nombre, apellidoPaterno, apellidoMaterno, correo) values(?, ?, ?, ?, ?)';
				$q5 = $pdo->prepare($sql5);
				$q5->execute(array($matricula, $nombre ,$apellidoP, $apellidoM, $correo));
				Database::disconnect();
				header("Location: http://lab403azms01.itesm.mx/TC2005B_401_3/Gerry/incioadmin/admin.php");
			}
			
			/*$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = 'INSERT INTO estudiante (id_estudiante, nombre, apellidoPaterno, apellidoMaterno, correo) values(?, ?, ?, ?, ?)';
			$q = $pdo->prepare($sql);
			
			$q->execute(array($matricula, $nombre ,$apellidoP, $apellidoM, $correo));
			
			Database::disconnect();
			header("Location: admin.php");*/
		}

	}
?>


<!DOCTYPE html>
<html>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/min.css">
	<link href='https://fonts.googleapis.com/css?family=Inter' rel='stylesheet'>

	<head>
		<link rel="stylesheet" type="text/css" href="css/main.css">
		<link rel="icon" href="img/miniicon.png">
		<title><?php echo "Añadir ".$id ?></title>
		<meta charset = "utf-8" />
	</head>

	<body>

		<table align="center">

			<tr>
				<td align="center" style="width: 33.33%;"><h1 style="font-size: 35px;"><strong><?php echo "Añadir ".$id ?></strong></h1></td>
				<td align="center" style="width: 33.33%;" class="logo"> <img src="https://admision.tec.mx/expo-ingenierias/images/logo-expo.svg" style="width: 45%;height: 20%;"></td>
				<td align="center" style="width: 33.33%;"> <img src="https://javier.rodriguez.org.mx/itesm/2014/tecnologico-de-monterrey-blue.png" style="width: 45%;height: 20%;"></td>
			</tr>

		</table>

		<hr size="4px" color="#b8b4b4">

		<form class="form-horizontal" action="create.php" method="post">


			<table align="center" width="100%">

				<tr> 
					<td style="width: 33.33%;"></td>
					<td align="left"><p style="color:#646464"><strong> Nombre(s) y apellidos</strong></td>
					<td style="width: 33.33%;"></td>
				</tr>

				<tr> 
					<td style="width: 33.33%;"></td>
					<td align="left"><input type="text" id="nombre" name="nombre" required maxlength="30" placeholder="  Nombre(s)" size="50"  class="input" value="<?php echo !empty($nombre)?$nombre:'';?>">
					<?php if (($nombreError != null)) ?>
						<span class="help-inline"><?php echo $nombreError;?></span>
					</td> 
					<td style="width: 33.33%;"></td>
				</tr>

				<tr>
					<td style="width: 33.33%;"></td>
					<td align="left"><input type="text" id="apellidoP" name="apellidoP" required maxlength="30" placeholder="  Apellido Pat." size="50" class="input2" value="<?php echo !empty($apellidoP)?$apellidoP:'';?>"><input type="text" id="apellidoM" name="apellidoM" required maxlength="30" placeholder="  Apellido Mat." size="50" class="input2" value="<?php echo !empty($apellidoM)?$apellidoM:'';?>">
					<?php if (($apellidoPError != null)) ?>
						<span class="help-inline"><?php echo $apellidoPError;?></span>
					<?php if (($apellidoPError != null)) ?>
						<span class="help-inline"><?php echo $apellidoMError;?></span>
					</td> 
					<td style="width: 33.33%;"></td>
				</tr>

				<tr> 
					<td style="width: 33.33%;"></td>
					<td align="left"><p style="color:#646464"><strong> Correo electrónico</strong></td>
					<td style="width: 33.33%;"></td>
				</tr>

				<tr> 
					<td style="width: 33.33%;"></td>
					<td align="left"><input type="text" id="correo" name="correo" required maxlength="30" placeholder="  Correo" size="70" class="input">
					<?php if (($correoError != null)) ?>
						<span class="help-inline"><?php echo $correoError;?></span>
					</td> 
					<td style="width: 33.33%;"></td>
				</tr>

				<tr>
					<td style="width: 33.33%;"></td>
					<td align="left"><p style="color:#646464"><strong> Matricula / Nómina / Identificador </strong></td>
					<td style="width: 33.33%;"></td>
				</tr>

				<tr> 
					<td style="width: 33.33%;"></td>
					<td align="left"><input type="text" id="matricula" name="matricula" required maxlength="30" placeholder="<?php echo $xd ?>" size="70" class="input" value="<?php echo !empty($matricula)?$matricula:'';?>">
					<?php if (($matriculaError != null)) ?>
						<span class="help-inline"><?php echo $matriculaError;?></span>
					</td> 
					<td style="width: 33.33%;"></td>
				</tr>

	

				<tr>
					<td style="height: 15px;">

					</td>
				</tr>

				<tr> 
					<td style="width: 33.33%;"></td>
					<td align="center" class="botonborde" style="width: 33.33%;"><button align="center" class="botonfinal" id="botonfinal" type="submit"><strong>Añadir</strong></button></td>
					<td style="width: 33.33%;"></td>
				</tr>
				
				<tr>
					<td style="height: 15px;">

					</td>
				</tr>

				<tr> 
					<td style="width: 33.33%;"></td>
					<td align="center" class="botonborde2" style="width: 33.33%;"><button align="center" class="botonfinal2"><strong><a href="admin.php" class="alv">Regresar</a></strong></button></td>
					<td style="width: 33.33%;"></td>
				</tr>

			</table>
		</form>
		<p class="footer">@2023<a href="https://tec.mx/es">Tecnológico de Monterrey.</a></p>
	</body>
</html>

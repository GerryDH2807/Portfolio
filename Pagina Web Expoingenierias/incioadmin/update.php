<?php

	require 'database.php';

	$id = null;
	if ( !empty($_GET['id'])) {
		$id = $_REQUEST['id'];
	}

	if ( $id==null ) {
		header("Location: admin.php");
	}

	if($id[0]=="A"){$xd=" Estudiante";}
	elseif($id[0]=="L"){$xd=" Profesor";}
	elseif($id[0]=="X"){$xd=" Juez";}

	if ( !empty($_POST)) {
		// keep track validation errors
		$idError   = null; // id as id_estudiante
		$nombreError = null;
		$apellidoPError = null;
		$apellidoMError = null;
		$correoError = null;
		

		// keep track post values
		
		$id   = $_POST['id'];
		$nombre = $_POST['nombre'];
		$apellidoP = $_POST['apellidoP'];
		$apellidoM = $_POST['apellidoM'];
		$correo = $_POST['correo'];

                 echo $id;
                 echo $nombre;
                 echo $apellidoP;
                 echo $apellidoM;
                 echo $correo;
                 
		/// validate input
		$valid = true;
                 
		/*if (empty($idError)) {
			$idError = 'Escribe bien las mierdas que se te piden o largate a la verga.';
			$valid = false;
		}*/

		if (empty($nombre)) {
			$nombreError = 'Porfavor escribe tu nombre';
			$valid = false;
		}

		if (empty($apellidoP)) {
			$apellidoPError = 'Porfavor escribe tu apellido Paterno';
			$valid = false;
		}
		if (empty($apellidoM)) {
			$apellidoMError = 'Porfavor escribe tu apellido Materno';
			$valid = false;
		}
		if (empty($correo)) {
			$correoError = 'Porfavor escribe tu correo';
			$valid = false;
		}

		// update data
		if ($valid) {

			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
			if($id[0]=="A"){	
				$sql2 = "UPDATE estudiante  set nombre = ?, apellidoPaterno =?, apellidoMaterno =?, correo= ? WHERE id_estudiante = ?";
				$q2 = $pdo->prepare($sql2);
				$q2->execute(array($nombre,$apellidoP,$apellidoM,$correo, $id));
			}
	
			elseif($id[0]=="L"){
				
				$sql4 = "UPDATE profesor set nombre = ?, apellidoPaterno =?, apellidoMaterno =?, correo= ? WHERE id_profesor = ?";
				$q4 = $pdo->prepare($sql4);
				$q4->execute(array($nombre,$apellidoP,$apellidoM,$correo, $id));
			}
	
			elseif($id[0]=="X"){
				//$id = ltrim($id, 'X');
				
				$sql5 = "UPDATE juez set nombre = ?, apellidoPaterno =?, apellidoMaterno =?, correo= ? WHERE id_juez = ?";
				$q5 = $pdo->prepare($sql5);
				$q5->execute(array($nombre,$apellidoP,$apellidoM,$correo, $id));
			}
	
			Database::disconnect();
			header("Location: admin.php");

			/*$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "UPDATE estudiante  set nombre = ?, apellidoPaterno =?, apellidoMaterno =?, correo= ? WHERE id_estudiante = ?";
			$q = $pdo->prepare($sql);
			$q->execute(array($nombre,$apellidoP,$apellidoM,$correo, $id));
			Database::disconnect();
			header("Location: admin.php");*/
		}
	}

	else {

		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
		if($id[0]=="A"){	
			$sql2 = "SELECT * FROM estudiante where id_estudiante = ?";
			$q2 = $pdo->prepare($sql2);
			$q2->execute(array($id));
			$data = $q2->fetch(PDO::FETCH_ASSOC);
			$id 	= $data['id_estudiante'];
			$nombre = $data['nombre'];
			$apellidoP = $data['apellidoPaterno'];
			$apellidoM = $data['apellidoMaterno'];
			$correo = $data['correo'];
		}

		elseif($id[0]=="L"){
			$sql4 = "SELECT * FROM profesor where id_profesor = ?";
			$q4 = $pdo->prepare($sql4);
			$q4->execute(array($id));
			$data = $q4->fetch(PDO::FETCH_ASSOC);
			$id 	= $data['id_profesor'];
			$nombre = $data['nombre'];
			$apellidoP = $data['apellidoPaterno'];
			$apellidoM = $data['apellidoMaterno'];
			$correo = $data['correo'];
		}

		elseif($id[0]=="X"){
			//$id = ltrim($id, 'X');
			$sql5 = "SELECT * FROM juez where id_juez = ?";
			$q5 = $pdo->prepare($sql5);
			$q5->execute(array($id));
			$data = $q5->fetch(PDO::FETCH_ASSOC);
			$id 	= $data['id_juez'];
			$nombre = $data['nombre'];
			$apellidoP = $data['apellidoPaterno'];
			$apellidoM = $data['apellidoMaterno'];
			$correo = $data['correo'];
			//$id = 'X'.$id;
		}

		Database::disconnect();
		//header("Location: admin.php");

		/*
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * FROM estudiante where id_estudiante = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($id));
		$data = $q->fetch(PDO::FETCH_ASSOC);
		$id 	= $data['id_estudiante'];
		$nombre = $data['nombre'];
		$apellidoP = $data['apellidoPaterno'];
		$apellidoM = $data['apellidoMaterno'];
		$correo = $data['correo'];
		Database::disconnect();*/
	}
?>


<!DOCTYPE html>
<html lang="en">
	<head>
	    <meta 	charset="utf-8">
		<link rel="stylesheet" href="css/estilazo.css">
		<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
	    <link   href=	"css/diseno.css" rel="stylesheet">
	    <script src=	"js/bootstrap.min.js"></script>
		<title><?php echo "Modificar".$xd ?></title>
		<link rel="icon" href="img/miniicon.png">
	</head>

	<body >
		<navbar>
			<div id="navbar">
				<img src="https://javier.rodriguez.org.mx/itesm/2014/tecnologico-de-monterrey-blue.png"> 
				<img src="https://i.imgur.com/UcHOarZ.png">
			</div>
		</navbar>
		<navbar>
			<div id="navbarAzul">
				<img src="img/logo-expo.svg">
				<a href=""><?php echo "Modificar".$xd ?></a>
				<a href="admin.php"><span class="material-symbols-outlined">home</span>MiAdmin</a>
			</div>
		</navbar>
    	<div class="center">
    		<div class="center2">
	    			<form class="form" action="update.php?id=<?php echo $id?>" method="post">
<!--  id -->
					  <div class="padding" <?php echo !empty($f_idError)?'error':'';?>>

					    <label class="subtitulo1">ID</label>
					    <div class="padding2" >
					      	<input class="input" name="id" type="text" readonly placeholder="id" value="<?php echo !empty($id)?$id:''; ?>">
					      	<?php if (!empty($f_idError)): ?>
					      		<span ><?php echo $f_idError;?></span>
					      	<?php endif; ?>
					    </div>
					  </div>
<!-- NOMBRE -->
					  <div class="padding" <?php echo !empty($nombreError)?'error':'';?>>

					    <label class="subtitulo1">NOMBRE</label>

					    <div class="padding2">
					      	<input class="input" name="nombre" type="text" placeholder="nombre" value="<?php echo !empty($nombre)?$nombre:'';?>">
					      	<?php if (!empty($nombreError)): ?>
					      		<span ><?php echo $nombreError;?></span>
					      	<?php endif;?>
					    </div>
					  </div>
<!-- APELLIDO PATERNO -->
					  <div class="padding" <?php echo !empty($apellidoPError)?'error':'';?>>

					    <label class="subtitulo1">PATERNO</label>
					    <div class="padding2">
					      	<input class="input" name="apellidoP" type="text" placeholder="apellidoP" value="<?php echo !empty($apellidoP)?$apellidoP:'';?>">
					      	<?php if (!empty($apellidoPError)): ?>
					      		<span ><?php echo $apellidoPError;?></span>
					      	<?php endif;?>
					    </div>
					  </div>
<!-- APELLIDO MATERNO -->
					  <div class="padding" <?php echo !empty($apellidoMError)?'error':'';?>>

					    <label class="subtitulo1">MATERNO</label>
					    <div class="padding2">
					      	<input class="input" name="apellidoM" type="text" placeholder="apellidoM" value="<?php echo !empty($apellidoM)?$apellidoM:'';?>">
					      	<?php if (!empty($apellidoMError)): ?>
					      		<span ><?php echo $apellidoMError;?></span>
					      	<?php endif;?>
					    </div>
					  </div>
<!-- CORREO -->
					  <div class="padding" <?php echo !empty($correoError)?'error':'';?>>

					    <label class="subtitulo1">CORREO ELECTRONICO</label>
					    <div class="padding2">
					      	<input class="input" name="correo" type="text" placeholder="correo" value="<?php echo !empty($correo)?$correo:'';?>">
					      	<?php if (!empty($correoError)): ?>
					      		<span ><?php echo $correoError;?></span>
					      	<?php endif;?>
					    </div>
					  </div>
					  
                      <br>
					  <div class="center2">
						  <button type="submit" class="boton">Actualizar</button>
						  <a style="text-decoration:none;" class="boton" href="admin.php">Regresar</a>
						</div>
					</form>
				</div>

    </div> <!-- /container -->
  </body>
</html>

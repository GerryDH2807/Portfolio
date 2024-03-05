<?php

	require 'database.php';

	$id = 0;
	if ( !empty($_GET['id'])) {
		$id = $_REQUEST['id'];
	}

	if($id[0]=="A"){$xd=" Estudiante";}
	elseif($id[0]=="L"){$xd=" Profesor";}
	elseif($id[0]=="X"){$xd=" Juez";}

	if(!empty($_POST)){

		$id = $_POST['id'];	

		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		if($id[0]=="A"){
			$id = $_POST['id'];		
			// delete data
			$sql2 = "DELETE FROM estudiante WHERE id_estudiante = ?";
			$q2 = $pdo->prepare($sql2);
			$q2->execute(array($id));
		}

		elseif($id[0]=="L"){
			$id = $_POST['id'];
			// delete data
			$sql4 = "DELETE FROM profesor WHERE id_profesor = ?";
			$q4 = $pdo->prepare($sql4);
			$q4->execute(array($id));
		}

		elseif($id[0]=="X"){
			$id = $_POST['id'];

			//$id = ltrim($id, 'X');
			// delete data
			$sql5 = "DELETE FROM juez WHERE id_juez = ?";
			$q5 = $pdo->prepare($sql5);
			$q5->execute(array($id));
		}

		Database::disconnect();
		header("Location: admin.php");
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
		<title><?php echo "Eliminar".$xd ?></title>
		<link rel="icon" href="img/miniicon.png">
	</head>

	<body>
		<navbar>
			<div id="navbar">
				<img src="https://javier.rodriguez.org.mx/itesm/2014/tecnologico-de-monterrey-blue.png"> 
				<img src="https://i.imgur.com/UcHOarZ.png">
			</div>
		</navbar>
		<navbar>
			<div id="navbarAzul">
				<img src="img/logo-expo.svg">
				<a href=""><?php echo "Eliminar".$xd ?></a>
				<a href="admin.php"><span class="material-symbols-outlined">home</span>MiAdmin</a>
			</div>
		</navbar>
	    <div class="center">
	    	<div class="center2">
			    <form  class="form-horizontal" action="delete.php" method="post">
		    		<input type="hidden" name="id" value="<?php echo $id;?>"/>
					<p class="subtitulo2">¿Estás seguro de que quieres eliminar a este Usuario?</p>
					<br>
					<div class="form-actions">
						<button class="botonrojo" type="submit">Si</button>
						<a style="text-decoration: none;" class="boton" href="admin.php">No</a>
					</div>
				</form>
			</div>	
	  	</div>
	</body>
</html>

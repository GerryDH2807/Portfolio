<?php
	require 'database.php';
	$id = null;
	if ( !empty($_GET['id'])) {
		$id = $_REQUEST['id'];
	}


	if($id[0]=="A"){$xd=" Estudiante";}
	elseif($id[0]=="L"){$xd=" Profesor";}
	elseif($id[0]=="X"){$xd=" Juez";}

	if ( $id==null) {
		header("Location: delete.php");
	} 
	
	else {
		
		$cont = 0;
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		if($id[0]=="A"){	
			// delete data
			$sql2 = "SELECT * FROM estudiante WHERE id_estudiante = ?";
			$q2 = $pdo->prepare($sql2);
			$q2->execute(array($id));
			$data = $q2->fetch(PDO::FETCH_ASSOC);
		}

		elseif($id[0]=="L"){
			// delete data
			$sql4 = "SELECT * FROM profesor WHERE id_profesor = ?";
			$q4 = $pdo->prepare($sql4);
			$q4->execute(array($id));
			$data = $q4->fetch(PDO::FETCH_ASSOC);
		}

		elseif($id[0]=="X"){
			$cont = 1;
			//$id = ltrim($id, 'X');
			// delete data
			$sql5 = "SELECT * FROM juez WHERE id_juez = ?";
			$q5 = $pdo->prepare($sql5);
			$q5->execute(array($id));
			$data = $q5->fetch(PDO::FETCH_ASSOC);
		}
	
		Database::disconnect();
	}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
	    <meta 	charset="utf-8">
	    <link rel="stylesheet" href="css/estilazo.css">
		<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
	    <link   href=	"css/bootstrap.min.css" rel="stylesheet">
	    <script src=	"js/bootstrap.min.js"></script>
		<title><?php echo "Detalles del".$xd ?></title>
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
				<a href=""><?php echo "Detalles del".$xd ?></a>
				<a href="admin.php"><span class="material-symbols-outlined">home</span>MiAdmin</a>
			</div>
		</navbar>
		<br>
    	<div class="container">

    		<div class="span10 offset1">
	    		<div class="form-horizontal" >
<!-- MATRICULA-->

				<?php

					if($id[0]=="A"){	
						echo '<div class="control-group">';
							echo '<label class="control-label">Matricula</label>';
							echo '<div class="controls">';
								echo '<label class="checkbox">';
									echo $data['id_estudiante'];
								echo '</label>';
							echo '</div>';
						echo '</div>';
					}

					elseif($id[0]=="L" and $cont==0){
						echo '<div class="control-group">';
							echo '<label class="control-label">Matricula</label>';
							echo '<div class="controls">';
								echo '<label class="checkbox">';
									echo $data['id_profesor'];
								echo '</label>';
							echo '</div>';
						echo '</div>';
					}

					elseif($cont==1){
						//$id = ltrim($id, 'X');
						echo '<div class="control-group">';
							echo '<label class="control-label">Identificador</label>';
							echo '<div class="controls">';
								echo '<label class="checkbox">';
									echo $data['id_juez'];
								echo '</label>';
							echo '</div>';
						echo '</div>';
					}

				?>
<!--NOMBRE-->
					<div class="control-group">
					    <label class="control-label">Nombre(s)</label>
					    <div class="controls">
					      	<label class="checkbox">
						     	<?php echo $data['nombre'];?>
						    </label>
					    </div>
					</div>
<!-- APELLIDO PATERNO-->
					<div class="control-group">
					    <label class="control-label">Apellido Paterno</label>
					    <div class="controls">
					      	<label class="checkbox">
						     	<?php echo $data['apellidoPaterno'];?>
						    </label>
					    </div>
					</div>
<!-- APELLIDO MATERNO-->
					<div class="control-group">
					    <label class="control-label">Apellido Materno</label>
					    <div class="controls">
					      	<label class="checkbox">
						     	<?php echo $data['apellidoMaterno'];?>
						    </label>
					    </div>
					</div>
<!-- Correo-->
					<div class="control-group">
					    <label class="control-label">Correo</label>
					    <div class="controls">
					      	<label class="checkbox">
						     	<?php echo $data['correo'];?>
						    </label>
					    </div>
					</div>

				    <div class="form-actions">
						<a class="btn" href="admin.php">Regresar</a>
					</div>

				</div>
			</div>
		</div> <!-- /container -->
  	</body>
</html>

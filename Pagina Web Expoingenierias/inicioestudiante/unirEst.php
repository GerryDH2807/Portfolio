<?php
     	session_start();
		$_SESSION['color'];

		$color = $_SESSION['color'];
	require 'database.php';
	$idError   = null;
	$proyectoError = null;


	if ( !empty($_GET['id'])) {
		$id = $_REQUEST['id'];
	}

	if ( !empty($_POST)) {
                 
		$id = $_POST['id'];
		$proyecto = $_POST['proyecto'];
		

		// Validar inputs
		$valid = true;
		if (empty($proyecto)) {
			$proyectoError = 'Ingrese una matrícula para continuar';
			$valid = false;
		}

		// Insertar data
		if ($valid) {
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = 'INSERT INTO miembrosProyecto (id_proyecto, id_estudiante ) values(?, ?)';
			$q = $pdo->prepare($sql);
			$q->execute(array($proyecto, $id));
			Database::disconnect();
			header("Location: indexEst.php?id=$color");
		}

	}

?>

<!DOCTYPE html>
<html lang="en">
<link href='https://fonts.googleapis.com/css?family=Inter' rel='stylesheet'>
	<head>
	    <meta 	charset="utf-8">
		<title>MiEstudiante</title>
    <link rel="stylesheet" href="css/dani.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"rel="stylesheet">
	</head>

	<body>

	<!--INICIO DEL ENCABEZADO -->	
	<navbar>
	<div id="navbarAzull">
            <img src="https://javier.rodriguez.org.mx/itesm/2014/tecnologico-de-monterrey-blue.png"> 	
        </div>
    </navbar>
    <navbar>
        <div id="navbarAzul">
            <img src="img/logo-expo.svg">
            <a href="indexEst.php?id=<?php echo $color;?>"><span class="material-symbols-outlined">home</span>MiEstudiante</a>
               </div>
    </navbar>
	<br>
	<h1 style="color: #082460">
      &nbsp &nbsp Unirme a un proyecto
  </h1>
 <br>    
 <form class="form-horizontal" action="unirEst.php?id=<?php echo $id?>" method="post">


<table align="center" style="width: 23%;">
	<tr style="width: 33.33%;">
		<td style="width: 33.33%;"></td>
		<td  style="width: 33.33%;" class="tabh" align="center"><p style="color:#ffffff"><strong> Tu Matricula</strong></td>
		<td style="width: 33.33%;"></td>
	</tr>

	<tr> 
		<td style="width: 33.33%;"></td>
		<td class="tabd" align="center"><input class="tabd" type="text" id="id" name="id" required maxlength="30" readonly placeholder="  AXXXXXXXX" size="70" class="input" value="<?php echo !empty($id)?$id:'';?>">
		<?php if (($idError != null)) ?>
			<span class="help-inline"><?php echo $idError;?></span>
		</td> 
		<td style="width: 33.33%;"></td>
	</tr>


	<tr> 
		<td style="width: 33.33%;"></td>
		<td style="width: 33.33%;" class="tabh" align="center"><p style="color:#ffffff"><strong> Id del Proyecto</strong></td>
		<td style="width: 33.33%;"></td>
	</tr>

	<tr> 
		<td style="width: 33.33%;"></td>
		<td style="width: 33.33%;" class="tabd" align="center"><input class="tabd" type="text" id="proyecto" name="proyecto" required maxlength="30"  placeholder="  Identificador del proyecto" size="70" class="input">
		<?php if (($correoError != null)) ?>
			<span class="help-inline"><?php echo $proyectoError;?></span>
		</td> 
		<td style="width: 33.33%;"></td>
	</tr>

	<tr>
		<td style="height: 50px;">

		</td>
	</tr>

	<tr> 
		<td style="width: 33.33%;"></td>
		<td align="center" class="botonbordeC" style="width: 33.33%;"><button align="center" class="botonfinalC" id="botonfinalC" type="submit"><strong>Añadir Estudiante</strong></button></td>
		<td style="width: 33.33%;"></td>
	</tr>

</table>
</form>
</body>
</html>
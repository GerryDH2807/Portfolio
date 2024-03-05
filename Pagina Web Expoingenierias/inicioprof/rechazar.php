<?php
     	session_start();
		$_SESSION['color'];

		$color = $_SESSION['color'];
	require 'database.php';


	if ( !empty($_GET['id'])) {
		$id = $_REQUEST['id'];
	}

	if ( !empty($_POST)) {
		// keep track post values
		$id = $_POST['id'];
		// delete data
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql1 = "UPDATE status Set status='Rechazado' WHERE id_proyecto = ?";
		$q1 = $pdo->prepare($sql1);
		$q1->execute(array($id));
		Database::disconnect();
		header("Location: indexProf.php?id=$color");
	}

?>

<!DOCTYPE html>
<html lang="en">
<link href='https://fonts.googleapis.com/css?family=Inter' rel='stylesheet'>
	<head>
	    <meta 	charset="utf-8">
		<title>Rechazar Proyecto</title>
		<link rel="stylesheet" href="css/dani.css">
		<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons"rel="stylesheet">
		<link rel="icon" href="img/miniicon.png">
	</head>

	<body>
	<!--INICIO DEL ENCABEZADO -->	
	<navbar>
	<div id="navbarAzull">
            <img src="https://javier.rodriguez.org.mx/itesm/2014/tecnologico-de-monterrey-blue.png"> 
            <a href="readProf.php?id=<?php echo $color;?>"><span class="material-symbols-outlined">person</span></a>       </div>
        </div>
    </navbar>
    <navbar>
        <div id="navbarAzul">
            <img src="img/logo-expo.svg">
            <a href="indexProf.php?id=<?php echo $color;?>"><span class="material-symbols-outlined">home</span>MiProfesor</a>
               </div>
    </navbar>
 <br>    

<!--FIN DEL ENCABEZADO -->
	<center>
	    <div class="center">
	    	<div class="center2">
	    		<div >
			    	<h3 class="titulo1">Rechazar Proyecto</h3>
			    </div>

			    <form  action="rechazar.php" method="post">
		    		<input type="hidden" name="id" value="<?php echo $id;?>"/>
					<p class="subtitulo2">¿Estás seguro de que quieres rechazar este proyecto?</p>
					<br>
					<div >
						<button  style="width: 3%;" class="botonfinalD" id="botonfinalD" type="submit">Si</button>
						<a style="width: 3%; heigth:3%;" href="vistaProf.php?id=<?php echo $id;?>">No</a>
					</div>
				</form>

			</div>	
			</div>	
	  </div>
	  </center>
	</body>
</html>

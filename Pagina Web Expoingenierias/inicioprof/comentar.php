<?php
     	session_start();
		 $_SESSION['color'];
     $color =$_SESSION['color'];
require 'database.php';

	$id = null;
	if ( !empty($_GET['id'])) {
		$id = $_REQUEST['id'];
	}

	if ( $id==null ) {
		header("Location: indexProf.php?id=$color");
	}
	
$q5Error = NULL;



	
	if (!empty($_POST)) {
	
	    $q5 = $_POST['q5'];
     
		
		$valid = true;

		if ($valid) {
            $result1 = $q5;

            if ($result1 == NULL) {
            $result1 = "Sin comentarios";
            }
    
		
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql1 = "UPDATE status set retroprof = ?  WHERE id_proyecto = ?";
			$q1 = $pdo->prepare($sql1);
			$q1->execute(array($result1, $id));
			Database::disconnect();
			header("Location: vistaProf.php?id=$id");
		}
	
	}
	
?>

<!DOCTYPE html>
<html>

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
        <div id="navbar">
            <img src="https://javier.rodriguez.org.mx/itesm/2014/tecnologico-de-monterrey-blue.png"> 
        </div>
    </navbar>
    <navbar>
        <div id="navbarAzul">
            <img src="img/logo-expo.svg">
            <a href="indexProf.php?id=<?php echo $color;?>"><span class="material-symbols-outlined">home</span>MiProfesor</a>
               </div>
    </navbar>

<!--FIN DEL ENCABEZADO -->


<form class="form-horizontal" action="comentar.php?id=<?php echo $id?>" method="post">

    <center>

      <td style="width: 45%;">
        <h2 style="color:#082460">
          <center style="font-size: 35px;">
            <br></br>
            Comentarios y retroalimentación
          </center>
        </h2>
      </td>
      <tr>
        <td>
          <input class=" input2" name = "q5" style="width: 100% height: 100% "></input>
        </td>
      </tr>
    </center>
<br>
<br>
<center>
<table style="width: 10%;">
<th  class="botonbordeV" style=" text-align: center;">

          <button type="submit"
          class="botonfinalV" id="botonfinalV"><strong>Enviar</strong></button>
        </th>    
</table>
</center>

  </form>


</body>

</html>
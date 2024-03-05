<?php
     	session_start();
       $_SESSION['color'];
   
       $color = $_SESSION['color'];
require 'database.php';

	$id = null;
	if ( !empty($_GET['id'])) {
		$id = $_REQUEST['id'];
	}

	if ( $id==null ) {
		header("Location: indexJ.php?id=$color");
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
			$sql1 = "UPDATE califica set retrojuez = ?  WHERE id_proyecto = ?";
			$q1 = $pdo->prepare($sql1);
			$q1->execute(array($result1, $id));
			Database::disconnect();
			header("Location: indexJ.php?id=$color");
		
		}
		
		else {
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "SELECT * califica where id_proyecto = ?";
			$q = $pdo->prepare($sql);
			$q->execute(array($id));
			$data = $q->fetch(PDO::FETCH_ASSOC);
			$id 	= $data['id_proyecto'];
			Database::disconnect();
		}
	
	}
	
?>

<!DOCTYPE html>
<html>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!--Paquete de íconos usado-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href='https://fonts.googleapis.com/css?family=Inter' rel='stylesheet'>



<head>
<title>Calificar Proyecto.Juez</title>
        <link rel="stylesheet" type="text/css" href="css/style2.css">
        <link rel="icon" href="img/miniicon.png">
    </head>

<header>
	
	<section class="w3-threequarter w3-padding-large w3-right"> <!--NO FUNCIONA BIEN EL SIDEBAR-->
        <!--DESKTOP NAVIGATION-->
        <div class="w3-container w3-padding-large w3-border-bottom w3-hide-small">
  
          
</header>

<body>
    <table align="center" width="100%" class="logos">
      <tr>
        <td align="center" style="width: 50%;" class="logo"> <img src="img/logo-expo.png" style="width: 45%;height: 20%;"></td>
        <td align="center" style="width: 50%;" class="logo"> <img src="img/logotec.png" style="width: 45%;height: 80%;"></td>

      </tr>
    </table>
        <hr size="4px" color=#b8b4b4>

        <h2 style="color:#082460">


<form class="form-horizontal" action="Comentarios.php?id=<?php echo $id?>" method="post">

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

<center>
      <tr>
        <td  style="text-align: center;">
          <br></br>
          <button type="submit" style="color:#FFFFFF"
            class="btn"><strong>Enviar</strong></button>
        </td>
		    
</tr>
</center>

  </form>

  <tr>
		<a href="indexJ.php?id=<?php echo $color;?>" style="color:#FFFFFF"class="btn" id="nigger"><strong>Back</strong></a>
	</tr>


</body>

</html>

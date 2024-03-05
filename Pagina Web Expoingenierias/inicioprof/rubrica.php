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
	
	$q0Error = NULL;
	$q1Error = NULL;
	$q2Error = NULL;
	$q3Error = NULL;
	$q4Error = NULL;
$q5Error = NULL;



	
	if (!empty($_POST)) {
	
		$q0 = $_POST['q0'];
		$q1 = $_POST['q1'];
		$q2 = $_POST['q2'];
		$q3 = $_POST['q3'];
		$q4 = $_POST['q4'];
	    $q5 = $_POST['q5'];
     
		
		$valid = true;
		
		if (empty($q0)) {
			$q0Error = 'Favor de seleccionar el rubro';
			$valid = false;
		}
		if (empty($q1)) {
			$q1Error = 'Favor de seleccionar el rubro';
			$valid = false;
		}
		if (empty($q2)) {
			$q2Error = 'Favor de seleccionar el rubro';
			$valid = false;
		}
		if (empty($q3)) {
			$q3Error = 'Favor de seleccionar el rubro';
			$valid = false;
		}
		if (empty($q4)) {
			$q4Error = 'Favor de seleccionar el rubro';
			$valid = false;
		}


		
		if ($valid) {
		
			$result = ($q0 + $q1 + $q2 + $q3 + $q4)/5;

		
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "UPDATE califica set calificacion = ?  WHERE id_proyecto = ?";
			$q = $pdo->prepare($sql);
			$q->execute(array($result, $id));
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
    </head>

<header>
	
	<section class="w3-threequarter w3-padding-large w3-right"> <!--NO FUNCIONA BIEN EL SIDEBAR-->
        <!--DESKTOP NAVIGATION-->
        <div class="w3-container w3-padding-large w3-border-bottom w3-hide-small">

	<link rel="icon" href="img/miniicon.png">
          
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
    <td style="width: 45%;">
      <h2 style="color:#082460">
        <center style="font-size: 35px;">
          Rúbrica
        </center>
      </h2>
    </td>
<?php echo $color;?>

<form class="form-horizontal" action="rubrica.php?id=<?php echo $id?>" method="post">
    <table align="center">
      <tr>
        <th width="33%"></th>
        <th bgcolor=#808080>No cumple</th>
        <th bgcolor=#808080>Deficiente</th>
        <th bgcolor=#808080>Aceptable</th>
        <th bgcolor=#808080>Cumple Completamente</th>

      </tr>
    <li>
        <ul class="choices">
            
      <tr>
      	<div class="control-group <?php echo !empty($q0Error)?'error':'';?>">
	<td>Utilidad: El proyecto resuelve un problema actual en el área de
          interpes y/o el proyecto da alta prioridad al cleinte quien queda ampliamente satisfecho <br></br></td>
		<div class="controls">
			<td style="background-color: #E6E6E6;">
<center>
				<input name="q0" type="radio" value=25
	        		<?php echo ($q0 == 25)?'checked':'';?> ></input>
</center>
	        	</td>
	        	<td style="background-color: #E6E6E6;">
<center>
	                    	<input name="q0" type="radio" value=50
	                    	<?php echo ($q0 == 50)?'checked':'';?> ></input>
</center>
	               	</td>
	               	<td style="background-color: #E6E6E6;">
<center>
				<input name="q0" type="radio" value=75
	        		<?php echo ($q0 == 75)?'checked':'';?> ></input>
</center>
	        	</td>
	        	<td style="background-color: #E6E6E6;">
<center>
	                    	<input name="q0" type="radio" value=100
	                    	<?php echo ($q0 == 100)?'checked':'';?> ></input>
</center>
	               	</td>
		      	<?php if (!empty($q0Error)): ?>
	      		<span class="help-inline"><?php echo $q0Error;?></span>
		      	<?php endif;?>
		</div>
	</div>
      </tr>
   
        </ul>
        
        <ul class="choices">
           
      <tr>
        <div class="control-group <?php echo !empty($q1Error)?'error':'';?>">
	<td>Impacto e innovación: El proyecto presenta una idea nueva e impacta positivamente en el área de interés y/o
          el producto presenta una idea nueva e incrementa la productividad<br></br></td>
		<div class="controls">
			<td>
<center>
				<input name="q1" type="radio" value=25
	        		<?php echo ($q1 == 25)?'checked':'';?> ></input>
</center>
	        	</td>
	        	<td>
<center>
	                    	<input name="q1" type="radio" value=50
	                    	<?php echo ($q1 == 50)?'checked':'';?> ></input>
</center>
	               	</td>
	               	<td>
<center>
				<input name="q1" type="radio" value=75
	        		<?php echo ($q1 == 75)?'checked':'';?> ></input>
</center>
	        	</td>
	        	<td>
<center>
	                    	<input name="q1" type="radio" value=100
	                    	<?php echo ($q1 == 100)?'checked':'';?> ></input>
</center>
	               	</td>
		      	<?php if (!empty($q1Error)): ?>
	      		<span class="help-inline"><?php echo $q1Error;?></span>
		      	<?php endif;?>
		</div>
	</div>
      </tr>

        </ul>
        
        <ul class="choices">
            
      <tr>
        <div class="control-group <?php echo !empty($q2Error)?'error':'';?>">
	<td>Desarrollo experimental o técnico y/o resultados o producto final: Ausiencia de errores técnicos los
          resultados
          y/o producto resuelven el problema propuestos<br></br></td>
		<div class="controls">
			<td style="background-color: #E6E6E6;">
<center>
				<input name="q2" type="radio" value=25
	        		<?php echo ($q2 == 25)?'checked':'';?> ></input>
</center>
	        	</td>
	        	<td style="background-color: #E6E6E6;">
<center>
	                    	<input name="q2" type="radio" value=50
	                    	<?php echo ($q2 == 50)?'checked':'';?> ></input>
</center>
	               	</td>
	               	<td style="background-color: #E6E6E6;">
<center>
				<input name="q2" type="radio" value=75
	        		<?php echo ($q2 == 75)?'checked':'';?> ></input>
</center>
	        	</td>
	        	<td style="background-color: #E6E6E6;">
<center>
	                    	<input name="q2" type="radio" value=100
	                    	<?php echo ($q2 == 100)?'checked':'';?> ></input>
</center>
	               	</td>
		      	<?php if (!empty($q2Error)): ?>
	      		<span class="help-inline"><?php echo $q2Error;?></span>
		      	<?php endif;?>
		</div>
	</div>
      </tr>
    
        </ul>
        
        <ul class="choices">
          
      <tr>
        <div class="control-group <?php echo !empty($q3Error)?'error':'';?>">
	<td>Impacto e innovación: Claridad y precisión de ideas: La presentación es concreta y clara<br></br></td>
		<div class="controls">
			<td>
<center>
				<input name="q3" type="radio" value=25
	        		<?php echo ($q3 == 25)?'checked':'';?> ></input>
</center>
	        	</td>
	        	<td>
<center>
	                    	<input name="q3" type="radio" value=50
	                    	<?php echo ($q3 == 50)?'checked':'';?> ></input>
</center>
	               	</td>
	               	<td>
<center>
				<input name="q3" type="radio" value=75
	        		<?php echo ($q3 == 75)?'checked':'';?> ></input>
</center>
	        	</td>
	        	<td>
<center>
	                    	<input name="q3" type="radio" value=100
	                    	<?php echo ($q3 == 100)?'checked':'';?> ></input>
</center>
	               	</td>
		      	<?php if (!empty($q3Error)): ?>
	      		<span class="help-inline"><?php echo $q3Error;?></span>
		      	<?php endif;?>
		</div>
	</div>
      </tr>
    
        </ul>
        
        <ul class="choices">
           
      <tr>
        <div class="control-group <?php echo !empty($q4Error)?'error':'';?>">
 <td>Respuestas a preguntas: Respuestas precisas de acuerdo al diseño, al estado de avance del proyecto, al
          impactoy
          a los resultados obtenidos <br></br></td>
		<div class="controls">
			<td style="background-color: #E6E6E6;">
<center>
				<input name="q4" type="radio" value=25
	        		<?php echo ($q4 == 25)?'checked':'';?> ></input>
</center>
	        	</td>
	        	<td style="background-color: #E6E6E6;">
<center>
	                    	<input name="q4" type="radio" value=50
	                    	<?php echo ($q4 == 50)?'checked':'';?> ></input>
</center>
	               	</td>
	               	<td style="background-color: #E6E6E6;">
<center>
				<input name="q4" type="radio" value=75
	        		<?php echo ($q4 == 75)?'checked':'';?> ></input>
</center>
	        	</td>
	        	<td style="background-color: #E6E6E6;">
<center>
	                    	<input name="q4" type="radio" value=100
	                    	<?php echo ($q4 == 100)?'checked':'';?> ></input>
</center>
	               	</td>
		      	<?php if (!empty($q4Error)): ?>
	      		<span class="help-inline"><?php echo $q4Error;?></span>
		      	<?php endif;?>
		</div>
	</div>
      </tr>
    
        </ul>

          </table>



<center>
      <tr>
        <td  style="text-align: center;">
          <br></br>
          <button type="submit" style="color:#FFFFFF"
            class="btn"><strong>Calificar</strong></button>
        </td>

    
</tr>
</center>
      <tr>
<a href="indexJ.php?id=<?php echo $color;?>" style="color:#FFFFFF"
            class="btn" id="nigger"><strong>Back</strong></a>
    
</tr>
</form>
  


</body>

</html>
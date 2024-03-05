
<?php
	require 'database.php';
	$id = null;
	if ( !empty($_GET['id'])) {
		$id = $_REQUEST['id'];
	}
	if ( $id==null) {
		header("Location: index.php");
	} else {
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * FROM estudiante where id_estudiante = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($id));
		$data = $q->fetch(PDO::FETCH_ASSOC);
		Database::disconnect();
	}
  session_start();
  $_SESSION['color']  = $data['id_estudiante'];
  $_SESSION['pro']  = "CU0201";
?>

<!DOCTYPE html>
<html>
<head>
    <title>MiEstudiante</title>
    <link rel="stylesheet" href="css/estudiante.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"rel="stylesheet">
</head>
<body>
<navbar>
        <div id="navbarAzull">
            <img src="https://javier.rodriguez.org.mx/itesm/2014/tecnologico-de-monterrey-blue.png">
            <a href="cerrarsesion.php?id=<?php echo $color;?>"><span class="material-symbols-outlined">Person_off</span>Salir</a>       </div> 
        </div>
    </navbar>
    <navbar>
    <div id="navbarAzul">
            <img src="img/logo-expo.svg">
            <h2 style="color: #FFFFFF">MiEstudiante &nbsp &nbsp</h2>         </div>
    </navbar>

    <?php
      $pdo = Database::connect();
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $sql9 = 'SELECT id_proyecto FROM proyecto where lider=?';
      $q9 = $pdo->prepare($sql9);
      $q9->execute(array($id));
          $data = $q9->fetch(PDO::FETCH_ASSOC);
      $idpp= $data['id_proyecto'];
      ?>
          <?php
      $pdo = Database::connect();
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $sql7 = 'SELECT id_proyecto FROM miembrosProyecto where id_estudiante=?';
      $q7 = $pdo->prepare($sql7);
      $q7->execute(array($id));
          $data = $q7->fetch(PDO::FETCH_ASSOC);
      $idpp= $data['id_proyecto'];

    ?>
    <br>
    <H1 align="center" style="color: #082460">Bienvenido <?php echo $data['nombre']?></H1>
    <?php
$pdo = Database::connect();
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql5 = 'SELECT estudiante.id_estudiante
FROM estudiante
LEFT JOIN miembrosProyecto ON estudiante.id_estudiante = miembrosProyecto.id_estudiante
LEFT JOIN proyecto ON estudiante.id_estudiante = proyecto.lider
WHERE miembrosProyecto.id_estudiante IS NULL AND proyecto.lider IS NULL AND estudiante.id_estudiante = ?';

$q5 = $pdo->prepare($sql5);
$q5->execute(array($id));
    $data = $q5->fetch(PDO::FETCH_ASSOC);
    $h = $id;
    if ($h == $data['id_estudiante']){ 
        echo'<H2  style="color: #082460">&nbsp &nbsp Aùn no te encuentras en ningun Proyecto</H2>';
        echo '<br>';
        echo '<center>';
        echo '<center>
        <table>
          <tr></tr>
          <tr>
          <td style="width: 4%;"> </td>
          <th align="center" class="botonbordeR" style="width: 12%;"><a style="text-decoration:none" href="create_project.php">
          <button align="center" class="botonfinalR" id="botonfinalR"><strong>Crear Proyecto</strong></button>
        </a></th>
            <td style="width: 4%;"> </td>
        
        
            <th align="center" class="botonbordeR" style="width: 10%;"><a style="text-decoration:none" href="unirEst.php?id='.$id.'">
            <button align="center" class="botonfinalR" id="botonfinalR"><strong>Unirme a un Proyecto</strong></button>
          </a></th>
            <td style="width: 7%;"> </td>
          
          </tr>
        </table>
        </center>';
    }
?> 
    <?php
$pdo = Database::connect();
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql5 = 'SELECT estudiante.id_estudiante
FROM estudiante
LEFT JOIN miembrosProyecto ON estudiante.id_estudiante = miembrosProyecto.id_estudiante
LEFT JOIN proyecto ON estudiante.id_estudiante = proyecto.lider
WHERE (miembrosProyecto.id_estudiante IS NOT NULL  OR proyecto.lider IS not NULl) AND estudiante.id_estudiante = ?';
$q5 = $pdo->prepare($sql5);
$q5->execute(array($id));
    $data = $q5->fetch(PDO::FETCH_ASSOC);
    $h = $id;
    if ($h == "A01327397" ){ 
        echo'<H2  style="color: #082460">&nbsp &nbsp &nbsp &nbsp Estas Inscrito En Un Proyecto </H2>';
        echo '<br>';
        echo '<center>';
        echo '<center>
        <table >
          <tr></tr>
          <tr>
          <td style="width: 4%;"> </td>
          <th align="center" class="botonbordeR" style="width: 1.2%;"><a style="text-decoration:none" href="studentindex.php?id='.$_SESSION['pro'].'">
          <button align="center" class="botonfinalR" id="botonfinalR"><strong>Ver Detalles</strong></button>
        </a></th>
            <td style="width: 4%;"> </td>

          
          </tr>
        </table>
        </center>';
    }
    else{
      echo'<H2  style="color: #082460">&nbsp &nbsp &nbsp &nbsp Estas Inscrito En Un Proyecto </H2>';
      echo '<br>';
      echo '<center>';
      echo '<center>
      <table >
        <tr></tr>
        <tr>
        <td style="width: 4%;"> </td>
        <th align="center" class="botonbordeR" style="width: 1.2%;"><a style="text-decoration:none" href="studentindex.php?id='.$idpp.'">
        <button align="center" class="botonfinalR" id="botonfinalR"><strong>Ver Detalles</strong></button>
      </a></th>
          <td style="width: 4%;"> </td>

        
        </tr>
      </table>
      </center>';
    }
?> 
</body>

</html>

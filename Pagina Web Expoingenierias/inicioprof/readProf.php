<?php
	require 'database.php';
	$id = null;
	if ( !empty($_GET['id'])) {
		$id = $_REQUEST['id'];
	}
	if ( $id==null) {
		header("Location: indexProf.php");
	} else {
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * FROM profesor where id_profesor = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($id));
		$data = $q->fetch(PDO::FETCH_ASSOC);
		Database::disconnect();
	}
?>

<!DOCTYPE html>
<html>
		<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href='https://fonts.googleapis.com/css?family=Inter' rel='stylesheet'>
<head>
    <title>MiProfesor</title>
    <link rel="stylesheet" href="css/dani.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"rel="stylesheet">
	<link rel="icon" href="img/miniicon.png">
</head>
<body>
<navbar>
        <div id="navbar">
            <img src="https://javier.rodriguez.org.mx/itesm/2014/tecnologico-de-monterrey-blue.png"> 
			<a href="cerrarsesion.php"><img src="https://icons.veryicon.com/png/o/miscellaneous/utility/logout-24.png" style="width: 45px;height: 45px;"></a>
        </div>
    </navbar>
    <navbar>
        <div id="navbarAzul">
            <img src="img/logo-expo.svg">
            <a href="indexProf.php?id=<?php echo $data['id_profesor'];?>"><span class="material-symbols-outlined">home</span>MiProfesor</a>       </div>
    </navbar>
 <br>  
 <hr style="color: #082460;"> 
<H1 align="center" style="color: #082460">MIS DATOS</H1>
<hr style="color: #082460;">
<br>
<center>
<table>
	<tr><th class="tabh">&nbsp Nomina: &nbsp</th><td class="tabd">&nbsp <?php echo $data['id_profesor'];?> &nbsp</td></tr>
	<tr><th class="tabh">&nbsp Nombre: &nbsp</th><td class="tabd">&nbsp <?php echo $data['nombre'];?> &nbsp</td></tr>
	<tr><th class="tabh">&nbsp Apellido Paterno: &nbsp</th><td class="tabd">&nbsp <?php echo $data['apellidoPaterno'];?> &nbsp</td></tr>
	<tr><th class="tabh">&nbsp Apellido Materno: &nbsp</th><td class="tabd">&nbsp <?php echo $data['apellidoMaterno'];?> &nbsp</td></tr>
	<tr><th class="tabh">&nbsp Correo Electronico: &nbsp</th><td class="tabd">&nbsp <?php echo $data['correo'];?> &nbsp</td></tr>

</table>
</center>

<br>
<br>

<?php

$pdo = Database::connect();
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql5 = 'SELECT profesor.id_profesor FROM profesor LEFT JOIN juez ON profesor.id_profesor = juez.id_juez WHERE juez.id_juez IS NULL AND profesor.id_profesor = ?';
$q5 = $pdo->prepare($sql5);
$q5->execute(array($id));
$data = $q5->fetch(PDO::FETCH_ASSOC);
$h = $id;
if ($h == $data['id_profesor']){ 
	echo '<center>';

		echo '<div class="botonbordeV" style="width: 14%; float: center;">';
			echo '<form  action="profjuez.php" method="post">';
				echo '<input type="hidden" name="id" value="'.$id.'"/>';
				echo '<button class="botonfinalV" id="botonfinalV" type="submit">Convertirme en Juez</button>';
			echo '</form></th>';
		echo '</div>';

	echo '</center>';
}

?> 

    
</body>

</html>

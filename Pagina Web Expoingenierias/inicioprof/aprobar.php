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
		$sql1 = "UPDATE status Set status='Aceptado' WHERE id_proyecto = ?";
		$q1 = $pdo->prepare($sql1);
		$q1->execute(array($id));
		Database::disconnect();
		header("Location: indexProf.php?id=$color");
	}
?>



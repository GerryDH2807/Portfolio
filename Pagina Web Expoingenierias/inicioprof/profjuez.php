<?php
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
		$sql5 = 'INSERT INTO juez SELECT * from profesor where id_profesor=?';
		$q5 = $pdo->prepare($sql5);
		$q5->execute(array($id));
		$data = $q5->fetch(PDO::FETCH_ASSOC);
		Database::disconnect();
		header("Location: indexProf.php?id=$id");

	}
?>

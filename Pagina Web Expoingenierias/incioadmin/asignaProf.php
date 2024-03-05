<?php

    require 'database.php';
    
    if(!empty($_POST['menuJuez'])){

        $var = explode('|', $_POST['menuJuez']);

        $pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql2 = 'INSERT INTO califica (id_proyecto, id_juez, calificacion, retrojuez) values(?, ?, NULL, NULL)';
        $q2 = $pdo->prepare($sql2);
        $q2->execute(array($var[0], $var[1]));
        Database::disconnect();
        
    }

    header("Location: asigna.php");

?>
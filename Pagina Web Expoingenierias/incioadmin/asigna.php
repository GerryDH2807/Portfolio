<!DOCTYPE html>
<html lang="en">
    <link href='https://fonts.googleapis.com/css?family=Inter' rel='stylesheet'>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MiADMIN</title>
    <link rel="stylesheet" href="css/asignaStyle.css">
    <link rel="icon" href="img/miniicon.png">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
</head>
<body id="cuerpazo">
    <navbar>
        <div id="navbar">
            <img src="https://javier.rodriguez.org.mx/itesm/2014/tecnologico-de-monterrey-blue.png"> 
            <!--<img src="https://i.imgur.com/UcHOarZ.png">-->
            <div id="iconosNavBar">
                <a id="iconosNavBar2" href="admin.php" class="material-icons">account_circle</a>
            </div>
        </div>
    </navbar>
    <navbar>
        <div id="navbarAzul">
            <img src="img/logo-expo.svg">
            <a href="">ASIGNAR PROYECTOS</a>
            <a href="admin.php"><span class="material-symbols-outlined">home</span>MiAdmin</a>
        </div>
    </navbar>

    <?php
        include 'database.php';
        $pdo = Database::connect();
        $sql = 'SELECT id_categoria FROM proyecto WHERE id_proyecto not in (SELECT id_proyecto FROM califica)';

        $rob = 0;
        $soft = 0;
        $nano = 0;
        $com = 0;
        $med = 0;

        foreach ($pdo->query($sql) as $row) {
            if($row['id_categoria']==1){$rob = $rob +1;}
            elseif($row['id_categoria']==2){$soft= $soft +1;}
            elseif($row['id_categoria']==3){$nano = $nano +1;}
            elseif($row['id_categoria']==4){$com = $com +1;}
            elseif($row['id_categoria']==5){$med = $med +1;}
        }
    ?>
    <center>
        <div class="accordion bloqueDesplegable" id="desplegableGeneral">
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        R O B O T I C A - [<?php echo $rob; ?>]
                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#desplegableGeneral">
                    <div class="accordion-body">
                        <?php
                            //include 'database.php';
                            //$pdo = Database::connect();
                            $sql3 = 'SELECT * FROM proyecto WHERE id_proyecto not in (SELECT id_proyecto FROM califica) AND id_categoria = 1';
                            $sql4 = 'SELECT * FROM juez';

                                foreach ($pdo->query($sql3) as $proyecto) {

                                    echo '<div id="renglonListaUsuarios">';
                                        echo '<div id="matricula">';
                                            echo '<span>'. $proyecto['id_proyecto'] .'</span>';
                                        echo '</div>';
                                        echo '<div id="nombre">';
                                            echo '<span>'. $proyecto['nombre'] .'</span>';
                                        echo '</div>';
                                        echo '<span id="lider">'. 'Líder: ' . $proyecto['lider'] .'</span>';
                                        echo '<div class="botonesRenglonListaUsuarios">';
                                            echo '<form action="asignaProf.php" method="post">';
                                                echo '<select id="menuProfes" name="menuJuez">';
                                                    echo '<option value="" disable selected>Jueces Disponibles</option>';
                                                    foreach ($pdo->query($sql4) as $jueze){
                                                        echo '<option value='.$proyecto['id_proyecto'].'|'.$jueze['id_juez'].'>'.$jueze['nombre'].' '.$jueze['apellidoPaterno'].'</option>';
                                                    }
                                                echo '</select>';
                                                echo '<button type="submit" id="botonSubm" class="material-icons">save_as</button>';
                                            echo '</form>';
                                        echo '</div>';
                                    echo '</div>';
                                    
                                }
                            //echo '</div>';
                            
                            //Database::disconnect();
                        ?>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        S O F T W A R E - [<?php echo $soft; ?>]
                    </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#desplegableGeneral">
                    <div class="accordion-body">
                        <?php
                            //include 'database.php';
                            //$pdo = Database::connect();
                            $sql3 = 'SELECT * FROM proyecto WHERE id_proyecto not in (SELECT id_proyecto FROM califica) AND id_categoria = 2';
                            $sql4 = 'SELECT * FROM juez';

                                foreach ($pdo->query($sql3) as $proyecto) {

                                    echo '<div id="renglonListaUsuarios">';
                                        echo '<div id="matricula">';
                                            echo '<span>'. $proyecto['id_proyecto'] .'</span>';
                                        echo '</div>';
                                        echo '<div id="nombre">';
                                            echo '<span>'. $proyecto['nombre'] .'</span>';
                                        echo '</div>';
                                        echo '<span id="lider">'. 'Líder: ' . $proyecto['lider'] .'</span>';
                                        echo '<div class="botonesRenglonListaUsuarios">';
                                            echo '<form action="asignaProf.php" method="post">';
                                                echo '<select id="menuProfes" name="menuJuez">';
                                                    echo '<option value="" disable selected>Jueces Disponibles</option>';
                                                    foreach ($pdo->query($sql4) as $jueze){
                                                        echo '<option value='.$proyecto['id_proyecto'].'|'.$jueze['id_juez'].'>'.$jueze['nombre'].' '.$jueze['apellidoPaterno'].'</option>';
                                                    }
                                                echo '</select>';
                                                echo '<button type="submit" id="botonSubm" class="material-icons">save_as</button>';
                                            echo '</form>';
                                        echo '</div>';
                                    echo '</div>';
                                    
                                }
                            //echo '</div>';
                            
                            //Database::disconnect();
                        ?>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        N A N O T E C N O L O G I A - [<?php echo $nano; ?>]
                    </button>
                </h2>
                <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#desplegableGeneral">
                    <div class="accordion-body">
                        <?php
                            //include 'database.php';
                            //$pdo = Database::connect();
                            $sql3 = 'SELECT * FROM proyecto WHERE id_proyecto not in (SELECT id_proyecto FROM califica) AND id_categoria = 3';
                            $sql4 = 'SELECT * FROM juez';

                                foreach ($pdo->query($sql3) as $proyecto) {

                                    echo '<div id="renglonListaUsuarios">';
                                        echo '<div id="matricula">';
                                            echo '<span>'. $proyecto['id_proyecto'] .'</span>';
                                        echo '</div>';
                                        echo '<div id="nombre">';
                                            echo '<span>'. $proyecto['nombre'] .'</span>';
                                        echo '</div>';
                                        echo '<span id="lider">'. 'Líder: ' . $proyecto['lider'] .'</span>';
                                        echo '<div class="botonesRenglonListaUsuarios">';
                                            echo '<form action="asignaProf.php" method="post">';
                                                echo '<select id="menuProfes" name="menuJuez">';
                                                    echo '<option value="" disable selected>Jueces Disponibles</option>';
                                                    foreach ($pdo->query($sql4) as $jueze){
                                                        echo '<option value='.$proyecto['id_proyecto'].'|'.$jueze['id_juez'].'>'.$jueze['nombre'].' '.$jueze['apellidoPaterno'].'</option>';
                                                    }
                                                echo '</select>';
                                                echo '<button type="submit" id="botonSubm" class="material-icons">save_as</button>';
                                            echo '</form>';
                                        echo '</div>';
                                    echo '</div>';
                                    
                                }
                            //echo '</div>';
                            
                            //Database::disconnect();
                        ?>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                        C O M U N I C A C I O N - [<?php echo $com; ?>]
                    </button>
                </h2>
                <div id="collapseFour" class="accordion-collapse collapse" data-bs-parent="#desplegableGeneral">
                    <div class="accordion-body">
                        <?php
                            //include 'database.php';
                            //$pdo = Database::connect();
                            $sql3 = 'SELECT * FROM proyecto WHERE id_proyecto not in (SELECT id_proyecto FROM califica) AND id_categoria = 4';
                            $sql4 = 'SELECT * FROM juez';

                                foreach ($pdo->query($sql3) as $proyecto) {

                                    echo '<div id="renglonListaUsuarios">';
                                        echo '<div id="matricula">';
                                            echo '<span>'. $proyecto['id_proyecto'] .'</span>';
                                        echo '</div>';
                                        echo '<div id="nombre">';
                                            echo '<span>'. $proyecto['nombre'] .'</span>';
                                        echo '</div>';
                                        echo '<span id="lider">'. 'Líder: ' . $proyecto['lider'] .'</span>';
                                        echo '<div class="botonesRenglonListaUsuarios">';
                                            echo '<form action="asignaProf.php" method="post">';
                                                echo '<select id="menuProfes" name="menuJuez">';
                                                    echo '<option value="" disable selected>Jueces Disponibles</option>';
                                                    foreach ($pdo->query($sql4) as $jueze){
                                                        echo '<option value='.$proyecto['id_proyecto'].'|'.$jueze['id_juez'].'>'.$jueze['nombre'].' '.$jueze['apellidoPaterno'].'</option>';
                                                    }
                                                echo '</select>';
                                                echo '<button type="submit" id="botonSubm" class="material-icons">save_as</button>';
                                            echo '</form>';
                                        echo '</div>';
                                    echo '</div>';
                                    
                                }
                            //echo '</div>';
                            
                            //Database::disconnect();
                        ?>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                        M E D I O  A M B I E N T E- [<?php echo $med; ?>]
                    </button>
                </h2>
                <div id="collapseFive" class="accordion-collapse collapse" data-bs-parent="#desplegableGeneral">
                    <div class="accordion-body">
                        <?php
                            //include 'database.php';
                            //$pdo = Database::connect();
                            $sql3 = 'SELECT * FROM proyecto WHERE id_proyecto not in (SELECT id_proyecto FROM califica) AND id_categoria = 5';
                            $sql4 = 'SELECT * FROM juez';

                                foreach ($pdo->query($sql3) as $proyecto) {

                                    echo '<div id="renglonListaUsuarios">';
                                        echo '<div id="matricula">';
                                            echo '<span>'. $proyecto['id_proyecto'] .'</span>';
                                        echo '</div>';
                                        echo '<div id="nombre">';
                                            echo '<span>'. $proyecto['nombre'] .'</span>';
                                        echo '</div>';
                                        echo '<span id="lider">'. 'Líder: ' . $proyecto['lider'] .'</span>';
                                        echo '<div class="botonesRenglonListaUsuarios">';
                                            echo '<form action="asignaProf.php" method="post">';
                                                echo '<select id="menuProfes" name="menuJuez">';
                                                    echo '<option value="" disable selected>Jueces Disponibles</option>';
                                                    foreach ($pdo->query($sql4) as $jueze){
                                                        echo '<option value='.$proyecto['id_proyecto'].'|'.$jueze['id_juez'].'>'.$jueze['nombre'].' '.$jueze['apellidoPaterno'].'</option>';
                                                    }
                                                echo '</select>';
                                                echo '<button type="submit" id="botonSubm" class="material-icons">save_as</button>';
                                            echo '</form>';
                                        echo '</div>';
                                    echo '</div>';
                                    
                                }
                            //echo '</div>';
                            
                            //Database::disconnect();
                        ?>
                    </div>
                </div>
            </div>
        </div>
    

    <label id="tituloProy">Proyectos Asignados</label>

    <?php
        //include 'database.php';
        //$pdo = Database::connect();
        $sql = 'SELECT id_categoria FROM proyecto WHERE id_proyecto in (SELECT id_proyecto FROM califica)';

        $rob = 0;
        $soft = 0;
        $nano = 0;
        $com = 0;
        $med = 0;

        foreach ($pdo->query($sql) as $row) {
            if($row['id_categoria']==1){$rob = $rob +1;}
            elseif($row['id_categoria']==2){$soft= $soft +1;}
            elseif($row['id_categoria']==3){$nano = $nano +1;}
            elseif($row['id_categoria']==4){$com = $com +1;}
            elseif($row['id_categoria']==5){$med = $med +1;}
        }
    ?>

    
        <div class="accordion bloqueDesplegable2" id="desplegableGeneral2">
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="true" aria-controls="collapseSix">
                        R O B O T I C A - [<?php echo $rob; ?>]
                    </button>
                </h2>
                <div id="collapseSix" class="accordion-collapse collapse" data-bs-parent="#desplegableGeneral2">
                    <div class="accordion-body">
                        <?php
                            //include 'database.php';
                            //$pdo = Database::connect();
                            $sql3 = 'SELECT * FROM proyecto 
                                    INNER JOIN califica ON proyecto.id_proyecto = califica.id_proyecto  
                                    WHERE proyecto.id_categoria = 1';        
                            
                                foreach ($pdo->query($sql3) as $proyecto) {

                                    echo '<div id="renglonListaUsuarios">';
                                        echo '<div id="matricula">';
                                            echo '<span>'. $proyecto['id_proyecto'] .'</span>';
                                        echo '</div>';
                                        echo '<div id="nombre">';
                                            echo '<span>'. $proyecto['nombre'] .'</span>';
                                        echo '</div>';
                                        echo '<span id="lider">'. 'Líder: ' . $proyecto['lider'] .'</span>';
                                        echo '<span>'. 'Juez: ' . $proyecto['id_juez'] .'</span>';
                                    echo '</div>';
                                    
                                }
                            //echo '</div>';
                            
                            //Database::disconnect();
                        ?>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                        S O F T W A R E - [<?php echo $soft; ?>]
                    </button>
                </h2>
                <div id="collapseSeven" class="accordion-collapse collapse" data-bs-parent="#desplegableGeneral2">
                    <div class="accordion-body">
                        <?php
                            //include 'database.php';
                            //$pdo = Database::connect();
                            $sql3 = 'SELECT * FROM proyecto 
                                    INNER JOIN califica ON proyecto.id_proyecto = califica.id_proyecto  
                                    WHERE proyecto.id_categoria = 2';        
                            
                                foreach ($pdo->query($sql3) as $proyecto) {

                                    echo '<div id="renglonListaUsuarios">';
                                        echo '<div id="matricula">';
                                            echo '<span>'. $proyecto['id_proyecto'] .'</span>';
                                        echo '</div>';
                                        echo '<div id="nombre">';
                                            echo '<span>'. $proyecto['nombre'] .'</span>';
                                        echo '</div>';
                                        echo '<span id="lider">'. 'Líder: ' . $proyecto['lider'] .'</span>';
                                        echo '<span>'. 'Juez: ' . $proyecto['id_juez'] .'</span>';
                                    echo '</div>';
                                    
                                }
                            //echo '</div>';
                            
                            //Database::disconnect();
                        ?>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
                        N A N O T E C N O L O G I A - [<?php echo $nano; ?>]
                    </button>
                </h2>
                <div id="collapseEight" class="accordion-collapse collapse" data-bs-parent="#desplegableGeneral2">
                    <div class="accordion-body">
                        <?php
                            //include 'database.php';
                            //$pdo = Database::connect();
                            $sql3 = 'SELECT * FROM proyecto 
                                    INNER JOIN califica ON proyecto.id_proyecto = califica.id_proyecto  
                                    WHERE proyecto.id_categoria = 3';        
                            
                                foreach ($pdo->query($sql3) as $proyecto) {

                                    echo '<div id="renglonListaUsuarios">';
                                        echo '<div id="matricula">';
                                            echo '<span>'. $proyecto['id_proyecto'] .'</span>';
                                        echo '</div>';
                                        echo '<div id="nombre">';
                                            echo '<span>'. $proyecto['nombre'] .'</span>';
                                        echo '</div>';
                                        echo '<span id="lider">'. 'Líder: ' . $proyecto['lider'] .'</span>';
                                        echo '<span>'. 'Juez: ' . $proyecto['id_juez'] .'</span>';
                                    echo '</div>';
                                    
                                }
                            //echo '</div>';
                            
                            //Database::disconnect();
                        ?>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseNine" aria-expanded="false" aria-controls="collapseNine">
                        C O M U N I C A C I O N - [<?php echo $com; ?>]
                    </button>
                </h2>
                <div id="collapseNine" class="accordion-collapse collapse" data-bs-parent="#desplegableGeneral2">
                    <div class="accordion-body">
                        <?php
                            //include 'database.php';
                            //$pdo = Database::connect();
                            $sql3 = 'SELECT * FROM proyecto 
                                    INNER JOIN califica ON proyecto.id_proyecto = califica.id_proyecto  
                                    WHERE proyecto.id_categoria = 4';        
                            
                                foreach ($pdo->query($sql3) as $proyecto) {

                                    echo '<div id="renglonListaUsuarios">';
                                        echo '<div id="matricula">';
                                            echo '<span>'. $proyecto['id_proyecto'] .'</span>';
                                        echo '</div>';
                                        echo '<div id="nombre">';
                                            echo '<span>'. $proyecto['nombre'] .'</span>';
                                        echo '</div>';
                                        echo '<span id="lider">'. 'Líder: ' . $proyecto['lider'] .'</span>';
                                        echo '<span>'. 'Juez: ' . $proyecto['id_juez'] .'</span>';
                                    echo '</div>';
                                    
                                }
                            //echo '</div>';
                            
                            //Database::disconnect();
                        ?>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTen" aria-expanded="false" aria-controls="collapseTen">
                        M E D I O  A M B I E N T E- [<?php echo $med; ?>]
                    </button>
                </h2>
                <div id="collapseTen" class="accordion-collapse collapse" data-bs-parent="#desplegableGeneral2">
                    <div class="accordion-body">
                        <?php
                            //include 'database.php';
                            //$pdo = Database::connect();
                            $sql3 = 'SELECT * FROM proyecto 
                                    INNER JOIN califica ON proyecto.id_proyecto = califica.id_proyecto  
                                    WHERE proyecto.id_categoria = 5';        
                            
                                foreach ($pdo->query($sql3) as $proyecto) {

                                    echo '<div id="renglonListaUsuarios">';
                                        echo '<div id="matricula">';
                                            echo '<span>'. $proyecto['id_proyecto'] .'</span>';
                                        echo '</div>';
                                        echo '<div id="nombre">';
                                            echo '<span>'. $proyecto['nombre'] .'</span>';
                                        echo '</div>';
                                        echo '<span id="lider">'. 'Líder: ' . $proyecto['lider'] .'</span>';
                                        echo '<span>'. 'Juez: ' . $proyecto['id_juez'] .'</span>';
                                    echo '</div>';
                                    
                                }
                            //echo '</div>';
                            
                            //Database::disconnect();
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </center>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    
</body>
</html>
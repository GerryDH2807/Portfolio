<?php
    session_start();
    
?>

<!DOCTYPE html>
<html lang="en">
    <link href='https://fonts.googleapis.com/css?family=Inter' rel='stylesheet'>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MiADMIN</title>
    <link rel="stylesheet" href="css/estilazo.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <link rel="icon" href="img/miniicon.png">
</head>
<body id="cuerpazo">
    <navbar>
        <div id="navbar">
            <img src="https://javier.rodriguez.org.mx/itesm/2014/tecnologico-de-monterrey-blue.png"> 
            <!--<img src="https://i.imgur.com/UcHOarZ.png">-->
            <div id="iconosNavBar">
                <a id="iconosNavBar1" href="asigna.php" class="material-icons">rate_review</a>
                <a id="iconosNavBar1" href="cerrarsesion.php" class="material-icons">logout</a>
            </div>
        </div>
    </navbar>
    <navbar>
        <div id="navbarAzul">
            <img src="img/logo-expo.svg">
            <a href="admin.php"><span class="material-symbols-outlined">home</span>MiAdmin</a>
        </div>
    </navbar>
    <div class="input-group mb-3" id="buscador">
        <input type="text" class="form-control" placeholder="Buscar...">
        <span class="input-group-text material-symbols-outlined">tune</span>
    </div>
    <div id="proyectosCalif">
        <a href="calif.php">Proyectos Calificados</a>
        <progress id="file" max="100" value="70"> 70% </progress>
    </div>
    <div class="accordion bloqueDesplegable" id="desplegableGeneral">
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                E S T U D I A N T E S
                </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#desplegableGeneral">
                <div class="accordion-body">
                    <?php
                    
                        include 'database.php';
                        $pdo = Database::connect();
                        $sql = 'SELECT * FROM estudiante';

                        echo '<div id="divAgregar">';
                            echo '<a class="material-icons" href="create.php?id=Estudiante">add_circle</a>';
                            echo '<a href="create.php?id=Estudiante">Añadir Estudiante</a>';
                        echo '</div>';
                        echo '<div id="listaUsuarios">';
                            foreach ($pdo->query($sql) as $row) {
                                
                                echo '<div id="renglonListaUsuarios">';
                                    echo '<div id="matricula">';
                                        echo '<span>'. $row['id_estudiante'] .'</span>';
                                    echo '</div>';
                                    echo '<div id="nombre">';
                                        echo '<span>'. $row['nombre'] .' '. $row['apellidoPaterno'] .' '.$row['apellidoMaterno'] .'</span>';
                                    echo '</div>';
                                    echo '<span>'. $row['correo'] .'</span>';
                                    echo '<div class="botonesRenglonListaUsuarios">';
                                        echo '<a class="material-icons" href="read.php?id='.$row['id_estudiante'].'">visibility</a>';
                                        echo '<a class="material-icons" href="update.php?id='.$row['id_estudiante'].'">edit</a>';
                                        echo '<a class="material-icons" href="delete.php?id='.$row['id_estudiante'].'">delete</a>';
                                    echo '</div>';
                                echo '</div>';
                                
                            }
                        echo '</div>';
                    ?>
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                J U E C E S
                </button>
            </h2>
            <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#desplegableGeneral">
                <div class="accordion-body">
                    <?php
                        $sql = 'SELECT * FROM juez';

                        echo '<div id="divAgregar">';
                            echo '<a class="material-icons" href="create.php?id=Juez">add_circle</a>';
                            echo '<a href="create.php?id=Juez">Añadir Juez</a>';
                        echo '</div>';
                        echo '<div id="listaUsuarios">';
                            foreach ($pdo->query($sql) as $row) {
                                echo '<div id="renglonListaUsuarios">';
                                    echo '<div id="matricula">';
                                        echo '<span>'. $row['id_juez'] .'</span>';
                                    echo '</div>';
                                    echo '<div id="nombre">';
                                        echo '<span>'. $row['nombre'] .' '. $row['apellidoPaterno'] .' '.$row['apellidoMaterno'] .'</span>';
                                    echo '</div>';
                                    echo '<span>'. $row['correo'] .'</span>';
                                    //echo '<span>'. 'Edición: ' . $row['id_edicion'] .'</span>';
                                    echo '<div class="botonesRenglonListaUsuarios">';
                                        echo '<a class="material-icons" href="read.php?id='.$row['id_juez'].'">visibility</a>';
                                        echo '<a class="material-icons" href="update.php?id='.$row['id_juez'].'">edit</a>';
                                        echo '<a class="material-icons" href="delete.php?id='.$row['id_juez'].'">delete</a>';
                                    echo '</div>';
                                echo '</div>';
                                
                            }
                        echo '</div>';
                    ?>
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                P R O F E S O R E S
                </button>
            </h2>
            <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#desplegableGeneral">
                <div class="accordion-body">
                    <?php
                        $sql = 'SELECT * FROM profesor';

                        echo '<div id="divAgregar">';
                            echo '<a class="material-icons" href="create.php?id=Profesor">add_circle</a>';
                            echo '<a href="create.php?id=Profesor">Añadir Profesor</a>';
                        echo '</div>';
                        echo '<div id="listaUsuarios">';
                            foreach ($pdo->query($sql) as $row) {
                                
                                echo '<div id="renglonListaUsuarios">';
                                    echo '<div id="matricula">';
                                        echo '<span>'. $row['id_profesor'] .'</span>';
                                    echo '</div>';
                                    echo '<div id="nombre">';
                                        echo '<span>'. $row['nombre'] .' '. $row['apellidoPaterno'] .' '.$row['apellidoMaterno'] .'</span>';
                                    echo '</div>';
                                    echo '<span>'. $row['correo'] .'</span>';
                                    //echo '<span>'. 'Edición: ' . $row['id_edicion'] .'</span>';
                                    echo '<div class="botonesRenglonListaUsuarios">';
                                        echo '<a class="material-icons" href="read.php?id='.$row['id_profesor'].'">visibility</a>';
                                        echo '<a class="material-icons" href="update.php?id='.$row['id_profesor'].'">edit</a>';
                                        echo '<a class="material-icons" href="delete.php?id='.$row['id_profesor'].'">delete</a>';
                                    echo '</div>';
                                echo '</div>';
                                
                            }
                        echo '</div>';
                        Database::disconnect();
                    ?>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>
<?php
    session_start();
    $id = null;
    $id = $_REQUEST['id'];
    if ( !empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }

    if ( $id==null ) {
        header("Location: indexProf.php");
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
<div id="navbarAzull">
            <img src="https://javier.rodriguez.org.mx/itesm/2014/tecnologico-de-monterrey-blue.png"> 
            <a href="readProf.php?id=<?php echo $id;?>"><span class="material-symbols-outlined">person</span></a>       </div>
        </div>
    </navbar>
    <navbar>
        <div id="navbarAzul">
            <img src="img/logo-expo.svg">
            <h2 style="color: #FFFFFF">MiProfesor &nbsp &nbsp</h2>         </div>
    </navbar>
 <br>   
<H1 align="center" style="color: #082460">PROYECTOS</H1>
<br>

          <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
            <div class="accordion-body">
            <center>
                <table style="background-color: #4B73C1; width: 70%;">
                <tr style="background-color: #ffffff; color:#082460;">
                <th>ID PROYECTO</th>
                <th>NOMBRE</th>
                <th>CATEGORIA</th>
                <th>STATUS</th>
                <th>LIDER</th>
                <th>DETALLES</th>
                </tr>
                <?php

                
                          include 'database.php';
                          $pdo = Database::connect();
                          $sql = 'SELECT estudiante.nombre AS est, estudiante.apellidoPaterno, estudiante.apellidoMaterno, proyecto.id_proyecto, proyecto.nombre, categoria.nombre As cat, status.status 
                          FROM estudiante, proyecto, categoria,status  
                          WHERE proyecto.lider = estudiante.id_estudiante 
                            And proyecto.id_categoria = categoria.id_categoria AND status.id_proyecto = proyecto.id_proyecto AND status.status !="Corregir" AND status.status !="Rechazado" AND status.status !="Aceptado" AND status.id_profesor="'.$id.'"';

                          foreach ($pdo->query($sql) as $row) {
              
                              echo '<tr  style="border:0px; border-radius:1px; ">';
                              echo '<td align="center" class="proyectoV">'. $row['id_proyecto'] .'<br></br> </td>'; 
                              echo '<td align="center" class="proyectoV">'. $row['nombre'] .'<br></br>  </td>';
                              echo '<td align="center" class="proyectoV">'. $row['cat'] .'<br></br>  </td>';
                              echo '<td align="center" class="proyectoV">'. $row['status'] .'<br></br> </td>';
                              echo '<td align="center" class="proyectoV">'. $row['est'] .' '. $row['apellidoPaterno'] .' '. $row['apellidoMaterno'].'<br></br> </td>';
                                      echo '<td align="center" width=250>';
                                      echo '<a class="material-icons" href="vistaProf.php?id='.$row['id_proyecto'].'" style="color: white; text-decoration:none;">visibility</a>';
                                      echo '</td>';
                                  echo '</tr>';
                          }
                          Database::disconnect();


                ?>
                  
                </table> </center>
            </div>
          </div>
    
</body>

</html>



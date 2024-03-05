<?php
  session_start();
?>
<!DOCTYPE html> 
    <html>

      <meta name="viewport" content="width=device-width, initial-scale=1">
      <!--Paquete de íconos usado-->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      <link href='https://fonts.googleapis.com/css?family=Inter' rel='stylesheet'>


      <head>
        <title>Calificar Proyecto Juez</title>
        <link rel="stylesheet" type="text/css" href="css/style2.css">
        <link rel="icon" href="img/miniicon.png">
      </head>

      <body>

        <table align="center" width="100%" class="logos">
          <tr>
            <td align="center" style="width: 46%;" class="logo"> <img src="img/logo-expo.png" style="width: 45%;height: 20%;"></td>
            <td align="center" style="width: 46%;" class="logo"> <img src="img/logotec.png" style="width: 45%;height: 80%;"></td>
            <td align="center" style="width: 8%;"><a href="cerrarsesion.php"><img src="https://static-00.iconduck.com/assets.00/logout-icon-512x512-2x08s84n.png" style="width: 45px;height: 45px;"></a></td>
          </tr>
        </table>

        <hr size="4px" color=#b8b4b4>

        <h2 style="color:#082460">



    
<?php
 $id = null;
 $id = $_REQUEST['id'];
 if ( !empty($_GET['id'])) {
     $id = $_REQUEST['id'];
 }

 if ( $id==null ) {
     header("Location: indexJ.php");
 }

    include 'database.php';
    $pdo = Database::connect();
    $sql = 'SELECT estudiante.nombre AS nombrelider, estudiante.apellidoPaterno, estudiante.apellidoMaterno, proyecto.id_proyecto, proyecto.nombre, califica.id_juez, categoria.nombre As cat, califica.calificacion, proyecto.linkArchivo FROM estudiante, proyecto, categoria, califica  WHERE proyecto.lider = estudiante.id_estudiante And proyecto.id_categoria = categoria.id_categoria AND proyecto.id_proyecto = califica.id_proyecto AND califica.id_juez="'.$id.'"';

    echo '<center>';
        echo '<div id="bigdiv">';

       $idNegro=1;

        foreach ($pdo->query($sql) as $row){
            
            echo '<div id="Renglon2">';
               echo '<span>'.'PROYECTO '.$idNegro.'</span>';    
            echo '</div>';
            echo '<div id="Renglon" >';
               echo '<div style = "width : 20%"><span>'. $row['nombre'] .'</span> </div>';    
               echo '<div style = "width : 9%"><span>'. $row['id_proyecto'] .'</span></div>';
               echo '<div style = "width : 18%"><span>'. $row['nombrelider'] .' '. $row['apellidoPaterno'] .' '. $row['apellidoMaterno'].'</span></div>';
               echo '<div style = "width : 12%"><span>'. $row['cat'] .'</span></div>'; 
               echo '<div style = "width : 1%"><span>'. $row['calificacion'] .'</span></div>'; 
                echo '<div class="botones">';
                    echo '<a href="'.$row['linkArchivo'].'" style="color:#FFFFFF" id="text1">Visualizar proyecto</a>';
                    echo '<a href="rubrica.php?id='.$row['id_proyecto'].'" style="color:#FFFFFF" id="text1">Rubrica</a>';
                    echo '<a href="Comentarios.php?id='.$row['id_proyecto'].'" style="color:#FFFFFF" id="text1">C/R</a>';
                echo '</div>';
            echo '  </div>';
            $idNegro = $idNegro + 1;
            session_start();
            $_SESSION['color']  = $row['id_juez'];
            }
            
        echo '</div>';
    echo '</center>';

    Database::disconnect();

?>

      </body>


    </html>

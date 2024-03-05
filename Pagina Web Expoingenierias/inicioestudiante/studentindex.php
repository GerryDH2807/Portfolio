<?php
    session_start();
	require 'database.php';
	$id = null;
   // $idjuez=  null;
	if ( !empty($_GET['id'])) {
		$id = $_REQUEST['id'];
	}
	/*if ( !empty($_GET['idjuez'])) {
		$id = $_REQUEST['idjuez'];
	}*/
	if ( $id==null) {
		header("Location: index.php");
	} else {
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT id_proyecto AS proyecmat FROM proyecto status WHERE id_proyecto=?";
		$q = $pdo->prepare($sql);
		$q->execute(array($id));
		$data = $q->fetch(PDO::FETCH_ASSOC);
		Database::disconnect();
	}
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="icon" href="img/miniicon.png">
    </head>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--íconos y tipografías usadas-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />


    <link href='https://fonts.googleapis.com/css?family=Inter' rel='stylesheet'>

    <style>
        /* Fuentes usadas */
        /* body {font-family: Arial, Helvetica, sans-serif;}*/

        body {
            font-family: 'Inter';
            margin: 0;
            padding: 0;
        }

        .paddinglogo
        {
            /* Padding del logo de Tec de Monterrey */
            /* Top Right Bottom Left*/
            padding: 7px 0px 5px 50px;
        }

        .paddingexpologo
        {
            /* Padding del logo Expoingenierías*/
            /* Top Right Bottom Left*/
            padding: 5px 0px 0px 50px;
        }

        .expobanner22{
            position: relative;
            background-color: #11476F;
            font-weight: bold;
        }

        .expobanner1{
            position: relative;
            background-color: #11476F;
            font-weight: bold;
            float: left;

        }

        .celdacolor{
            background-color: #DAEFFF;
            border-spacing: 30px;
            padding: 40px 60px 40px 60px;
        }

        .expobanner2{
            width: 100%;
            position: relative;
            background-color: #3173AF;
            font-weight: bold;
        }

        .tablainfo1{
            width: 100%;
            position: relative;
            /background-color: #e51616;/
            border-collapse: separate;
            /* Columnas filas probablemente*/
            border-spacing: 45px;

        }

        .tablainfo2{
            width: 100%;
            position: relative;
            background-color: #DAEFFF;
            border-collapse: separate;
            border-spacing: 50px;
        }

        /* Mi estudiante */
        .expotexto{
            color:#f9f9f9;
            /* Top Right Bottom Left*/
            padding: 25px 75px 25px 25px;
            text-align: right;
            font-size: 45px; 
        }
      
        /* Tipo de proyecto */
        .expotexto2{
            color:#f9f9f9;
            /* Top Right Bottom Left*/
            padding: 0px 60px 0px 40px;
            text-align: left;
            font-size: 25px;      
        }

        /* Campus */
        .expotexto3{
            color:#f9f9f9;
            /* Top Right Bottom Left*/
            padding: 0px 60px 0px 40px;
            text-align: right;
            font-size: 25px;      
        }

        /* Descripción del proyecto */
        .expotexto4{
            color:#f9f9f9;
            /* Top Right Bottom Left*/
            padding: 15px 0px 40px 40px;

            text-align: justify;
            text-justify: inter-word;
            font-size: 20px;
            font-weight: 100;
            vertical-align: top;
        }

        /* Nombre del proyecto */
        .expotexto5{
            color:#f9f9f9;
            /* Top Right Bottom Left*/
            padding: 0px 60px 10px 30px;
            text-align: right;
            vertical-align: bottom;
            font-size: 60px;
        }

        /* Subtitulo; Horario de revisión, Info y Rúbrica */
        .expotexto6{
            color:#11476F;
            /* Top Right Bottom Left*/

            vertical-align: middle;
            /* text-align: justify; */
            font-size: 25px;
            font-weight: bold;
            
        }

        /* Texto informativo */
        .expotexto7{
            color:#11476F;
            /* Top Right Bottom Left*/

            vertical-align: middle;
            text-align: justify;
            font-size: 20px;
            font-weight: bold;
        }

        /* Texto normal de tablas */
        .expotexto8{

            /* Top Right Bottom Left*/
            vertical-align: middle;
            text-align: justify;
            font-size: 18px;
            font-weight: bolder;
        }

        /* Texto normal de tablas */
        .expotexto9{
            padding: 10px;
            vertical-align: middle;
            text-align: justify;
            font-size: 18px;
            font-weight: normal;
        }

        /* Expotexto9 sin padding */
        .expotexto10{
            vertical-align: middle;
            text-align: justify;
            font-size: 18px;
            font-weight: normal;
        }

        .navbar1{
            position: relative;
            width: 100%;
            background-color: #f9f9f9;
            overflow: auto;
            z-index: 1;
            width: 100%;
            top: 0;
            left: 0;
        }

        /* Parámetros de la navbar1 */
        .navbar1 a {
            float: right;
            /* Top Right Bottom Left*/
            padding: 20px 20px 18px 20px;
            color: black;
            text-decoration: none;
            font-size: 15px;
        }

        .navbar2{
            position: absolute;
            z-index: 2;
            width:150px;
            top: 0;
            left: 0;   
        }

        /* Hover de la barra de navegación */
        .navbar1 a:hover {
            background-color: #003366;
            color: #f9f9f9;
        }

        /* Color de la pestaña activa */
        .active {
        background-color: #003366;
        }

        .columna1
        {
            /* Top Right Bottom Left*/
            padding: 5px 0px 0px 50px;
        }

        .paddingcontenedor
        {
            /* Padding del contenedor de objetos*/
            /* Top Right Bottom Left*/
            padding: 40px 45px 0px 45px;
        }

        /* Footer izquierdo */
        .footerizquierdo {
            float: left;
        }

        /* Footer derecho */
        .footerderecho {
            float: right;
            font-size : 15px;
            color : #000;
            /* Top Right Bottom Left*/
            padding: 0px 25px 0px 25px;
        }

        @media screen and (max-width: 500px) {
            .navbar1 a {
                float: none;
                display: block;
            }
        }

#navbar{
    background-color: white;
    height: 70px;
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    align-items: center;
}

#navbar img{
    height: 80%;
    margin-left: 10px;
    margin-right: 10px;
}

#navbarAzul{
    background-color: #11476F;
    height: 60px;
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    align-items: center;
}

#navbarAzul img{
    height: 80%;
    margin-left: 10px;
    margin-right: 10px;
}

#navbarAzul a{
    text-decoration: none;
    color: white;
    font-size: 30px;
    margin-right: 15px;
}

.material-symbols-outlined {
    font-variation-settings:
    'FILL' 0,
    'wght' 400,
    'GRAD' 100,
    'opsz' 55;
}

#navbarAzul span{
    text-decoration: none;
    color: white;
    font-size: 30px;
    vertical-align: -3px;
}

    </style>

    <title>
        Mi Estudiante | ExpoIngenierías | Tecnológico de Monterrey
    </title>
  
    <body>

        <!--Nueva barra de navegación-->
        <navbar>
            <div id="navbar">
                <img src="https://javier.rodriguez.org.mx/itesm/2014/tecnologico-de-monterrey-blue.png">


                <a href="cerrarsesion.php"><img src="https://icons.veryicon.com/png/o/miscellaneous/utility/logout-24.png" style="width:42px;height:42px;"></a>
                </div>
                </navbar>
                <navbar>
                <div id="navbarAzul">
                <img src="img/logo-expo.svg">
            </div>
        </navbar>



        <!--Información proyecto-->
        <div>

            <!--Objeto con un contenedor-->
            <form class="paddingcontenedor">

                <!--Tipo de proyecto; Campus Puebla-->
                <table width="100%" class="expobanner1">
                    <tr>
                        <td>
                            <div class="expotexto2">
                                <p>Tipo de proyecto</p>
                            </div>    
                        </td>

                        <td>             
                            <div class="expotexto3">
                                <p>Campus Puebla</p>
                            </div>    
                        </td>
                    </tr>
                </table>

                <!--Descripción proyecto, Nombre proyecto-->
                <table class="expobanner2">
                    <tr>

                        <td>        
                            <div class="expotexto4"  style="width:45%">
                                <p>
                                    <?php
                                        $pdo3 = Database::connect();
                                        $sql3 = 'SELECT proyecto.descripcion AS descri FROM proyecto, estudiante  WHERE  proyecto.lider = estudiante.id_estudiante  AND proyecto.id_proyecto="'.$id.'"';
                                        foreach ($pdo3->query($sql3) as $rows) {
                                            echo $rows['descri'];
                                        }
                                        Database::disconnect();

                                    ?>
                                </p>
                            </div>    
                        </td>
                        <td class="expotexto5">             
                            <div>
                                <p>
                                    <?php
                                        $pdo3 = Database::connect();
                                        $sql3 = 'SELECT proyecto.nombre AS nombreproye FROM proyecto, estudiante  WHERE  proyecto.lider = estudiante.id_estudiante  AND proyecto.id_proyecto="'.$id.'"';
                                        foreach ($pdo3->query($sql3) as $rows) {
                                            echo $rows['nombreproye'];
                                        }
                                        Database::disconnect();

                                    ?>
                                </p>
                            </div>    
                        </td>
                    </tr>
                </table>


            </form>

            <!--Info detallada-->
            <table width="100%" class="tablainfo1">
            
                <tr>
                    <td style="width:50%" class="celdacolor">   
                        <h class="expotexto6">Revisión</h>

                        <p class="expotexto7">
                            Calificación final
                        </p>

                        <p class="expotexto10"></p>
                        <table class="expotexto10" width="60%" style = border:0;>
                            <?php
                         
                                $pdo3 = Database::connect();
                                $sql3 = 'SELECT califica.calificacion FROM califica WHERE  califica.id_proyecto="'.$id.'"';


                                foreach ($pdo3->query($sql3) as $rows) {
                                     if ($rows['calificacion'] == NULL) {
                                    echo 'PENDIENTE';
                                    }

                                    else{
                                        echo '<td>'. $rows['calificacion'] .'</td>';
                                        echo '</tr>';
                                    }
                                
                                }
                                Database::disconnect();

                            ?>
                        </table>

                        <p class="expotexto7">
                            Juez asignado(a)
                        </p>
                        <table class="expotexto10" width="60%" style = border:0;>
                            <?php

                                $pdo3 = Database::connect();
                                $sql3 = 'SELECT juez.nombre AS nomj, juez.apellidoPaterno AS apellPj, juez.apellidoMaterno AS apellMj FROM   juez,califica WHERE juez.id_juez = califica.id_juez AND califica.id_proyecto="'.$id.'"';

                                foreach ($pdo3->query($sql3) as $rows) {

                                    echo '<td>'. $rows['nomj'] .' '.$rows['apellPj'].' ' .$rows['apellMj'] .'</td>';
                                    echo '</tr>';
                                }
                                Database::disconnect();

                            ?>
                        </table>

                    </td>


                    <td rowspan="2" colspan="2" style="width:50%" class="celdacolor">
                        <h class="expotexto6"> Rúbrica de evaluación </h>

                        <p class="expotexto7">
                            Proyecto grupal
                            <br>
                        </p>

                        <table class="expotexto8">
                            <tr class="expotexto7">
                              
                                <th align = center>Parámetros</th>
                                <th align = center>Descripción</th>
                            </tr>

                            <tr>
                             
                                <th align = center>1</th>
                                <th class="expotexto9" style="width:70%">
                                    Utilidad: El proyecto resuelve un problema actual en el área de
          interpes y/o el proyecto da alta prioridad al cleinte quien queda ampliamente satisfecho 
                                </th>
                            </tr>
                            <tr>
                                
                                <th align = center>2</th>
                                <th class="expotexto9">
                                    Impacto e innovación: El proyecto presenta una idea nueva e impacta positivamente en el área de interés y/o
          el producto presenta una idea nueva e incrementa la productividad
                                </th>
                            </tr>
                            <tr>
                                
                                <th align = center>3</th>
                                <th class="expotexto9">
                        Desarrollo experimental o técnico y/o resultados o producto final: Ausiencia de errores técnicos los
          resultados
          y/o producto resuelven el problema propuestos
                                </th>
                            </tr>
                            <tr>
                               
                                <th align = center>4</th>
                                <th class="expotexto9">
                        Impacto e innovación: Claridad y precisión de ideas: La presentación es concreta y clara
                                </th>
                            </tr>
                            <tr>
                               
                                <th align = center>5</th>
                                <th class="expotexto9">
                                  Respuestas a preguntas: Respuestas precisas de acuerdo al diseño, al estado de avance del proyecto, al
          impactoy
          a los resultados obtenidos
                                </th>
                         </tr>



                        </table>

  
                
                
                <tr>
                    <td class="celdacolor">

                        <h class="expotexto6">Información del proyecto</h>

                        <p class="expotexto7">Categoría</p>
                        <p class="expotexto10"></p>
                            <?php
                         
                                $pdo3 = Database::connect();
                                $sql3 = 'SELECT categoria.nombre AS cat2 FROM categoria, proyecto  WHERE  proyecto.id_categoria = categoria.id_categoria  AND proyecto.id_proyecto="'.$id.'"';


                                foreach ($pdo3->query($sql3) as $rows) {
              
                                            echo $rows['cat2'];
                                            
                                        
                                
                                }
                                Database::disconnect();

                            ?>
                        
                        <p class="expotexto7">Líder del proyecto</p>

                        <p class="expotexto10"></p>
                        <?php
                         
                                $pdo3 = Database::connect();
                                $sql3 = 'SELECT estudiante.nombre AS name, estudiante.apellidoPaterno AS apellPl, estudiante.apellidoMaterno AS apellMl FROM proyecto, estudiante  WHERE  proyecto.lider = estudiante.id_estudiante  AND proyecto.id_proyecto="'.$id.'"';


                                foreach ($pdo3->query($sql3) as $rows) {
              
                                            echo $rows['name'].' '.$rows['apellPl'].' '.$rows['apellMl'];
                                            
                                        
                                
                                }
                                Database::disconnect();

                            ?>

                        <p class="expotexto7">Integrantes del equipo</p>

                        <table class="expotexto10" width="60%" style = border:0;>
                            <?php

                                $pdo3 = Database::connect();
                                $sql3 = 'SELECT estudiante.nombre AS nom, estudiante.apellidoPaterno AS apell, estudiante.apellidoMaterno AS apell2 from estudiante, miembrosProyecto WHERE estudiante.id_estudiante = miembrosProyecto.id_estudiante AND miembrosProyecto.id_proyecto="'.$id.'"';

                                foreach ($pdo3->query($sql3) as $rows) {

                                    echo '<td>'.'<strong>-</strong>'. $rows['nom'] .' '.$rows['apell'].' '.$rows['apell2'] .'</td>';
                                    echo '</tr>';
                                }
                                Database::disconnect();

                            ?>
                        </table>

                    </td>
                </tr>

                <tr>
                    <td class="celdacolor" colspan="2">
                        
                        <h class="expotexto6"> Comentarios y retroalimentación </h>

                        <p class="expotexto7">Profesor</p>

                        <p class="expotexto10"></p>
                            <?php
                         
                                $pdo3 = Database::connect();
                                $sql3 = 'SELECT status.retroprof FROM status WHERE  status.id_proyecto="'.$id.'"';


                                foreach ($pdo3->query($sql3) as $rows) {
                                     if ($rows['retroprof'] == NULL) {
                                    echo 'SIN COMENTARIOS';
                                    }

else{
    echo $rows['retroprof'];
                                   
}
                                
                                }
                                Database::disconnect();

                            ?>


                        <p class="expotexto7">Juez</p>

                        <p class="expotexto10">
                        </p>
                            <?php
                         
                                $pdo3 = Database::connect();
                                $sql3 = 'SELECT califica.retrojuez FROM califica WHERE  califica.id_proyecto="'.$id.'"';


                                foreach ($pdo3->query($sql3) as $rows) {
                                     if ($rows['retrojuez'] == NULL) {
                                    echo 'EN ESPERA';
                                    }

else{
    echo $rows['retrojuez'];
                                    echo '</tr>';
}
                                
                                }
                                Database::disconnect();

                            ?>
                    </td>
                </tr>
            </table>
        </div>
        

        <!--
        <div class="expobanner22">
            <div class="expofondo">
                <img src="/images/img-principal.png" alt="" height="100px">
                <div class="expotexto">
                    <h1><b>Your Title</b></h1>
                    <p>The information you want to present.</p>
                    </a></p>
                </div>
            </div>            
        </div>
        -->

        <div id="footerline">

            </div>
            <!--Footer-->
            <div id="footer">

            <!--Footer izquierdo-->
            <!-- <h3 class="footerizquierdo">Copyright Stuff.</h3> -->

            <!--Footer derecho-->
            <p class="footerderecho">©2023 Tecnológico de Monterrey. Todos los derechos reservados.</p>
            <div style="clear: both"></div>
        </div>


    </body>
</html>


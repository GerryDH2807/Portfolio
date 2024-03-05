<!DOCTYPE html>
<html>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href='https://fonts.googleapis.com/css?family=Inter' rel='stylesheet'>
    <head>
        <link rel="stylesheet" type="text/css" href="css/iniciosesion.css">
        <title>ExpoIngenieria</title>
        <link rel="icon" href="img/miniicon.png">
        <meta charset = "utf-8" />
    </head>


    
    <body>
        <table>
            <tr>
                <td align="left" style="width: 33.33%;" class="logo"><img src="img/logo-tec.png" style="width: 35%;height: 15%;" id="logo-tec"></td>
                <td align="right" style="width: 33.33%;" class = "texto2">MiJuez</td>
            </tr>
        </table>

        <br>

        <table>
            <tr>
                <td style="width: 33.33%;"></td>
                <td align="center" style="width: 33.33%;" class="logo"><img src="img/logo-expo.svg" style="width: 100%;height: 100%;" id="logo-tec"></td>
                <td style="width: 33.33%;"></td>
            </tr>
        </table>

        <br id="logo-input">

        <form class="form-horizontal" action="iniciarses.php" method="POST">

            <table align="center" width="100%">
                <tr> 
                    <td style="width: 33.33%;"></td>
                    <td align="center"><input type="email" id="correo" name="correo" required maxlength="30" placeholder="  Correo..." size="50"  class="input" value="<?php echo !empty($correo)?$correo:'';?>"></td>
                    <td style="width: 33.33%;"></td>
                </tr>

            </table>

            <br id="input-input">

            <table align="center" width="100%">
                <tr> 
                    <td style="width: 33.33%;"></td>
                    <td align="center"><input type="password" id="password" name="password" required maxlength="30" placeholder="  Contraseña..." size="50"  class="input" value="<?php echo !empty($password)?$password:'';?>"></td> 
                    <td style="width: 33.33%;"></td>
                </tr>
            </table>

            <center>
                <div align="center">
					<span id = "message" style="color: #646464"><strong> </strong></span>
                </div>
            </center>

            <br id="input-boton">

            <?php
                if(isset($_GET['error'])){
                    ?>
                    <center>
                        <div class = "errordiv">
                            <p class = "error"><strong>
                                <?php
                                echo $_GET['error'];
                                ?>
                            </strong></p>
                        </div>
                    </center>
                    <br>
            <?php
                }

            ?>

            <table align="center" width="100%">
                <tr> 
                    <td style="width: 42"></td>
                    <td align="center" class="botonborde" style="width: 23%;"><button align="center" class="botonfinal" id="botonfinal" type="submit"><strong>Iniciar sesion</strong></button></td>
                    <td style="width: 42;"></td>
                </tr>
            </table>
        </form>

        <br id="boton-boton">

        <table align="center" width="100%">
            <tr> 
                <td style="width: 46;"></td>
                <td align="center" class="botonborde2" style="width: 20%;"><button align="center" class="botonfinal2" id="botonfinal2" name="botonfinal2"><strong><a href="create.php" id="Crearcuenta">Crear cuenta</a></strong></button></td>
                <td style="width: 46;"></td>
            </tr>
        </table>

        <br id="boton-texto">

        <table align="center" width="100%">
            <tr>
                <td style="width: 33.33%;"></td>
                <td align="center" style="width: 33.33%;" class="texto"><strong>¿OLVIDASTE TU CONTRASEÑA?</strong></td>
                <td style="width: 33.33%;"></td>
            </tr>

            <tr>
                <td style="width: 33.33%;"></td>
                <td align="center" style="width: 33.33%;" class="texto"><strong>¿NECESITAS AYUDA? CONTÁCTANOS</strong></td>
                <td style="width: 33.33%;"></td>
            </tr>

        </table>
        <p class="footer">@2023<a class="fotlink" href="https://tec.mx/es">Tecnológico de Monterrey.</a></p>
    </body>
</html>

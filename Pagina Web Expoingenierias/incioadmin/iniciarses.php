<?php
    session_start();
    include('conexioninicio.php');

    if(isset($_POST['correo']) && isset($_POST['password'])){


        $correo = $_POST['correo'];
        $password = $_POST['password'];

        if(empty($correo)){
            header("Location:index.php?error=Ingresa un correo para continuar");
            exit();
        }
        elseif(empty($password)){
            header("Location:index.php?error=Ingresa una contraseña para continuar");
            exit();
        }
        else{

            $sql = "SELECT * FROM administrador WHERE correo = '$correo' AND contraseña = '$password'";
            $result = mysqli_query($conexion, $sql);

            if ( mysqli_num_rows ($result) == 1){
                $row = mysqli_fetch_assoc($result);
                if ($row['correo'] == $correo && $row['contraseña'] == $password){
                    $_SESSION['correo'] = $row['correo'];
                    header("Location: admin.php");
                    exit();
                }
                else{
                    header("Location:index.php?error=El usuario o la contraseña son incorrectos ");
                    exit();
                }
            }
            else{
                echo "dentro if inicial";
                header("Location:index.php?error=El usuario o la contraseña son incorrectos ");
                exit();
            }

        }
    }

    else{
        header("Location:index.php");
            exit();
    }
?>
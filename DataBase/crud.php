<?php
    include_once("conexion.php");

    if (isset($_GET['accion'])) {
        $opcion = $_GET['accion'];
    } else {
        $_SESSION['mensajeTexto'] = "Error identificando la opción";
        $_SESSION['mensajeTipo'] = "alert-danger";

        header("Location: ../404.html");
    }

    switch ($opcion) {
        case 'INS':
            if (isset($_POST['save'])) {
                $name = $_POST['name'];
                $user = $_POST['user'];
                $mail = $_POST['mail'];
                $pass = sha1($_POST['pass']);

                $resultadoT = $link->query("SELECT EXISTS (SELECT * FROM `Clientes` WHERE Correo = '$mail' OR Username = '$user');");
                $rowT = mysqli_fetch_row($resultadoT);

                if ($rowT[0]=="1"){

                    header("Location: ../404.html");
                } else {
                        $query = "
                            INSERT INTO `Clientes`
                            (`Nombre`,
                            `Username`, 
                            `Correo`, 
                            `Password`, 
                            `Estado`) 
                            VALUES (
                            '$name',
                            '$user',
                            '$mail',
                            '$pass',
                            'A')
                        ";

                        $resultado = mysqli_query($link, $query);

                        if (!$resultado) {
                            // echo("Error 0001: Error Insertando Usuario en la Base de Datos");
                            $_SESSION['mensajeTexto'] = "Error Insertando en la Base de Datos";
                            $_SESSION['mensajeTipo'] = "alert-danger";

                            header("Location: ../404.html");
                        } else{
                            // echo("Alerta 0001: Registro Insertado en la Base de Datos");
                            $_SESSION['mensajeTexto'] = "Registro Insertado en la Base de Datos";
                            $_SESSION['mensajeTipo'] = "alert-success";
                            
                            header("Location: ../index.php");

                        }
                    
                    }
            }
            break;
    }
?>
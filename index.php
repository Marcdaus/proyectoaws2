<?php
include 'conexion.php';
?>
<!DOCTYPE html>
<html>
<html lang="es">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Inicio de sesión</title>
            <link rel="stylesheet" href="formato.css">
        </head>
        <body >
            <div class="container">
                <h1>Iniciar sesión</h1>
 
                <form method="post">
                    <label>ID USUARIO</label><br>
                    <p></p>
                    <input type="number" name="id" size="20" required><br>
                    <p></p>
                    <label>CONTRASEÑA</label><br>
                    <p></p>
                    <input type="password" name="contrasenya" size="20" required><br>
                    <p></p>
                    <button class="btnlog" type="submit" value="Iniciar sesión"></button>
                </form>

                <?php

                    $id = $_POST['id'];
                    $contrasenya = $_POST['contrasenya'];
 
                    session_start();
                   $_SESSION['id'] = "$id";
                   $_SESSION['contrasenya'] = "$contrasenya";   

                    if (strlen($id) > 0 && strlen($contrasenya) > 0) {

                        $comprobando = "SELECT 
                                CASE 
                                    WHEN EXISTS (
                                        SELECT * FROM trabajadores 
                                        WHERE id = '$id' AND contrasena = '$contrasenya'
                                    ) THEN 1
                                ELSE 0
                                END AS resultado";
                        $respuesta = $conectar->query($comprobando);
                        $row = $respuesta->fetch_assoc();
                        $result = $row['resultado'];

                        if ($result == 1) {
                            header("Location: fichaje.php"); 
                            } 
                            else {
                                echo "<span style=\"color: red;\">el usuario y la contraseña no coinciden</span>";
                            }
                        
                    }   
                ?>
             </div>
        </body> 
</html>



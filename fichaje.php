<?php
    include 'conexion.php';

    // solo pueden acceder a esta paguina los usarios de la lista
     session_start();
    $id = $_SESSION['id']; 
    $contrasenya = $_SESSION['contrasenya']; 
    $comprobando = "SELECT 
                        CASE 
                            WHEN EXISTS (SELECT * FROM trabajadores WHERE id = '$id' AND contrasena = '$contrasenya')  
                            THEN 1
                            ELSE 0
                        END AS resultado";

    $respuesta = $conectar->query($comprobando);
    $row = $respuesta->fetch_assoc();
    $resultado = $row['resultado'];

    if ($resultado == 0) {
        header("Location: index.php"); 
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>FICHAJES</title>
            <link rel="stylesheet" href="formato.css">
</head>
<body>
<div class="container">

        <!-- botones de atras  -->
        <form method="post" >
            <button class="btnAtras" type="submit" name="accion" value="atras">
        </button>
        </form>


        <!-- funcionamiento de el boton atras-->
        <?php


            if(isset($_POST['accion'])) {
                $accion = $_POST['accion'];
                if ($accion == 'atras') {
                    header("Location: index.php"); 
                }
            }
        ?>

    <!-- botones de entrada y salida  -->

    <form method="post">
        <button class="btnentrada" type="submit" name="accion" value="entrada"><b></b></button>
        <button class="btnsalida" type="submit" name="accion" value="salida"><b></b></button>
    </form>


    <!-- funcionamiento de los botones de entrada y salida -->
    <?php

        $consulta_trabajdores = "SELECT * FROM `trabajadores` WHERE id=$id ";
        $result = $conectar->query($consulta_trabajdores);
        $datos = $result->fetch_assoc();
        $nombre = $datos["nombre"];

        if(isset($_POST['accion'])) {
            $accion = $_POST['accion'];
            if ($accion == 'entrada') {
                $entrada = "INSERT INTO entradas_salidas (trabajador_id, nombre, fecha_hora, tipo) VALUES ($id, '$nombre', CURRENT_TIMESTAMP, 'entrada')";
                $conectar->query($entrada);
                echo "<span style=\"color: green;\">Entrada registrada correctamente</span>";
            }
            elseif ($accion == 'salida') {
                $salida = "INSERT INTO entradas_salidas (trabajador_id, nombre, fecha_hora, tipo) VALUES ($id, '$nombre', CURRENT_TIMESTAMP, 'salida')";
                $conectar->query($salida);
                echo "<span style=\"color: green;\">Salida registrada correctamente</span>";
            }
        }

    ?>
            <!-- botones de aministador  -->
    <!-- solo se mostrara si el usuario es administrador  -->
    <?php
        $consulta_administrador = "SELECT administrador FROM `trabajadores` WHERE id=$id";
        $resultado_administrador = $conectar->query($consulta_administrador);
        $inf_admin = $resultado_administrador->fetch_assoc();
        $admin_sn = $inf_admin['administrador'];


        if ($admin_sn == 'si') {
            echo '<form method="post" action="">';
            echo '    <button class="btnA" type="submit" name="accion" value="administrar"></button>';
            echo '</form>';
    
            if(isset($_POST['accion'])) {
                $accion = $_POST['accion']; 
                if ($accion == 'administrar') {
                    session_start();
                    $_SESSION['admin'] = "$admin";
                    header("Location: administrar.php"); 
                }
            }
        }

    ?>  

</div>
</body>
</html>



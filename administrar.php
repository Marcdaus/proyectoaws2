<?php
    include 'conexion_admin.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>ADMINISTRAR</title>

            <link rel="stylesheet" href="formato.css">
</head>
<body>
<div class="container">

    <!-- botones de atras  -->
        <form method="post">
            <button class="btnAtras" type="submit" name="accion" value="atras"><b></b></button>
        </form>


        <!-- funcionamiento de el boton atras-->
        <?php


            if(isset($_POST['accion'])) {
                $accion = $_POST['accion'];
                if ($accion == 'atras') {
                    header("Location: fichaje.php"); 
                }
            }
        ?>

<!-- botones de entrada y salida  -->

  <form method="post">
    <button class="btnusu" type="submit" name="accion" value="usuarios"><b></b></button>
    <button class="btnentsal" type="submit" name="accion" value="entradas_salidas"><b></b></button>
  </form>


<!-- funcionamiento de los botones de usuarios y entradas_salidas-->

<?php

if(isset($_POST['accion'])) {
    $accion = $_POST['accion'];
    if ($accion == 'usuarios') {
        header("Location: usuarios.php"); 
    } elseif ($accion == 'entradas_salidas') {
        header("Location: entradas_salidas.php"); 
    }
}

?>

</div>

</body>
</html>
<?php
    include 'conexion_admin.php';

    // funcionamiento de el boton atras y añadir y actualizaxion del boton guardar

    if(isset($_POST['accion'])) {
        $accion = $_POST['accion'];
    if ($accion == 'atras') {
        header("Location: administrar.php"); 
    } elseif ($accion == 'anadir') {
        header("Location: anadir.php"); 
    }
    elseif ($accion == 'guardar') {
        header("Location: usuarios.php"); 
    }
    elseif ($accion == 'eliminar') {
        header("Location: usuarios.php"); 
    }
    }


?>
<!DOCTYPE html>
<html lang="es">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>USUARIOS</title>
            <link rel="stylesheet" href="formato.css">
</head>
<body>

    <!-- botones de atras  -->
    <form method="post">
    <button class="btnAtras2" type="submit" name="accion" value="atras"></button>
    </form>

    <?php
        $todos_trabajadores = "SELECT * FROM `trabajadores`";
        $ejecutado = $conectar->query($todos_trabajadores);

        while ($fila = $ejecutado->fetch_assoc()) {
            // Agregar los datos de cada trabajador al arreglo
            $trabajadores[] = $fila;
        }

        foreach ($trabajadores as $trabajador) {
            if ($trabajador['id'] != 1) {
                echo '<form method="post">
                        <input type="hidden" name="id" value="' . $trabajador["id"] . '">
                        <p style="display: inline-block;"> ' . $trabajador["id"] . ' </p>
                        <input type="text" name="usuario" size="20" placeholder="Usuario" value="' . $trabajador["nombre"]  . '" required>
                        <input type="password" placeholder="Contraseña" name="contrasena" size="20" value="' . $trabajador["contrasena"]  . '" required>
                        <label for="admin">Administrador:</label>
                        <select name="administrador" required>
                            <option value="si"' . ($trabajador["administrador"] == "si" ? ' selected' : '') . '>Sí</option>
                            <option value="no"' . ($trabajador["administrador"]  == "no" ? ' selected' : '') . '>No</option>
                        </select>
                        <button class="btnE" type="submit" name="eliminar['.$trabajador["id"].']" value="eliminar"></button>
                        <button class="btnG" type="submit" name="guardar['.$trabajador["id"].']" value="guardar"></button>
                    </form>';

                if(isset($_POST['eliminar'][$trabajador["id"]])) {
                    $id_eliminar = $trabajador["id"];
                    $comprobando = "DELETE FROM trabajadores WHERE id = $id_eliminar";
                    $conectar->query($comprobando);
                    header("Location: usuarios.php");
                }

                if(isset($_POST['guardar'][$trabajador["id"]])) {
                    $id_guardar = $trabajador["id"];
                    $nuevo_usuario = $_POST['usuario'];
                    $nueva_contrasena = $_POST['contrasena'];
                    $nuevo_administrador = $_POST['administrador'];
                    $actualizar = "UPDATE trabajadores SET nombre = '$nuevo_usuario', contrasena = '$nueva_contrasena', administrador = '$nuevo_administrador' WHERE id = $id_guardar";
                    $conectar->query($actualizar);
                    header("Location: usuarios.php");
                }
            }   
        }
    ?>
    <!-- botones de añadir -->
    <form method="post">
        <button class="btnañadir" type="submit" name="accion" value="anadir"></button>
    </form>
</body>
</html>


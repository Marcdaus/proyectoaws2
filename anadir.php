<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AÑADIR</title>
    <link rel="stylesheet" href="formato.css">
</head>
<body>
    <div class="container2">
        <!-- botones de atras -->
        <form method="post">
            <button class="btnAtras3" type="submit" name="accion" value="atras"><b></b></button>
        </form>

        <!-- Funcionamiento del botón atras -->
        <?php
        if(isset($_POST['accion']) && $_POST['accion'] == 'atras') {
            header("Location: /usuarios.php");  
        }
        ?>

        <?php
        include 'conexion_admin.php';

        if(isset($_POST['accion']) && $_POST['accion'] == 'añadir') {

            // Obtener datos del formulario
            $nombre = $_POST['nombre'];
            $contrasena = $_POST['contrasena'];
            $admin = $_POST['administrador'];
            $id = $_POST['id'];

            // Verificar si el ID ya existe
            $consulta = "SELECT id FROM trabajadores WHERE id = '$id'";
            $resultado = $conectar->query($consulta);

            if ($resultado->num_rows > 0) {
                echo "<span style='color: red;'>Error: El ID ya existe.</span>";
            } else {
                // Insertar el nuevo usuario si el ID no existe
                $insertando = "INSERT INTO trabajadores (id, nombre, contrasena, administrador) VALUES ('$id', '$nombre', '$contrasena', '$admin')";
                $conectar->query($insertando);
                header("Location: usuarios.php");
            }
        }

        $consulta = "SELECT MAX(id) AS ultimo_id FROM trabajadores";
        $resultado = $conectar->query($consulta);
        $fila = $resultado->fetch_assoc();
        $ultimo_id_disp = $fila['ultimo_id'] + 1;
        ?>

        <form method="post">
            <label for="id">ID:</label>
            <!-- Asignar el último ID más uno como valor por defecto -->
            <input type="text" name="id" size="5" value="<?php echo $ultimo_id_disp; ?>" required>
            <br><br>
            <p for="nombre">Nombre</p>
            <input type="text" name="nombre" size="20" value="" required>
            <br><br>
            <p for="contrasena">Contraseña:</p>
            <input type="text" name="contrasena" size="20" value="" required>
            <br><br>
            <label>Administrador</label>
            <select name="administrador" required>
                <option value="si">Sí</option>
                <option value="no">No</option>
            </select>
            <br><br>
            <button class="btnañadir2" type="submit" name="accion" value="añadir"></button>
        </form>
    </div>
</body>
</html>

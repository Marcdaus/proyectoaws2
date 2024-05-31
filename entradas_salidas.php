<?php
include 'conexion_admin.php'; // Incluir archivo de conexión

// Función para obtener todas las entradas y salidas de todos los trabajadores
function obtenerEntradasSalidas() {
    global $conectar;
    $consulta = "SELECT es.id, t.id AS trabajador_id, t.nombre, es.fecha_hora, es.tipo FROM entradas_salidas es JOIN trabajadores t ON es.trabajador_id = t.id";
    $resultado = $conectar->query($consulta);
    return $resultado;
}

// Función para actualizar la fecha de una entrada o salida
function actualizarFecha($id, $fecha_hora) {
    global $conectar;
    $consulta = "UPDATE entradas_salidas SET fecha_hora = '$fecha_hora' WHERE id = '$id'";
    $conectar->query($consulta);
}

// Función para eliminar una entrada o salida
function eliminarEntradaSalida($id) {
    global $conectar;
    $consulta = "DELETE FROM entradas_salidas WHERE id = '$id'";
    $conectar->query($consulta);
}

// Verificar si se envió el formulario de actualización
if (isset($_POST['accion']) && $_POST['accion'] == 'actualizar') {
    $id = $_POST['id'];
    $fecha_hora = $_POST['fecha_hora'];
    actualizarFecha($id, $fecha_hora);
}

// Verificar si se envió el formulario de eliminación
if (isset($_POST['accion']) && $_POST['accion'] == 'eliminar') {
    $id = $_POST['id'];
    eliminarEntradaSalida($id);
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Registro de Entradas y Salidas</title>
    <link rel="stylesheet" href="formato.css">
</head>
<body>
    <!-- Botón de atrás -->
    <form method="post">
        <button class="btnAtras2" type="submit" name="accion" value="atras"></button>
    </form>

    <!-- Funcionamiento del botón atrás -->
    <?php
    if (isset($_POST['accion']) && $_POST['accion'] == 'atras') {
        header("Location: administrar.php");  
    }
    ?>

    <h2>Registro de Entradas y Salidas</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Trabajador ID</th>
            <th>Nombre</th>
            <th>Fecha y Hora</th>
            <th>Tipo</th>
            <th>Acción</th>
        </tr>
        <?php
        // Obtener todas las entradas y salidas
        $resultado = obtenerEntradasSalidas();
        while ($row = $resultado->fetch_assoc()) {
            echo "<tr>";
            echo "<td>".$row['id']."</td>";
            echo "<td>".$row['trabajador_id']."</td>";
            echo "<td>".$row['nombre']."</td>";
            echo "<td>".$row['fecha_hora']."</td>";
            echo "<td>".$row['tipo']."</td>";
            // Formulario para actualizar la fecha de entrada o salida
            echo "<td>
                <form method='post' style='display: inline-block;'>
                    <input type='hidden' name='id' value='".$row['id']."'>
                    <input type='datetime-local' name='fecha_hora' value='".date('Y-m-d\TH:i:s', strtotime($row['fecha_hora']))."' required>
                    <button class='btnG' type='submit' name='accion' value='actualizar'></button>
                </form>
                <form method='post' style='display: inline-block;'>
                    <input type='hidden' name='id' value='".$row['id']."'>
                    <button class='btnE' type='submit' name='accion' value='eliminar'></button>
                </form>
            </td>";
            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>


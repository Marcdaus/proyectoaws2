<?php
    $servidor = "localhost";
    $usuario_bd = "marc";
    $contrasenya_bd = "marc";
    $base_datos = "fichar";

    $conectar = mysqli_connect($servidor, $usuario_bd, $contrasenya_bd, $base_datos);
    
// solo pueden acceder a esta paguina los usarios administradores

session_start();
$id = $_SESSION['id']; 
$admin= $_SESSION['admin']; 

$comprobando = "SELECT 
CASE 
    WHEN EXISTS (
        SELECT * FROM trabajadores 
        WHERE  administrador = 'si' AND id = '$id'
    ) THEN 1
    ELSE 0
END AS resultado";

$respuesta = $conectar->query($comprobando);
$row = $respuesta->fetch_assoc();
$resultado = $row['resultado'];

if ($resultado == 0) {
        header("Location: /index.php/"); 
}

?>
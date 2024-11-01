<?php

session_start();
// Verifica si el usuario ha iniciado sesión
if (!isset($_SESSION['user_id'])) {
    header('location:../index.php');    
}

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);  // Asegúrate de convertir el ID a un entero para evitar inyecciones SQL

    include 'dbcon.php';

    // Consulta para eliminar el usuario con el ID especificado
    $qry = "DELETE FROM usuarios WHERE id_usuario = $id";
    $result = mysqli_query($con, $qry);

    if ($result) {
        // Redirige a la página de eliminación de usuarios
        header('Location: ../list-users.php');
        exit(); // Asegúrate de salir después de redirigir para evitar la ejecución adicional del código
    } else {
        // Muestra un mensaje de error si la eliminación falla
        echo "ERROR!!";
    }
}
?>

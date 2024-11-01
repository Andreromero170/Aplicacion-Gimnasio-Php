<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('location:../index.php');
    exit();
}

$conn = mysqli_connect('localhost', 'root', '', 'gymu');
if (!$conn) {
    die("Error de conexión: " . mysqli_connect_error());
}

// Verificar si se ha proporcionado un id de usuario
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $user_id = intval($_GET['id']);
    
    // Actualizar el estado del usuario a activo
    $qry = "UPDATE usuarios SET suspendido = 0 WHERE id_usuario = ?";
    $stmt = mysqli_prepare($conn, $qry);
    mysqli_stmt_bind_param($stmt, 'i', $user_id);
    
    if (mysqli_stmt_execute($stmt)) {
        $_SESSION['message'] = "Usuario reactivado exitosamente.";
    } else {
        $_SESSION['message'] = "Error al reactivar al usuario.";
    }
    
    mysqli_stmt_close($stmt);
} else {
    $_SESSION['message'] = "ID de usuario no válido.";
}

mysqli_close($conn);
header('Location: list-users.php');
exit();
?>

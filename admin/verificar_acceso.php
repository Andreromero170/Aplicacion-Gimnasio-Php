<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificar Acceso</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id'])) {
    header('location:../index.php');
    exit;
}

function verificar_acceso($pagina, $user_id) {
    $conn = new mysqli('localhost', 'root', '', 'gymu');
    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    // Verifica el estado de acceso del usuario para la página actual
    $stmt = $conn->prepare("SELECT estado_acceso FROM permisos_usuarios WHERE id_usuario = ? AND enlace_pagina = ?");
    $stmt->bind_param("is", $user_id, $pagina);
    $stmt->execute();
    $result = $stmt->get_result();
    
    // Verifica si se obtuvo algún resultado
    $row = $result->fetch_assoc();
    $estado_acceso = $row['estado_acceso'] ?? null;  // Usa null como valor predeterminado si no hay resultado

    $stmt->close();
    $conn->close();

    // Si no hay resultado o el estado de acceso es Bloqueado, muestra una alerta y redirige
    if (is_null($estado_acceso)) {
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Acceso denegado',
                text: 'No tienes permisos configurados para esta página.',
                confirmButtonText: 'Aceptar'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'index.php';
                }
            });
        </script>";
        exit;
    } elseif ($estado_acceso === 'Bloqueado') {
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Acceso denegado',
                text: 'No tienes permiso para acceder a esta página.',
                confirmButtonText: 'Aceptar'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'index.php';
                }
            });
        </script>";
        exit;
    }
}

// Llama a la función verificar_acceso al inicio de la página
verificar_acceso(basename($_SERVER['PHP_SELF']), $_SESSION['user_id']);
?>

 
</body>
</html>
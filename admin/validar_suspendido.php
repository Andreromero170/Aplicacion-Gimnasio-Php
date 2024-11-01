<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suspender</title><script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    
<?php
session_start();



function verificar_suspendido($user_id) {
    global $conn; // Asegúrate de que la conexión a la base de datos sea accesible aquí

    // Consulta para obtener el estado de suspensión del usuario
    $qry = "SELECT suspendido FROM usuarios WHERE id_usuario = $user_id";
    $resultado = mysqli_query($conn, $qry);
    
    if ($resultado) {
        $row = mysqli_fetch_assoc($resultado);
        
        // Verifica si el usuario está suspendido
        if ($row['suspendido'] == 1) {
            // Usuario suspendido
            echo "<script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Acceso Denegado',
                        text: 'Tu cuenta está suspendida. No puedes acceder a la plataforma.',
                    }).then(function() {
                        window.location.href = '../index.php'; // Redirige al inicio
                    });
                  </script>";
            exit();
        }
    } else {
        echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Error al verificar el estado de suspensión: " . mysqli_error($conn) . "',
                }).then(function() {
                    window.history.back();
                });
              </script>";
        exit();
    }
}

// Verifica si el usuario está autenticado
if (!isset($_SESSION['user_id'])) {
    header('location:../index.php');
    exit;
}

$user_id = $_SESSION['user_id'];
verificar_suspendido($user_id); // Llama a la función para verificar el estado de suspensión

?>


</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Gimnasio</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
<?php
session_start();

// Verifica si el usuario ha iniciado sesión
if (!isset($_SESSION['user_id'])) {
    header('location:../index.php');    
}

// Conexión a la base de datos
$conn = mysqli_connect('localhost', 'root', '', 'gymu');

if (!$conn) {
    die("Error de conexión: " . mysqli_connect_error());
}

// Verifica si se ha enviado el ID
if (isset($_GET['id'])) {

    $id_evento = intval($_GET['id']); 

    // Consulta SQL para eliminar la inscripción del evento
    $query = "DELETE FROM inscripcion_eventos WHERE id = '$id_evento'";
    
    if (mysqli_query($conn, $query)) {
        echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'Eliminación Exitosa',
                    text: 'Persona eliminada de la inscripción al evento.',
                }).then(() => {
                    window.location.href = 'inscripciones-list.php'; // Redirige después de mostrar el mensaje
                });
            </script>";
        exit();
    } else {
        echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Error al eliminar la inscripción del evento.',
                }).then(() => {
                    window.location.href = 'inscripcion-persons.php'; // Redirige después de mostrar el mensaje
                });
            </script>";
        exit();
    }
} else {
    echo "<script>
    Swal.fire({
        icon: 'error',
        title: 'Error',
        text: 'ID de la inscripcion no proporcionado.',
    }).then(() => {
        window.location.href = 'inscripcion-persons.php'; // Redirige después de mostrar el mensaje
    });
</script>";
    exit();
}

// Cerrar conexión
mysqli_close($conn);
?>
</body>
</html>

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
    exit(); // Asegurarse de que el script no continúe
}

// Incluye la conexión a la base de datos
include 'dbcon.php';

// Verifica si la cédula fue pasada por la URL
if (isset($_GET['id'])) {
    $cedula_persona = mysqli_real_escape_string($con, $_GET['id']);  // Escapar la cédula para evitar inyecciones SQL

    // Consulta para eliminar la persona directamente usando la cédula
    $deleteQry = "DELETE FROM personas WHERE cedula = '$cedula_persona'";
    $deleteResult = mysqli_query($con, $deleteQry);

    if ($deleteResult) {
        // Redirigir a la página de personas después de la eliminación exitosa
        echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Éxito',
                text: 'La persona ha sido eliminada con éxito.',
            }).then(function() {
                window.location.href = '../persons.php';
            });
        </script>";
    } else {
        // Error al eliminar el registro en la base de datos
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Error al eliminar la persona de la base de datos.',
            });
        </script>";
    }
} else {
    // Si no se pasa ninguna cédula en la URL
    echo "<script>
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'No se ha proporcionado ninguna cédula.',
        }).then(function() {
            window.location.href = '../persons.php';
        });
    </script>";
}
?>

</body>
</html>

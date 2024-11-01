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

    $id_servicio = intval($_GET['id']); 

    // Consulta SQL para eliminar el miembro del grupo
    $query = "DELETE FROM miembro_tarifa WHERE id = '$id_servicio'";
    
    if (mysqli_query($conn, $query)) {
        header('Location: member-group-remove.php');
        exit();
    } else {
        echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Error al Eliminar un Miembro de un Servicio.',
                });
            </script>";
            header('Location: member-group-remove.php');
            exit();
    }
} else {
    echo "<script>
    Swal.fire({
        icon: 'error',
        title: 'Error',
        text: 'Miembro No Proporcionado.',
    });
</script>";
header('Location: member-group-remove.php');
exit();
}

// Cerrar conexión
mysqli_close($conn);
?>


</body>
</html>
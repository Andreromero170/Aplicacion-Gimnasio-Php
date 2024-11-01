<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Ventas</title>
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

if (isset($_GET['id'])) {
    $id_venta = intval($_GET['id']);  // Convertir el ID a un entero para evitar inyecciones SQL

    include 'dbcon.php';

    // Consulta para verificar si la venta existe en la base de datos
    $qry = "SELECT id_producto FROM ventas WHERE id = $id_venta";
    $result = mysqli_query($con, $qry);

    if ($result && mysqli_num_rows($result) > 0) {
        // La venta existe, entonces procedemos a eliminarla
        $deleteQry = "DELETE FROM ventas WHERE id = $id_venta";
        $deleteResult = mysqli_query($con, $deleteQry);

        if ($deleteResult) {
            // Redirigir a la página de ventas después de la eliminación exitosa
            header('Location: ../shops.php');
            exit();
        } else {
            // Error al eliminar el registro en la base de datos
            echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Error al Eliminar la Venta de la Base de Datos.',
                });
            </script>";
        }
    } else {
        // Venta no encontrada
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Venta no encontrada.',
            });
        </script>";
    }
}

?>

</body>
</html>

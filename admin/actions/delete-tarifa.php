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

if (isset($_GET['id'])) {
    $id_tarifa = intval($_GET['id']);  // Convertir el ID a un entero para evitar inyecciones SQL

    include 'dbcon.php';

    // Consulta para verificar si la tarifa existe en la base de datos
    $qry = "SELECT nombre FROM tarifas WHERE id = $id_tarifa";
    $result = mysqli_query($con, $qry);

    if ($result && mysqli_num_rows($result) > 0) {
        // La tarifa existe, entonces procedemos a eliminar
        $deleteQry = "DELETE FROM tarifas WHERE id = $id_tarifa";
        $deleteResult = mysqli_query($con, $deleteQry);

        if ($deleteResult) {
          
            header('Location: ../services.php');
            exit();
        } else {
            // Error al eliminar el registro en la base de datos
            echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Error al Eliminar la Tarifa de la Base de Datos.',
                });
            </script>";
        }
    } else {
        // Tarifa no encontrada
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Tarifa no encontrada.',
            });
        </script>";
    }
}

?>

</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Producto</title>
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
    $id_producto = intval($_GET['id']);  // Convertir el ID a un entero para evitar inyecciones SQL

    include 'dbcon.php';

    // Consulta para verificar si el producto existe en la base de datos
    $qry = "SELECT * FROM productos WHERE id = $id_producto";
    $result = mysqli_query($con, $qry);

    if ($result && mysqli_num_rows($result) > 0) {
        // El producto existe, entonces procedemos a eliminarlo
        $deleteQry = "DELETE FROM productos WHERE id = $id_producto";
        $deleteResult = mysqli_query($con, $deleteQry);

        if ($deleteResult) {
            // Redirigir a la página de productos después de la eliminación exitosa
            echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'Eliminación Exitosa',
                    text: 'Producto eliminado de la base de datos.',
                }).then(() => {
                    window.location = '../products.php'; // Redirige a la lista de productos
                });
            </script>";
        } else {
            // Error al eliminar el registro en la base de datos
            echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Error al eliminar el producto de la base de datos.',
                });
            </script>";
        }
    } else {
        // Producto no encontrado
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Producto no encontrado.',
            });
        </script>";
    }
}
?>

</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Incluir SweetAlert CSS y JS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
</head>
<body>

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

// Validar y obtener los datos del formulario
$estado_pago = isset($_POST['estado_pago']) ? $_POST['estado_pago'] : '';
$id_usuarios = isset($_POST['id_usuarios']) ? $_POST['id_usuarios'] : [];

if (!empty($id_usuarios) && ($estado_pago == 'Pendiente' || $estado_pago == 'Pagado')) {
    $id_usuarios = implode(",", array_map('intval', $id_usuarios));
    
    $qry = "UPDATE pagos_mensuales SET estado_pago = '$estado_pago' WHERE id_usuario IN ($id_usuarios)";
    
    if (mysqli_query($conn, $qry)) {
        // Almacenar un mensaje de éxito
        echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'Éxito',
                    text: 'Estado de pago actualizado correctamente para los miembros seleccionados.',
                }).then(function() {
                    window.location.href = 'detalles_miembros.php';
                });
              </script>";
    } else {
        echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Error al actualizar el estado de pago: " . mysqli_error($conn) . "',
                }).then(function() {
                    window.history.back();
                });
              </script>";
    }
} else {
    echo "<script>
            Swal.fire({
                icon: 'warning',
                title: 'Advertencia',
                text: 'Datos inválidos o no se seleccionaron miembros.',
            }).then(function() {
                window.history.back();
            });
          </script>";
}

// Cerrar la conexión
mysqli_close($conn);
?>

</body>
</html>

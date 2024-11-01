
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

// Verifica si el usuario está logueado
if (!isset($_SESSION['user_id'])) {
    header('location:../index.php');
    exit;
}

// Conexión a la base de datos
$conn = new mysqli('localhost', 'root', '', 'gymu');
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Manejo del envío del formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtiene los datos del formulario de ventas
    $cedula = $_POST['id_persona'];
    $id_producto = $_POST['id_producto'];
    $cantidad = $_POST['cantidad'];
    $total = $_POST['total'];
    $fecha = date('Y-m-d'); // Obtiene la fecha actuales (sin hora)

    // Validación de los datos
    if (empty($cedula) || empty($id_producto) || empty($cantidad)) {
        echo "<script>
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Por favor, complete todos los campos.'
        }).then(function() {
            window.history.back();
        });
        </script>";
    } elseif (!is_numeric($cantidad) || !is_numeric($total)) {
        echo "<script>
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'La cantidad debe ser un número válido.'
        }).then(function() {
            window.history.back();
        });
        </script>";
    } else {
        // Preparar y ejecutar la consulta para insertar los datos en la tabla ventas
        $stmt = $conn->prepare("INSERT INTO ventas (cedula, id_producto, cantidad, total, fecha) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("siids", $cedula, $id_producto, $cantidad, $total, $fecha);

        if ($stmt->execute()) {
            echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Registro Exitoso',
                text: 'La venta ha sido registrada con éxito.'
            }).then(function() {
                window.location.href = 'shops.php'; // Redirigir a la lista de ventas
            });
            </script>";
        } else {
            echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Error al registrar la venta.'
            }).then(function() {
                window.history.back();
            });
            </script>";
        }

        // Cerrar la declaración
        $stmt->close();
    }
}

// Cerrar la conexión
$conn->close();
?>


</body>
</html>

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
    // Obtiene los datos del formulario de productos
    $nombre_producto = $_POST['nombre_producto'];
    $costo_producto = $_POST['costo_producto'];

    // Validación de los datos
    if (empty($nombre_producto) || empty($costo_producto)) {
        echo "<script>
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Por favor, complete todos los campos.'
        }).then(function() {
            window.history.back();
        });
        </script>";
    } elseif (!is_numeric($costo_producto)) {
        echo "<script>
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'El costo del producto debe ser un número válido.'
        }).then(function() {
            window.history.back();
        });
        </script>";
    } else {
        // Verificar si el nombre del producto ya existe
        $stmt = $conn->prepare("SELECT nombre_producto FROM productos WHERE nombre_producto = ?");
        $stmt->bind_param("s", $nombre_producto);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            // Nombre del producto duplicado
            echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Producto Duplicado',
                text: 'El nombre del producto ingresado ya está registrado.'
            }).then(function() {
                window.history.back();
            });
            </script>";
        } else {
            // Preparar y ejecutar la consulta para insertar los datos en la tabla productos
            $stmt = $conn->prepare("INSERT INTO productos (nombre_producto, costo) VALUES (?, ?)");
            $stmt->bind_param("sd", $nombre_producto, $costo_producto);

            if ($stmt->execute()) {
                echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'Registro Exitoso',
                    text: 'El producto ha sido registrado con éxito.'
                }).then(function() {
                    window.location.href = 'products.php';
                });
                </script>";
            } else {
                echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Error al registrar el producto.'
                }).then(function() {
                    window.history.back();
                });
                </script>";
            }
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

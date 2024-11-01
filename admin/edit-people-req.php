<!DOCTYPE html>
<html lang="es">
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
    // Obtiene los datos del formulario de personas
    $cedula = $_POST['cedula'];
    $nombre_completo = $_POST['nombre_completo'];
    $telefono = $_POST['telefono'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $id = $_GET['id']; // ID de la persona a actualizar

    // Validación de los datos
    if (empty($cedula) || empty($nombre_completo) || empty($telefono) || empty($fecha_nacimiento)) {
        echo "<script>
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Por favor, complete todos los campos.'
        }).then(function() {
            window.history.back();
        });
        </script>";
    } elseif (!is_numeric($cedula) || !is_numeric($telefono)) {
        echo "<script>
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Cédula y teléfono deben ser números válidos.'
        }).then(function() {
            window.history.back();
        });
        </script>";
    } else {
        // Preparar y ejecutar la consulta para actualizar los datos en la tabla personas
        $stmt = $conn->prepare("UPDATE personas SET nombre = ?, celular = ?, fecha_nacimiento = ? WHERE cedula = ?");
        $stmt->bind_param("sssi", $nombre_completo, $telefono, $fecha_nacimiento, $id);

        if ($stmt->execute()) {
            echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Actualización Exitosa',
                text: 'La persona ha sido actualizada con éxito.'
            }).then(function() {
                window.location.href = 'persons.php';
            });
            </script>";
        } else {
            echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Error al actualizar la persona.'
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

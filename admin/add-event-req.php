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
    // Obtiene los datos del formulario
    $nombre_evento = $_POST['nombre_evento'];
    $cantidad_cupos = $_POST['cantidad_cupos'];
    $costo_evento = $_POST['costo_evento'];

    // Validación de los datos
    if (empty($nombre_evento) || empty($cantidad_cupos) || empty($costo_evento)) {
        echo "<script>
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Por favor, complete todos los campos.',
            window.history.back();
        });
        </script>";
    } elseif (!is_numeric($cantidad_cupos) || $cantidad_cupos < 0 || !is_numeric($costo_evento) || $costo_evento < 0) {
        echo "<script>
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'La cantidad de cupos y el costo deben ser números positivos.',
            window.history.back();
        });
        </script>";
    } else {
        // Preparar y ejecutar la consulta para insertar los datos en la tabla eventos
        $stmt = $conn->prepare("INSERT INTO eventos (nombre, cantidad_inscritos, costo) VALUES (?, ?, ?)");
        $stmt->bind_param("sii", $nombre_evento, $cantidad_cupos, $costo_evento);

        if ($stmt->execute()) {
            header('Location: events.php');
            exit();
        } else {
            // Mensaje de error
            echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Error al registrar el evento.',
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

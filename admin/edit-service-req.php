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
    $id_servicio = $_GET['id']; // ID del servicio que se va a actualizar
    $nombre_servicio = $_POST['nombre_servicio'];
    $costo = $_POST['costo'];

    // Validación de los datos
    if (empty($nombre_servicio) || empty($costo)) {
        echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Por favor, complete todos los campos.',
                }).then(() => {
                    window.history.back();
                });
              </script>";
    } elseif (!is_numeric($costo) || $costo < 0) {
        echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'El costo debe ser un número positivo.',
                }).then(() => {
                    window.history.back();
                });
              </script>";
    } else {
        // Preparar y ejecutar la consulta para actualizar los datos en la tabla tarifas
        $stmt = $conn->prepare("UPDATE tarifas SET nombre = ?, costo = ? WHERE id = ?");
        $stmt->bind_param("sdi", $nombre_servicio, $costo, $id_servicio); // "sdi" significa string, double, int

        if ($stmt->execute()) {
            echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'Éxito',
                    text: 'Tarifa actualizada correctamente.',
                }).then(() => {
                    window.location.href = 'services.php';
                });
            </script>";
            exit();
        } else {
            // Mensaje de error
            echo "<script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Error al actualizar la tarifa: " . $stmt->error . "',
                    }).then(() => {
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

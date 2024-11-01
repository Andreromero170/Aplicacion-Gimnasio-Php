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
    $nombre_grupo = $_POST['nombre_grupo'];
    $cantidad_cupos = $_POST['cantidad_cupos'];

    // Validación de los datos
    if (empty($nombre_grupo) || empty($cantidad_cupos)) {
       
              echo "<script>
              Swal.fire({
                  icon: 'error',
                  title: 'Error',
                  text: 'Por favor, complete todos los campos.',
                     window.history.back();
              });
          </script>";

    } elseif (!is_numeric($cantidad_cupos) || $cantidad_cupos < 0) {
              echo "<script>
              Swal.fire({
                  icon: 'error',
                  title: 'Error',
                  text: 'La cantidad de cupos debe ser un número positivo.',
                     window.history.back();
              });
          </script>";
    } else {
        // Preparar y ejecutar la consulta para insertar los datos en la tabla grupos
        $stmt = $conn->prepare("INSERT INTO grupos (nombre_grupo, cupos_disponibles) VALUES (?, ?)");
        $stmt->bind_param("si", $nombre_grupo, $cantidad_cupos);

        if ($stmt->execute()) {
            header('Location: groups.php');
            exit();
        } else {
            // Mensaje de error
           
                  echo "<script>
              Swal.fire({
                  icon: 'error',
                  title: 'Error',
                  text: 'Error al registrar el grupo',
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
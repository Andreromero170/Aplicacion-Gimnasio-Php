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

// Variables para manejar el formulario
$id_grupo = isset($_GET['id_grupo']) ? intval($_GET['id_grupo']) : null;
$nombre_grupo = '';
$cantidad_cupos = '';

// Si `id_grupo` está presente, obtener los datos actuales del grupo para mostrarlos en el formulario
if ($id_grupo) {
    $qry = "SELECT nombre_grupo, cupos_disponibles FROM grupos WHERE id_grupo = ?";
    $stmt = $conn->prepare($qry);
    $stmt->bind_param("i", $id_grupo);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $grupo = $result->fetch_assoc();
        $nombre_grupo = $grupo['nombre_grupo'];
        $cantidad_cupos = $grupo['cupos_disponibles'];
    } else {
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Grupo no encontrado.',
            });
        </script>";
        exit();
    }

    $stmt->close();
} else {
    // Si no hay un id_grupo en la URL, no permitir que se acceda al formulario
    echo "<script>
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'No se ha especificado un grupo válido para actualizar.',
        });
    </script>";
    exit();
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
            });
        </script>";
    } elseif (!is_numeric($cantidad_cupos) || $cantidad_cupos < 0) {
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'La cantidad de cupos debe ser un número positivo.',
            });
        </script>";
    } else {
        // Actualizar el grupo existente
        $stmt = $conn->prepare("UPDATE grupos SET nombre_grupo = ?, cupos_disponibles = ? WHERE id_grupo = ?");
        $stmt->bind_param("sii", $nombre_grupo, $cantidad_cupos, $id_grupo);

        if ($stmt->execute()) {
            echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'Éxito',
                    text: 'Grupo actualizado correctamente.',
                }).then(function() {
                    window.location.href = 'groups.php';
                });
            </script>";
        } else {
            echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Error al actualizar el grupo.',
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

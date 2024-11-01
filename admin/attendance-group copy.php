<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Asistencia</title>
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
    $id_usuario = $_POST['id_usuario'];
    $id_grupo = $_POST['id_grupo']; // Recibe el id_grupo del formulario
    $estado_asistencia = $_POST['estado_asistencia'];
    $fecha_actual = date('Y-m-d'); // Obtener la fecha actual

    // Validación de los datos
    if (empty($id_usuario) || empty($estado_asistencia) || empty($id_grupo)) {
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Por favor, complete todos los campos.',
            }).then(function() {
                window.history.back();
            });
        </script>";
    } else {
        // Verificar si ya existe un registro para el mismo usuario, fecha y grupo
        $check_stmt = $conn->prepare("SELECT * FROM asistencia WHERE id_usuario = ? AND fecha_actual = ? AND id_grupo = ?");
        $check_stmt->bind_param("isi", $id_usuario, $fecha_actual, $id_grupo);
        $check_stmt->execute();
        $result = $check_stmt->get_result();

        if ($result->num_rows > 0) {
            // Si ya existe un registro para esa fecha, usuario y grupo
            echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Ya se ha registrado la asistencia para este usuario en esta fecha y grupo.',
                }).then(function() {
                    window.history.back();
                });
            </script>";
        } else {
            // Si no existe un registro, se inserta la nueva asistencia
            $stmt = $conn->prepare("INSERT INTO asistencia (id_usuario, fecha_actual, estado_asistencia, id_grupo) 
                VALUES (?, ?, ?, ?)");
            $stmt->bind_param("issi", $id_usuario, $fecha_actual, $estado_asistencia, $id_grupo);

            if ($stmt->execute()) {
                // Verificar si el estado es "Faltó sin Aviso"
                if ($estado_asistencia === "Faltó sin Aviso") {
                    // Insertar en la tabla de inasistencias
                    $inasistencia_stmt = $conn->prepare("INSERT INTO inasistencias (id_usuario, fecha, id_asistencia) 
                        VALUES (?, ?, LAST_INSERT_ID())");
                    $inasistencia_stmt->bind_param("is", $id_usuario, $fecha_actual);
                    
                    if ($inasistencia_stmt->execute()) {
                        echo "<script>
                            Swal.fire({
                                icon: 'success',
                                title: 'Inasistencia registrada',
                                text: 'La inasistencia se ha registrado correctamente.',
                            });
                        </script>";
                    } else {
                        echo "<script>
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Error al registrar la inasistencia.',
                            });
                        </script>";
                    }
                    // Cerrar la declaración de inasistencia
                    $inasistencia_stmt->close();
                }

                echo "<script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Asistencia registrada',
                        text: 'La asistencia se ha registrado correctamente.',
                    }).then(function() {
                        window.location.href = 'groups.php'; // Redirigir a grupos.php después del éxito
                    });
                </script>";
            } else {
                echo "<script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Error al registrar la asistencia.',
                    }).then(function() {
                        window.location.href = 'groups.php'; // Redirigir a grupos.php después del error
                    });
                </script>";
            }

            // Cerrar la declaración de asistencia
            $stmt->close();
        }

        // Cerrar la declaración de verificación
        $check_stmt->close();
    }
}

// Cerrar la conexión
$conn->close();
?>

</body>
</html>

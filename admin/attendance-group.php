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
$conn = mysqli_connect('localhost', 'root', '', 'gymu');
if (!$conn) {
    die("Error de conexión: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Muestra los datos recibidos para depuración


    $id_grupo = $_POST['id_grupo'];
    $estado_asistencia = $_POST['estado_asistencia'];
    $fecha_actual = date('Y-m-d');

    // Verifica que se seleccionaron usuarios
    if (!empty($_POST['id_usuarios'])) {
        $id_usuarios = $_POST['id_usuarios'];
        $duplicate_found = false; // Flag to track if any duplicate was found

        foreach ($id_usuarios as $id_usuario) {
            // Verifica si ya existe un registro de asistencia para el usuario en la fecha y grupo
            $check_query = "SELECT * FROM asistencia WHERE id_usuario = ? AND fecha_actual = ? AND id_grupo = ?";
            $stmt_check = $conn->prepare($check_query);
            $stmt_check->bind_param("isi", $id_usuario, $fecha_actual, $id_grupo);
            $stmt_check->execute();
            $result_check = $stmt_check->get_result();

            if ($result_check->num_rows == 0) {
                // Inserta el registro de asistencia
                $insert_query = "INSERT INTO asistencia (id_usuario, fecha_actual, estado_asistencia, id_grupo) 
                                VALUES (?, ?, ?, ?)";
                $stmt_insert = $conn->prepare($insert_query);
                $stmt_insert->bind_param("issi", $id_usuario, $fecha_actual, $estado_asistencia, $id_grupo);
                
                if ($stmt_insert->execute()) {
                    // Si el estado es "Faltó sin Aviso", inserta también en la tabla de inasistencias
                    if ($estado_asistencia === "Faltó sin Aviso") {
                        $insert_inasistencia = "INSERT INTO inasistencias (id_usuario, fecha, id_asistencia) 
                                                VALUES (?, ?, LAST_INSERT_ID())";
                        $stmt_inasistencia = $conn->prepare($insert_inasistencia);
                        $stmt_inasistencia->bind_param("is", $id_usuario, $fecha_actual);
                        $stmt_inasistencia->execute();
                    }
                } else {
                    echo "<script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'No se pudo registrar la asistencia para el usuario ID $id_usuario.',
                        });
                    </script>";
                }
            } else {
                // Si ya existe un registro, establece el flag
                $duplicate_found = true;
                echo "<script>
                    Swal.fire({
                        icon: 'warning',
                        title: 'Advertencia',
                        text: 'La asistencia ya ha sido registrada para el usuario ID $id_usuario en esta fecha.',
                    });
                </script>";
            }
        }

        // Mostrar el mensaje de éxito solo si no se encontraron duplicados
        if (!$duplicate_found) {
            echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'Asistencia registrada',
                    text: 'La asistencia se ha registrado correctamente.',
                }).then(function() {
                    window.location.href = 'detalles_grupo.php?id_grupo=".$id_grupo."';
                });
            </script>";
        } else {
            // Si se encontraron duplicados, redirigir de vuelta sin un mensaje de éxito
            echo "<script>
                setTimeout(function() {
                    window.location.href = 'detalles_grupo.php?id_grupo=".$id_grupo."';
                }, 2000); // Redirige después de 2 segundos
            </script>";
        }
    } else {
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'No has seleccionado ningún miembro.',
            }).then(function() {
                window.history.back();
            });
        </script>";
    }
}
?>
</body>
</html>

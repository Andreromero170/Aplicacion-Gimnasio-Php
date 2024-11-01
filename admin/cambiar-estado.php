<?php
// Inicia la sesión
session_start();

// Verifica si el usuario ha iniciado sesión
if (!isset($_SESSION['user_id'])) {
    header('location:../index.php');
    exit;
}

// Verifica si el ID de la inscripción ha sido enviado
if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Asegúrate de que el id es un número entero

    // Conectar a la base de datos
    $conn = mysqli_connect('localhost', 'root', '', 'gymu');
    if (!$conn) {
        die("Error de conexión: " . mysqli_connect_error());
    }

    // Obtener los detalles de la inscripción
    $qry = "SELECT cuota_actual, numero_cuotas, estado_pago FROM inscripcion_eventos WHERE id = $id";
    $result = mysqli_query($conn, $qry);

    // Si la inscripción existe
    if ($row = mysqli_fetch_assoc($result)) {
        $cuota_actual = $row['cuota_actual'];
        $numero_cuotas = $row['numero_cuotas'];

        // Verifica si todas las cuotas ya han sido pagadas
        if ($row['estado_pago'] === 'pagado') {
            $_SESSION['error'] = "La inscripción ya ha sido pagada.";
        } else {
            // Manejo de cuotas
            if ($numero_cuotas == 1) {
                // Si hay una única cuota, se puede marcar como pagada
                $nuevo_estado = 'pagado';
                $cuota_actual = 1; // Asegúrate de que la cuota actual se mantenga en 1
            } else {
                // Si hay más de una cuota
                if ($cuota_actual < $numero_cuotas) {
                    $cuota_actual++;

                    // Si las cuotas alcanzan el total, cambia el estado a 'pagado'
                    if ($cuota_actual == $numero_cuotas) {
                        $nuevo_estado = 'pagado';
                    } else {
                        // Mantén el estado como 'pendiente'
                        $nuevo_estado = 'pendiente';
                    }
                } else {
                    $_SESSION['error'] = "Todas las cuotas ya han sido pagadas.";
                }
            }

            // Actualiza la inscripción en la base de datos
            if (isset($nuevo_estado)) {
                $update_qry = "UPDATE inscripcion_eventos SET estado_pago = '$nuevo_estado', cuota_actual = $cuota_actual WHERE id = $id";
                if (mysqli_query($conn, $update_qry)) {
                    $_SESSION['message'] = "El estado ha sido actualizado exitosamente.";
                } else {
                    $_SESSION['error'] = "Error al actualizar el estado: " . mysqli_error($conn);
                }
            }
        }
    } else {
        $_SESSION['error'] = "La inscripción no existe.";
    }

    // Cierra la conexión
    mysqli_close($conn);

    // Redirige a la página anterior (donde se muestra la tabla)
    header("Location: inscripciones-list.php");
    exit;
} else {
    $_SESSION['error'] = "ID de inscripción no proporcionado.";
    header("Location: inscripciones-list.php");
    exit;
}

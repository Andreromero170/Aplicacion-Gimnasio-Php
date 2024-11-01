<?php
// Iniciar sesión
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirigir si no está autorizado
    $_SESSION['message'] = 'Unauthorized';
    header('Location: inscripciones-list.php');
    exit;
}

// Check if the ID is provided
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Connect to the database
    $conn = mysqli_connect('localhost', 'root', '', 'gymu');
    if (!$conn) {
        // Redirigir en caso de error de conexión
        $_SESSION['message'] = 'Database connection error';
        header('Location: inscripciones-list.php');
        exit;
    }

    // Fetch the current visibility state
    $qry = "SELECT visible FROM eventos WHERE id = $id";
    $result = mysqli_query($conn, $qry);
    
    if ($row = mysqli_fetch_assoc($result)) {
        // Toggle the visibility
        $new_visible = $row['visible'] ? 0 : 1; // Flip the value (1 -> 0, 0 -> 1)

        // Update the visibility in the database
        $update_qry = "UPDATE eventos SET visible = $new_visible WHERE id = $id";
        if (mysqli_query($conn, $update_qry)) {
            // Redirigir con un mensaje de éxito
            $_SESSION['message'] = 'Visibility updated successfully.';
            header('Location: inscripciones-list.php');
            exit;
        } else {
            // Redirigir en caso de error al actualizar
            $_SESSION['message'] = 'Error updating visibility';
            header('Location: inscripciones-list.php');
            exit;
        }
    } else {
        // Redirigir si no se encuentra el evento
        $_SESSION['message'] = 'Event not found';
        header('Location: inscripciones-list.php');
        exit;
    }

    // Close the connection
    mysqli_close($conn);
} else {
    // Redirigir si no se proporciona el ID del evento
    $_SESSION['message'] = 'No event ID provided';
    header('Location: inscripciones-list.php');
    exit;
}
?>

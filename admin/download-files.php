<?php

session_start();
// Verifica si el usuario ha iniciado sesión
if (!isset($_SESSION['user_id'])) {
    header('location:../index.php');    
}

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);  // Convertir el ID a un entero para evitar inyecciones SQL

    include 'dbcon.php';

    // Consulta para obtener la ruta del documento basado en el id_documento
    $qry = "SELECT ruta_documento FROM miembro_documento WHERE id_documento = $id";
    $result = mysqli_query($con, $qry);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $ruta_documento = $row['ruta_documento'];

        // Verifica si el archivo existe
        if (file_exists($ruta_documento)) {
            // Forzar la descarga del archivo
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename=' . basename($ruta_documento));
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($ruta_documento));

            // Lee el archivo y lo envía al buffer de salida
            readfile($ruta_documento);
            exit(); // Asegúrate de salir después de la descarga
        } else {
            echo "El archivo no existe.";
        }
    } else {
        echo "Documento no encontrado.";
    }
}
?>

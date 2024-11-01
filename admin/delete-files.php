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
        
        // Verifica si el archivo existe en el servidor
        if (file_exists($ruta_documento)) {
            // Intenta eliminar el archivo
            if (unlink($ruta_documento)) {
                // Después de eliminar el archivo, elimina el registro en la base de datos
                $deleteQry = "DELETE FROM miembro_documento WHERE id_documento = $id";
                $deleteResult = mysqli_query($con, $deleteQry);

                if ($deleteResult) {
                    // Redirige a la página de archivos después de la eliminación exitosa
                    header('Location: files.php');
                    exit();
                } else {
                    // Error al eliminar el registro en la base de datos
                    echo "<script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Error al eliminar el registro de la base de datos.',
                        });
                    </script>";
                }
            } else {
                // Error al eliminar el archivo
                echo "<script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Error al eliminar el archivo.',
                    });
                </script>";
            }
        } else {
            // Archivo no encontrado
            echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'El archivo no existe.',
                });
            </script>";
        }
    } else {
        // Documento no encontrado
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Documento no encontrado.',
            });
        </script>";
    }
}
?>


</body>
</html>
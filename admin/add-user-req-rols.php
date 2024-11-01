<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Roles</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>

<?php
session_start();


if (!isset($_SESSION['user_id'])) {
    header('location:../index.php');
    exit();
}

$conn = mysqli_connect('localhost', 'root', '', 'gymu');
if (!$conn) {
    die("Error de conexión: " . mysqli_connect_error());
}

$id_usuario = isset($_POST['id_usuario']) ? intval($_POST['id_usuario']) : 0;
$page_access = isset($_POST['page_access']) ? $_POST['page_access'] : [];
$estado = isset($_POST['estado']) ? $_POST['estado'] : null;

// Validar que el estado sea 'Bloqueado' o 'Permitido'
if ($estado !== 'Bloqueado' && $estado !== 'Permitido') {
    echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Estado inválido. Debe ser Bloqueado o Permitido. $estado',
            }).then(function() {
                window.history.back();
            });
          </script>";
    exit();
}

if ($id_usuario > 0 && !empty($page_access)) {
    // Escapamos cada enlace pasando también la conexión como parámetro
    $enlaces = implode("','", array_map(function($link) use ($conn) {
        return mysqli_real_escape_string($conn, trim($link));
    }, $page_access));
    
    // Actualizar el estado de acceso
    $qry = "UPDATE permisos_usuarios SET estado_acceso = '$estado' 
            WHERE id_usuario = $id_usuario AND enlace_pagina IN ('$enlaces')";
    
    if (mysqli_query($conn, $qry)) {
        echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'Éxito',
                    text: 'Estado de acceso actualizado correctamente para las páginas seleccionadas.',
                }).then(function() {
                    window.location.href = 'user-rols.php';
                });
              </script>";
    } else {
        echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Error al actualizar el estado de acceso: " . mysqli_error($conn) . "',
                }).then(function() {
                    window.history.back();
                });
              </script>";
    }
} else {
    echo "<script>
            Swal.fire({
                icon: 'warning',
                title: 'Advertencia',
                text: 'Datos inválidos o no se seleccionaron páginas.',
            }).then(function() {
                window.history.back();
            });
          </script>";
}

mysqli_close($conn);
?>

</body>
</html>

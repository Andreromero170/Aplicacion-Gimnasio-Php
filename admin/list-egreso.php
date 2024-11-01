<?php

session_start();
include 'verificar_acceso.php';

// Verifica si el usuario está autenticado
if(!isset($_SESSION['user_id'])){
    header('location:../index.php');
    exit;
}

$user_id = $_SESSION['user_id'];
$pagina = basename($_SERVER['PHP_SELF']);  // Obtiene el nombre de la página actual
verificar_acceso($pagina, $user_id);       // Verifica el acceso del usuario a esta página



?>
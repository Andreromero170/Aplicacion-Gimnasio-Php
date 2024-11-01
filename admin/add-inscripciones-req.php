<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['user_id'])) {
    header('Location: ../index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Sistema de Gimnasio</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../css/bootstrap.min.css" />
    <link rel="stylesheet" href="../css/bootstrap-responsive.min.css" />
    <link rel="stylesheet" href="../css/fullcalendar.css" />
    <link rel="stylesheet" href="../css/matrix-style.css" />
    <link rel="stylesheet" href="../css/matrix-media.css" />
    <link href="../font-awesome/css/fontawesome.css" rel="stylesheet" />
    <link href="../font-awesome/css/all.css" rel="stylesheet" />
    <link rel="stylesheet" href="../css/jquery.gritter.css" />
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>

<!--Header-part-->
<div id="header">
    <h1><a href="dashboard.html">Perfect Gym Admin</a></h1>
</div>
<!--close-Header-part--> 

<!--top-Header-menu-->
<?php include 'includes/topheader.php'?>
<!--close-top-Header-menu-->

<!--sidebar-menu-->
<?php $page='members-entry'; include 'includes/sidebar.php'?>
<!--sidebar-menu-->

<div id="content">
    <div id="content-header">
        <div id="breadcrumb">
            <a href="index.html" title="Go to Home" class="tip-bottom"><i class="fas fa-home"></i> Home</a>
            <a href="#" class="tip-bottom">Administracion de Inscripciones</a>
            <a href="#" class="current">Añadir Inscripción</a>
        </div>
        <h1>Formulario de Inscripción</h1>
    </div>

    <form role="form" action="" method="POST">
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Recoger y validar los datos del formulario
            $id_persona = isset($_POST['id_persona']) ? $_POST['id_persona'] : '';
            $fecha_viaje = isset($_POST['fecha_viaje']) ? $_POST['fecha_viaje'] : '';
            $id_tipo = isset($_POST['id_tipo']) ? intval($_POST['id_tipo']) : 0;
            $evento_pago = isset($_POST['evento-pagos']) ? intval($_POST['evento-pagos']) : 0;
            $pago = isset($_POST['pago']) ? $_POST['pago'] : '0.00';
            $cuotas = isset($_POST['cuotas']) ? intval($_POST['cuotas']) : 0;

            // Verificar que sea numérico y luego formatear a decimal(10,2)
            if (is_numeric($pago)) {
                $pago = number_format((float)$pago, 2, '.', ''); // Formato decimal(10,2)
            } else {
                $pago = '0.00'; // Valor por defecto si no es numérico
            }

            // Validación de los campos
            $campos_faltantes = array();
            if (empty($id_persona)) $campos_faltantes[] = 'ID de Persona';
            if (empty($fecha_viaje)) $campos_faltantes[] = 'Fecha de Viaje';
            if (empty($id_tipo)) $campos_faltantes[] = 'ID de Tipo';
            if (empty($evento_pago)) $campos_faltantes[] = 'Evento de Pago';

            // Imprimir resultados
            if (!empty($campos_faltantes)) {
                echo "<script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Faltan los siguientes campos o están vacíos: " . implode(", ", $campos_faltantes) . "',
                        confirmButtonText: 'Volver'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = 'inscripciones.php';
                        }
                    });
                </script>";
            } else {
                // Conexión a la base de datos
                $conn = new mysqli('localhost', 'root', '', 'gymu');
                if ($conn->connect_error) {
                    die("Error de conexión: " . $conn->connect_error);
                }

                // Verificar si ya existe una inscripción con la misma cédula y fecha de viaje
                $stmt = $conn->prepare("SELECT COUNT(*) FROM inscripcion_eventos WHERE cedula = ? AND fecha_viaje = ?");
                $stmt->bind_param("ss", $id_persona, $fecha_viaje);
                $stmt->execute();
                $stmt->bind_result($count);
                $stmt->fetch();
                $stmt->close();

                if ($count > 0) {
                    echo "<script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Ya existe una inscripción registrada para esta cédula en la fecha seleccionada.',
                            confirmButtonText: 'Volver'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = 'inscripciones.php';
                            }
                        });
                    </script>";
                } else {
                    // Determinar el estado de pago y la cuota actual
                    $estado_pago = ($cuotas > 0) ? 'pendiente' : 'pagado';
                    $cuota_actual = ($cuotas > 0) ? 1 : 0;

                    // Preparar la consulta
                    $stmt = $conn->prepare("INSERT INTO inscripcion_eventos (cedula, id_evento, tipo_pago_id, fecha_viaje, monto_pagado, numero_cuotas, cuota_actual, estado_pago) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
                    $stmt->bind_param("siisdiis", $id_persona, $evento_pago, $id_tipo, $fecha_viaje, $pago, $cuotas, $cuota_actual, $estado_pago);

                    // Ejecutar la declaración
                    if ($stmt->execute()) {
                        echo "<script>
                            Swal.fire({
                                icon: 'success',
                                title: 'Éxito',
                                text: 'Inscripción registrada con éxito.',
                                confirmButtonText: 'Ir al Listado'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = 'inscripciones-list.php';
                                }
                            });
                        </script>";
                    } else {
                        echo "<script>
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Error al registrar la inscripción. Por favor, intenta de nuevo.',
                                confirmButtonText: 'Volver'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = 'inscripciones.php';
                                }
                            });
                        </script>";
                    }

                    $stmt->close();
                }

                $conn->close();
            }
        }
        ?>
        
        </div>
        
<!--end-main-container-part-->

<!--Footer-part-->
<div class="row-fluid">
    <div id="footer" class="span12"> <?php echo date("Y");?> &copy; Desarrollado por Union Digital</a> </div>
</div>

<style>
#footer {
    color: white;
}
</style>

<!--end-Footer-part-->

<script src="../js/excanvas.min.js"></script> 
<script src="../js/jquery.min.js"></script> 
<script src="../js/jquery.ui.custom.js"></script> 
<script src="../js/bootstrap.min.js"></script> 
<script src="../js/jquery.flot.min.js"></script> 
<script src="../js/jquery.flot.resize.min.js"></script> 
<script src="../js/jquery.peity.min.js"></script> 
<script src="../js/fullcalendar.min.js"></script> 
<script src="../js/matrix.js"></script> 
<script src="../js/matrix.dashboard.js"></script> 
<script src="../js/jquery.gritter.min.js"></script> 
<script src="../js/matrix.interface.js"></script> 
<script src="../js/matrix.chat.js"></script> 
<script src="../js/jquery.validate.js"></script> 
<script src="../js/matrix.popover.js"></script>
</body>
</html>

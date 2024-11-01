<?php
session_start();
// Verifica si el usuario ha iniciado sesión
if (!isset($_SESSION['user_id'])) {
    header('location:../index.php');
    exit();
}

// Conectar a la base de datos
include 'dbcon.php';

// Inicializa las variables de evento y persona
$evento = null;
$persona = null;

// Verifica si hay un ID en la URL para editar el evento o la persona
if (isset($_GET['id'])) {
    $id_evento = intval($_GET['id']);  // Convertir el ID a entero para mayor seguridad

    // Consulta para obtener los datos del evento
    $qry = "SELECT * FROM eventos WHERE id = $id_evento";
    $result = mysqli_query($con, $qry);

    if ($result && mysqli_num_rows($result) > 0) {
        // Los datos del evento existen, los guardamos en una variable
        $evento = mysqli_fetch_assoc($result);
    } else {
        // Si no existe el evento, redirigir a la página de eventos o mostrar un mensaje de error
        echo "<script>
            alert('Evento no encontrado');
            window.location.href = './events.php';
        </script>";
        exit();
    }
} elseif (isset($_GET['id_persona'])) {
    $id_persona = intval($_GET['id_persona']);  // Convertir el ID a entero para mayor seguridad

    // Consulta para obtener los datos de la persona
    $qry_persona = "SELECT * FROM personas WHERE cedula = $id_persona";
    $result_persona = mysqli_query($con, $qry_persona);

    if ($result_persona && mysqli_num_rows($result_persona) > 0) {
        // Los datos de la persona existen, los guardamos en una variable
        $persona = mysqli_fetch_assoc($result_persona);
    } else {
        // Si no existe la persona, redirigir a la página de personas o mostrar un mensaje de error
        echo "<script>
            alert('Persona no encontrada');
            window.location.href = './persons.php';
        </script>";
        exit();
    }
} else {
    // Si no hay ID, redirigir a la lista de eventos o personas
    header('Location: ./event.php'); // o ../persons.php dependiendo de la lógica que desees
    exit();
}
?>

<!-- Visit codeastro.com for more projects -->
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
</head>
<body>

<!--Header-part-->
<div id="header">
    <h1><a href="dashboard.html">Perfect Gym Admin</a></h1>
</div>
<!--close-Header-part--> 

<!--top-Header-menu-->
<?php include 'includes/topheader.php'?>
<?php $page='members-entry'; include 'includes/sidebar.php'?>

<!--sidebar-menu-->
<div id="content">
    <div id="content-header">
        <div id="breadcrumb"> <a href="#" class="tip-bottom"><i class="fas fa-home"></i>Inicio</a> <a href="#" class="tip-bottom">Administracion de Eventos</a> </div>
        <h1>Entrada de Formulario</h1>
    </div>
    <div class="container-fluid">
        <hr>
        <div class="row-fluid">
            <div class="span6">
                <div class="widget-box">
                    <div class="widget-title"> 
                        <span class="icon"> <i class="fas fa-align-justify"></i> </span>
                        <h5>Info-Evento</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <form action="edit-event-req.php?id=<?php echo isset($evento) ? $evento['id'] : ''; ?>" method="POST" class="form-horizontal">
                            <div class="control-group">
                                <label class="control-label">Nombre del Evento :</label>
                                <div class="controls">
                                    <input type="text" class="span11" name="nombre_evento" value="<?php echo isset($evento) ? $evento['nombre'] : ''; ?>" placeholder="Nombre del Evento" />
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Cantidad de Cupos :</label>
                                <div class="controls">
                                    <input type="number" class="span11" name="cantidad_cupos" value="<?php echo isset($evento) ? $evento['cantidad_inscritos'] : ''; ?>" placeholder="Cantidad de Cupos" />
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Costo del Evento :</label>
                                <div class="controls">
                                    <input type="text" class="span11" name="costo_evento" value="<?php echo isset($evento) ? $evento['costo'] : ''; ?>" placeholder="Costo del Evento" />
                                </div>
                            </div>

                            <div class="form-actions text-center">
                                <button type="submit" class="btn btn-success">Actualizar Evento</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="span6">
                <div class="widget-box">
                    <div class="widget-title"> 
                        <span class="icon"> <i class="fas fa-align-justify"></i> </span>
                        <h5>Info-Personas</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <form action="edit-people-req.php?id=<?php echo isset($persona) ? $persona['cedula'] : ''; ?>" method="POST" class="form-horizontal">
                            <div class="control-group">
                                <label class="control-label">Cedula :</label>
                                <div class="controls">
                                    <input type="text" class="span11" name="cedula" value="<?php echo isset($persona) ? $persona['cedula'] : ''; ?>" placeholder="Cedula" />
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Nombre :</label>
                                <div class="controls">
                                    <input type="text" class="span11" name="nombre_completo" value="<?php echo isset($persona) ? $persona['nombre'] : ''; ?>" placeholder="Nombre Completo" />
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Telefono :</label>
                                <div class="controls">
                                    <input type="text" class="span11" name="telefono" value="<?php echo isset($persona) ? $persona['celular'] : ''; ?>" placeholder="Telefono" />
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Fecha de Nacimiento:</label>
                                <div class="controls">
                                    <input type="date" name="fecha_nacimiento" class="span11" value="<?php echo isset($persona) ? $persona['fecha_nacimiento'] : ''; ?>" required />
                                    <span class="help-block">Fecha de Nacimiento</span>
                                </div>
                            </div>
                            <div class="form-actions text-center">
                                <button type="submit" class="btn btn-success">Actualizar Persona</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<!--end-main-container-part-->

<!--Footer-part-->
<div class="row-fluid">
    <div id="footer" class="span12"> <?php echo date("Y");?> &copy; Desarrollado por Union Digital</div>
</div>

<style>
#footer {
    color: white;
}
</style>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
<script src="../js/matrix.form_validation.js"></script> 
<script src="../js/jquery.wizard.js"></script> 
<script src="../js/matrix.popover.js"></script> 
<script src="../js/matrix.tables.js"></script> 
</body>
</html>

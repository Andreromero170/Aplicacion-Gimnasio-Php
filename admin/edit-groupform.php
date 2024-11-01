<?php
session_start();
// Verifica si el usuario ha iniciado sesión
if(!isset($_SESSION['user_id'])){
    header('location:../index.php');
    exit();
}

include 'dbcon.php';

// Inicializa las variables con valores vacíos para los formularios
$nombre_grupo = '';
$cantidad_cupos = '';
$nombre_servicio = '';
$costo = '';

// Verifica si uno de los parámetros está presente
$id_grupo = isset($_GET['id_grupo']) ? intval($_GET['id_grupo']) : null;
$id_servicio = isset($_GET['id_servicio']) ? intval($_GET['id_servicio']) : null;

if ($id_grupo) {
    // Consulta para el grupo
    $qry_grupo = "SELECT nombre_grupo, cupos_disponibles FROM grupos WHERE id_grupo = $id_grupo";
    $result_grupo = mysqli_query($con, $qry_grupo);

    if ($result_grupo && mysqli_num_rows($result_grupo) > 0) {
        $grupo = mysqli_fetch_assoc($result_grupo);
        // Datos del grupo
        $nombre_grupo = $grupo['nombre_grupo'];
        $cantidad_cupos = $grupo['cupos_disponibles'];
    } else {
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Grupo no encontrado.',
            });
        </script>";
    }
} elseif ($id_servicio) {
    // Consulta para el servicio
    $qry_servicio = "SELECT nombre, costo FROM tarifas WHERE id = $id_servicio";
    $result_servicio = mysqli_query($con, $qry_servicio);

    if ($result_servicio && mysqli_num_rows($result_servicio) > 0) {
        $servicio = mysqli_fetch_assoc($result_servicio);
        // Datos del servicio
        $nombre_servicio = $servicio['nombre'];
        $costo = $servicio['costo'];
    } else {
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Servicio no encontrado.',
            });
        </script>";
    }
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>

<!--Header-part-->
<div id="header">
    <h1><a href="dashboard.html">Perfect Gym Admin</a></h1>
</div>
<!--top-Header-menu-->
<?php include 'includes/topheader.php'?>
<?php $page='members-entry'; include 'includes/sidebar.php'?>

<!--Formulario para Grupos-->
<div id="content">
    <div id="content-header">
        <div id="breadcrumb"> <a href="#" class="tip-bottom"><i class="fas fa-home"></i>Inicio</a> <a href="#" class="tip-bottom">Administración de Grupos y Servicios</a></div>
        <h1>Entrada de Formulario</h1>
    </div>
    <div class="container-fluid">
        <hr>
        <div class="row-fluid">
            <div class="span6">
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"> <i class="fas fa-align-justify"></i> </span>
                        <h5>Información del Grupo</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <form action="edit-group-req.php?id_grupo=<?php echo $id_grupo?> " method="POST" class="form-horizontal">
                            <div class="control-group">
                                <label class="control-label">Nombre del Grupo :</label>
                                <div class="controls">
                                    <input type="text" class="span11" name="nombre_grupo" placeholder="Nombre del Grupo" value="<?php echo $nombre_grupo; ?>" />
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Cantidad de Cupos :</label>
                                <div class="controls">
                                    <input type="number" class="span11" name="cantidad_cupos" placeholder="Cantidad de Cupos" value="<?php echo $cantidad_cupos; ?>" />
                                </div>
                            </div>
                            <div class="form-actions text-center">
                                <button type="submit" class="btn btn-success">Actualizar Grupo</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!--Formulario para Servicios-->
            <div class="span6">
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"> <i class="fas fa-align-justify"></i> </span>
                        <h5>Información del Servicio</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <form action="edit-service-req.php?id=<?php echo $id_servicio?>" method="POST" class="form-horizontal">
                            <div class="control-group">
                                <label class="control-label">Nombre del Servicio :</label>
                                <div class="controls">
                                    <input type="text" class="span11" name="nombre_servicio" placeholder="Nombre del Servicio" value="<?php echo $nombre_servicio; ?>" />
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Costo</label>
                                <div class="controls">
                                    <div class="input-append">
                                        <span class="add-on">$</span> 
                                        <input type="text" placeholder="" name="costo" class="span11" value="<?php echo $costo; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions text-center">
                                <button type="submit" class="btn btn-success">Actualizar Servicio</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--Footer-part-->
<div class="row-fluid">
    <div id="footer" class="span12"> <?php echo date("Y");?> &copy; Desarrollado por Union Digital</div>
</div>

</body>
</html>

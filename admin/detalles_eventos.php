<?php
session_start();
// Check if the user is already logged in
if (!isset($_SESSION['user_id'])) {
    header('location:../index.php');    
}

// Verifica si id_evento está definido en la URL
if (isset($_GET['id_evento'])) {
    $id_evento = intval($_GET['id_evento']); // Convierte a entero para mayor seguridad
} else {
    die("Error: id_evento no está definido.");
}

// Conectar a la base de datos
$conn = mysqli_connect('localhost', 'root', '', 'gymu');
if (!$conn) {
    die("Error de conexión: " . mysqli_connect_error());
}

// Inicializar la variable de búsqueda
$search = '';

// Verificar si el formulario de búsqueda ha sido enviado
if (isset($_POST['search'])) {
    $search = mysqli_real_escape_string($conn, $_POST['search']); // Sanitizar la entrada de búsqueda
}

// Modificar la consulta para incluir la búsqueda por nombre del evento si se proporciona
$qry = "SELECT ie.id, p.nombre, p.cedula, ie.cuota_actual, ie.numero_cuotas, ie.estado_pago 
        FROM inscripcion_eventos ie 
        JOIN eventos e ON ie.id_evento = e.id
        JOIN personas p ON ie.cedula = p.cedula  
        WHERE ie.id_evento = $id_evento";

// Agregar el filtro de búsqueda si se proporciona un término de búsqueda
if (!empty($search)) {
    $qry .= " AND p.nombre LIKE '%$search%'"; // Buscar por nombre de la persona inscrita
}

$result = mysqli_query($conn, $qry);

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
</head>
<body>

<!--Header-part-->
<div id="header">
    <h1><a href="dashboard.html">Perfect Gym Admin</a></h1>
</div>
<!--close-Header-part--> 

<!--top-Header-menu-->
<?php include 'includes/topheader.php' ?>
<!--close-top-Header-menu-->

<!--sidebar-menu-->
<?php $page='members-update'; include 'includes/sidebar.php' ?>
<!--sidebar-menu-->

<div id="content">
    <div id="content-header">
        <div id="breadcrumb">
            <a href="#" title="Go to Home" class="tip-bottom"><i class="fas fa-home"></i>Inicio</a>
            <a href="#" class="current">Inscripciones de Eventos</a>
        </div>
        <h1 class="text-center">Lista de Inscripciones - Evento: <strong><?php echo $id_evento; ?></strong></h1>
    </div>
    <div class="container-fluid">
        <hr>
        <div class="row-fluid">
            <div class="span12">
                <div class='widget-box'>
                    <div class='widget-title'> 
                        <span class='icon'> <i class='fas fa-th'></i> </span>
                        <h5>Tabla de Inscripciones por Evento</h5>
                        <form id="custom-search-form" role="search" method="POST" class="form-search form-horizontal pull-right">
                            <div class="input-append span12">
                                <input type="text" class="search-query" placeholder="Buscar" name="search" value="<?php echo htmlspecialchars($search); ?>" required>
                                <button type="submit" class="btn"><i class="fas fa-search"></i></button>
                            </div>
                        </form>
                    </div>
                    
                    <?php
                    // Verifica si la consulta fue exitosa antes de mostrar la tabla
                    if ($result) {
                        echo "<table class='table table-bordered table-hover'>
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nombre Completo</th>
                                        <th>Cuota Actual</th>
                                        <th>Número de Cuotas</th>
                                        <th>Estado de Pago</th>
                                        <th>Acción</th>
                                    </tr>
                                </thead>";

                        $cnt = 1;
                        while ($row = mysqli_fetch_array($result)) {
                            echo "<tbody> 
                                    <tr>
                                        <td><div class='text-center'>".$cnt."</div></td>
                                        <td><div class='text-center'>".$row['nombre']."</div></td>
                                        <td><div class='text-center'>".$row['cuota_actual']."</div></td>
                                        <td><div class='text-center'>".$row['numero_cuotas']."</div></td>
                                        <td><div class='text-center'>".$row['estado_pago']."</div></td>
                                        <td> 
                                            <div class='text-center'><a href='cambiar-estado.php?id=".$row['id']."' style='color:orange;'><i class='fas fa-cog'></i> Cambiar Estado</a></div>
                                            <div class='text-center'><a href='inscripcion-persons.php?id=".$row['cedula']."' style='color:#F66;'><i class='fas fa-trash'></i> Eliminar</a></div>
                                        </td>
                                    </tr>
                                  </tbody>";
                            $cnt++;  
                        }
                        echo "</table>";
                    } else {
                        echo "<div class='alert alert-danger'>Error en la consulta: " . mysqli_error($conn) . "</div>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Footer-part -->
<div class="row-fluid">
    <div id="footer" class="span12"> <?php echo date("Y"); ?> &copy; Desarrollado por Union Digital</div>
</div>

<style>
#footer {
    color: white;
}
</style>

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
<script src="../js/jquery.uniform.js"></script> 
<script src="../js/select2.min.js"></script> 
<script src="../js/matrix.popover.js"></script> 
<script src="../js/jquery.dataTables.min.js"></script> 
<script src="../js/matrix.tables.js"></script> 

<script type="text/javascript">
function goPage(newURL) {
    if (newURL != "") {
        if (newURL == "-") {
            resetMenu();            
        } else {  
            document.location.href = newURL;
        }
    }
}

function resetMenu() {
   document.gomenu.selector.selectedIndex = 2;
}
</script>
</body>
</html>

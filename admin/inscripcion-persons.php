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


$cedula = isset($_GET["id"]) ? $_GET["id"] : null; // Obtener la cédula de la URL

// Inicializa la variable de búsqueda
$search = isset($_POST['search']) ? $_POST['search'] : '';
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
    <style>
        .container-fluid {
            padding: 15px; /* Ajusta según sea necesario */
        }
        .table {
            width: 100%; /* Asegúrate de que la tabla ocupe el ancho completo */
            margin-bottom: 20px; /* Espacio entre tablas */
        }
        .row {
            display: flex; /* Usar flex para alinear las columnas */
            justify-content: space-between; /* Espaciado entre columnas */
        }
        .col-md-6 {
            flex: 1; /* Asegura que ambas columnas tengan el mismo ancho */
            padding: 30px; /* Espaciado interno para columnas */
        }
        .col-md-6 h4 {
            margin-left: 10px;
        }
        #footer {
            color: white;
        }
    </style>
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
<?php $page='members-update'; include 'includes/sidebar.php'?>
<!--sidebar-menu-->

<div id="content">
    <div id="content-header">
        <div id="breadcrumb"> 
            <a href="#" class="tip-bottom"><i class="fas fa-home"></i>Inicio</a> 
            <a href="#" class="current">Eventos Inscritos</a> 
        </div>
        <h1 class="text-center">Lista de Eventos Inscritos <i class="fas fa-calendar-alt"></i></h1>
    </div>
    <div class="container-fluid">
        <hr>
        <div class="row-fluid">
            <div class="span12">

                <div class='widget-box'>
                    <div class='widget-title'> 
                        <span class='icon'> <i class='fas fa-th'></i> </span>
                        <h5>Eventos Inscritos</h5>
                        <form id="custom-search-form" role="search" method="POST" class="form-search form-horizontal pull-right">
                            <div class="input-append span12">
                                <input type="text" class="search-query" placeholder="Buscar" name="search" value="<?php echo htmlspecialchars($search); ?>" required>
                                <button type="submit" class="btn"><i class="fas fa-search"></i></button>
                            </div>
                        </form>
                    </div>

                    <?php
                    // Conexión a la base de datos
                    $conn = mysqli_connect('localhost', 'root', '', 'gymu');
                    if (!$conn) {
                        die("Error de conexión: " . mysqli_connect_error());
                    }

                    if ($cedula) {
                        // Consultar eventos por cédula, filtrando por búsqueda
                        $qry_eventos = "SELECT ie.id, e.nombre AS evento_nombre, ie.id_evento, p.nombre AS persona_nombre
                                         FROM inscripcion_eventos ie
                                         INNER JOIN eventos e ON ie.id_evento = e.id
                                         INNER JOIN personas p ON ie.cedula = p.cedula
                                         WHERE p.cedula = '" . mysqli_real_escape_string($conn, $cedula) . "'";

                        // Filtrar por nombre de persona o nombre de evento
                        if (!empty($search)) {
                            $search = mysqli_real_escape_string($conn, $search);
                            $qry_eventos .= " AND (p.nombre LIKE '%$search%' OR e.nombre LIKE '%$search%')";
                        }

                        $result_eventos = mysqli_query($conn, $qry_eventos);
                    ?>
                    
                    <div class="container-fluid">
                        
                        <div class="row">
                            <div class="col-md-6">
                                <h4>Eventos a los que pertenece:</h4>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Nombre del Evento</th>
                                            <th>Nombre de la Persona</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (mysqli_num_rows($result_eventos) > 0) {
                                            while ($row = mysqli_fetch_assoc($result_eventos)) {
                                                echo "<tr>
                                                        <td>" . htmlspecialchars($row['evento_nombre']) . "</td>
                                                        <td>" . htmlspecialchars($row['persona_nombre']) . "</td>
                                                        <td>
                                                            <a href='delete-inscripcion-registration.php?id=" . htmlspecialchars($row['id']) . "' style='color:#F66;' onclick=\"return confirm('¿Estás seguro de que deseas eliminar esta inscripción?');\">
                                                                <i class='fas fa-trash'></i> Eliminar
                                                            </a>
                                                        </td>
                                                      </tr>";
                                            }
                                        } else {
                                            echo "<tr><td colspan='3'>No está inscrito en ningún evento.</td></tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <?php
                    }
                    // Cerrar la conexión
                    mysqli_close($conn);
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!--Footer-part-->
<div class="row-fluid">
    <div id="footer" class="span12"> <?php echo date("Y");?> &copy; Desarrollado por Union Digital</div>
</div>
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
<script src="../js/matrix.form_validation.js"></script> 
<script src="../js/jquery.wizard.js"></script> 
<script src="../js/jquery.uniform.js"></script> 
<script src="../js/select2.min.js"></script> 
<script src="../js/matrix.popover.js"></script> 
<script src="../js/jquery.dataTables.min.js"></script> 
<script src="../js/matrix.tables.js"></script> 

<script type="text/javascript">
    function goPage (newURL) {
        if (newURL != "") {
            if (newURL == "-") {
                resetMenu();    
            } else {
                document.location.href = newURL;
            }
        }
    }
</script>

</body>
</html>

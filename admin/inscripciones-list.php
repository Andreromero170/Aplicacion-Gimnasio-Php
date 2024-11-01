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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Inscripción a Eventos</title>

    <!-- Incluye Bootstrap y estilos personalizados -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/matrix-style.css">
    <link rel="stylesheet" href="../css/matrix-media.css">
    <link rel="stylesheet" href="../css/select2.css">
    <link rel="stylesheet" href="../css/font-awesome.css">
    <link rel="stylesheet" href="../css/fullcalendar.css">
    <link href="../font-awesome/css/all.css" rel="stylesheet">

    <style>
        #footer {
            color: white;
        }
        .widget-box {
            margin-top: 20px;
        }
    
        .btn-secondary {
            margin-bottom: 10px;
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
<?php $page='eventos-inscripcion'; include 'includes/sidebar.php'?>
<!--sidebar-menu-->

<div id="content">
    <div id="content-header">
        <div id="breadcrumb"> 
            <a href="#" title="Go to Home" class="tip-bottom">
                <i class="fas fa-home"></i>Inicio
            </a> 
            <a href="#" class="current">Inscripción a Eventos</a> 
        </div>
        <h1 class="text-center">Lista de Eventos e Inscripciones <i class="fas fa-calendar-check"></i></h1>
    </div>
    <div class="container-fluid">
        <hr>
        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-title"> 
                        <span class="icon"> <i class="fas fa-th"></i> </span>
                        <h5>Tabla de Eventos</h5>
                        <form id="custom-search-form" role="search" method="POST" class="form-search form-horizontal pull-right">
                            <div class="input-append span12">
                                <input type="text" class="search-query" placeholder="Buscar" name="search" value="<?php echo isset($_POST['search']) ? htmlspecialchars($_POST['search']) : ''; ?>" required>
                                <button type="submit" class="btn"><i class="fas fa-search"></i></button>
                            </div>
                        </form>
                    </div>
                    
                    <!-- Botón para mostrar u ocultar eventos ocultos -->
                    <form method="POST" action="">
                        <button type="submit" name="toggle_hidden" class="btn btn-secondary">
                            <?php echo isset($_POST['toggle_hidden']) ? 'Ocultar Eventos Ocultos' : 'Mostrar Eventos Ocultos'; ?>
                        </button>
                    </form>

                    <?php
                    $conn = mysqli_connect('localhost', 'root', '', 'gymu');
                    if (!$conn) {
                        die("Error de conexión: " . mysqli_connect_error());
                    }

                    // Inicializa la variable de búsqueda
                    $search = isset($_POST['search']) ? mysqli_real_escape_string($conn, $_POST['search']) : '';

                    // Si el botón "Mostrar Eventos Ocultos" está presionado, incluye los eventos ocultos
                    $show_hidden = isset($_POST['toggle_hidden']) ? '' : 'AND e.visible = 1';

                    // Consulta SQL para obtener los eventos, filtrando por nombre y visibilidad
                    $qry = "SELECT 
                                e.id,
                                e.nombre, 
                                e.cantidad_inscritos,
                                e.costo,
                                (SELECT COUNT(*) FROM inscripcion_eventos i WHERE i.id_evento = e.id) AS cantidad_inscritos_evento,
                                (e.cantidad_inscritos - COALESCE((SELECT COUNT(*) FROM inscripcion_eventos i WHERE i.id_evento = e.id), 0)) AS cupos_restantes
                            FROM eventos e
                            WHERE e.nombre LIKE '%$search%' $show_hidden"; // Filtro de búsqueda y visibilidad

                    $result = mysqli_query($conn, $qry);
                    
                    echo "<table class='table table-bordered table-hover'>
                            <thead>
                                <tr>
                                    <th>Evento</th>
                                    <th>Cupos Disponibles</th>
                                    <th>Costo</th>
                                    <th>Cupos Restantes</th>
                                    <th>Cantidad de Inscritos en Evento</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>";
                    
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tbody>
                                <tr>
                                    <td>".$row['nombre']."</td>
                                    <td>".$row['cantidad_inscritos']."</td>
                                    <td>".$row['costo']."</td>
                                    <td>".($row['cupos_restantes'] > 0 ? $row['cupos_restantes'] : "Completo")."</td>
                                    <td>".$row['cantidad_inscritos_evento']."</td>
                                    <td>
                                        <a href='detalles_eventos.php?id_evento=".$row['id']."' class='btn btn-primary'>Detalles</a>
                                        <a href='mostrar-ocultar-eventos.php?id=".$row['id']."' class='btn btn-warning'>Mostrar/Ocultar</a>
                                    </td>
                                </tr>
                              </tbody>";
                    }
                    
                    echo "</table>";
                    ?>
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

<!--end-Footer-part-->

<!-- JavaScript y jQuery -->
<script src="../js/jquery.min.js"></script> 
<script src="../js/jquery.ui.custom.js"></script> 
<script src="../js/bootstrap.min.js"></script> 
<script src="../js/matrix.js"></script> 
<script src="../js/jquery.dataTables.min.js"></script> 
<script src="../js/matrix.tables.js"></script> 

<script type="text/javascript">
    function goPage (newURL) {
        if (newURL != "") {
            if (newURL == "-" ) {
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

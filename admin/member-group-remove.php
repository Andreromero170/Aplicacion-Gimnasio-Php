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
</style>

<!--Header-part-->
<div id="header">
    <h1><a href="dashboard.html">Perfect Gym Admin</a></h1>
</div>
<!--close-Header-part--> 

<!--top-Header-menu-->
<?php include 'includes/topheader.php'?>
<!--close-top-Header-menu-->
<!-- Visit codeastro.com for more projects -->
<!--sidebar-menu-->
<?php $page='members-update'; include 'includes/sidebar.php'?>
<!--sidebar-menu-->

<div id="content">
    <div id="content-header">
        <div id="breadcrumb"> 
            <a href="#" class="tip-bottom"><i class="fas fa-home"></i>Inicio</a> 
            <a href="#" class="current">Miembros por Grupos</a> 
        </div>
        <h1 class="text-center">Lista de Miembros por Grupos y Servicios <i class="fas fa-group"></i></h1>
    </div>
    <div class="container-fluid">
        <hr>
        <div class="row-fluid">
            <div class="span12">

                <div class='widget-box'>
                    <div class='widget-title'> 
                        <span class='icon'> <i class='fas fa-th'></i> </span>
                        <h5>Tabla de Grupos</h5>
                        <form id="custom-search-form" role="search" method="POST" class="form-search form-horizontal pull-right">
                            <div class="input-append span12">
                                <input type="text" class="search-query" placeholder="Search" name="search" required>
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

                    if (isset($_POST['search'])) {
                        $nombre_completo = mysqli_real_escape_string($conn, $_POST['search']); // Obtener el nombre completo del formulario

                        // Consultar grupos
                        $qry_grupos = "SELECT g.nombre_grupo, mg.id_grupo
                                       FROM grupos g
                                       INNER JOIN miembro_grupo mg ON g.id_grupo = mg.id_grupo
                                       INNER JOIN miembros m ON mg.id_usuario = m.id_usuario
                                       WHERE m.nombre_completo LIKE '%$nombre_completo%'";

                        $result_grupos = mysqli_query($conn, $qry_grupos);

                        // Consultar tarifas
                        $qry_tarifas = "SELECT t.nombre, mt.id
                                        FROM tarifas t
                                        JOIN miembro_tarifa mt ON t.id = mt.id
                                        JOIN miembros m ON mt.id_usuario = m.id_usuario
                                        WHERE m.nombre_completo LIKE '%$nombre_completo%'";

                        $result_tarifas = mysqli_query($conn, $qry_tarifas);
                    ?>
                    
                    <div class="container-fluid">
                        <h3 class="text-center">Resultados de la Búsqueda para Miembros por Grupos</h3>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <h4>Grupos a los que pertenece:</h4>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Nombre del Grupo</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (mysqli_num_rows($result_grupos) > 0) {
                                            while ($row = mysqli_fetch_assoc($result_grupos)) {
                                                echo "<tr>
                                                        <td>" . htmlspecialchars($row['nombre_grupo']) . "</td>
                                                        <td>
                                                            <a href='delete-group-member.php?id=" . htmlspecialchars($row['id_grupo']) . "' style='color:#F66;' onclick=\"return confirm('¿Estás seguro de que deseas eliminar este miembro del grupo?');\">
                                                                <i class='fas fa-trash'></i> Eliminar
                                                            </a>
                                                        </td>
                                                      </tr>";
                                            }
                                        } else {
                                            echo "<tr><td>No pertenece a ningún grupo.</td><td></td></tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>

                            <div class="col-md-6">
                                <h4>Tarifas a las que pertenece:</h4>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Nombre de la Tarifa</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (mysqli_num_rows($result_tarifas) > 0) {
                                            while ($row = mysqli_fetch_assoc($result_tarifas)) {
                                                echo "<tr>
                                                        <td>" . htmlspecialchars($row['nombre']) . "</td>
                                                        <td>
                                                            <a href='delete-tariff-member.php?id=" . htmlspecialchars($row['id']) . "' style='color:#F66;' onclick=\"return confirm('¿Estás seguro de que deseas eliminar esta tarifa?');\">
                                                                <i class='fas fa-trash'></i> Eliminar
                                                            </a>
                                                        </td>
                                                      </tr>";
                                            }
                                        } else {
                                            echo "<tr><td>No tiene tarifas asignadas.</td><td></td></tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <?php
                        // Cerrar la conexión
                        mysqli_close($conn);
                    }
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

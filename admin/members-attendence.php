
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


$conn = mysqli_connect('localhost', 'root', '', 'gymu');
if (!$conn) {
    die("Error de conexión: " . mysqli_connect_error());
}

// Variables para almacenar los resultados
$asistencias = [];
$inasistencias = [];
$search_result = false;

if (isset($_POST['search'])) {
    $search = mysqli_real_escape_string($conn, $_POST['search']);
    
    // Consulta para obtener el ID del miembro
    $member_query = "SELECT id_usuario, nombre_completo FROM miembros WHERE nombre_completo LIKE '%$search%'";
    $member_result = mysqli_query($conn, $member_query);

    if (mysqli_num_rows($member_result) > 0) {
        $member = mysqli_fetch_assoc($member_result);
        $member_id = $member['id_usuario'];
        $search_result = $member['nombre_completo'];

        // Obtener asistencias del miembro
        $attendance_query = "SELECT fecha_actual, estado_asistencia FROM asistencia WHERE id_usuario = ?";
        $stmt = $conn->prepare($attendance_query);
        $stmt->bind_param("i", $member_id);
        $stmt->execute();
        $attendance_result = $stmt->get_result();

        while ($row = $attendance_result->fetch_assoc()) {
            if ($row['estado_asistencia'] === "Faltó sin Aviso") {
                $inasistencias[] = $row['fecha_actual'];
            } else {
                $asistencias[] = $row['fecha_actual'];
            }
        }
    } else {
        echo "<script>alert('No se encontró el miembro.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Asistencia</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/matrix-style.css">
    <link rel="stylesheet" href="../css/matrix-media.css">
    <link href="../font-awesome/css/all.css" rel="stylesheet">
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
<?php $page='attendance-members'; include 'includes/sidebar.php'?>
<!--sidebar-menu-->

<div id="content">
    <div id="content-header">
        <div id="breadcrumb"> <a href="#" title="Go to Home" class="tip-bottom"><i class="fas fa-home"></i>Inicio</a> <a href="#" class="current">Registro de Asistencia</a> </div>
        <h1 class="text-center">Lista de Asistencia de Miembros</h1>
    </div>
    <div class="container-fluid">
        <hr>
        <div class="row-fluid">
            <div class="span12">
                <form method="POST" action="">
                    <div class="form-group">
                        <input type="text" name="search" placeholder="Buscar por nombre" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Buscar</button>
                </form>

                <?php if ($search_result): ?>
                    <h2 class="text-center">Asistencias de: <?= $search_result ?></h2>
                    <h3>Asistencias (Total: <?= count($asistencias) ?>)</h3>
                    <ul>
                        <?php foreach ($asistencias as $asistencia): ?>
                            <li><?= $asistencia ?></li>
                        <?php endforeach; ?>
                    </ul>
                    <h3>Inasistencias (Total: <?= count($inasistencias) ?>)</h3>
                    <ul>
                        <?php foreach ($inasistencias as $inasistencia): ?>
                            <li><?= $inasistencia ?></li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!--Footer-part-->
<div class="row-fluid">
    <div id="footer" class="span12"> <?php echo date("Y");?> &copy; Desarrollado por Union Digital</div>
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
  // This function is called from the pop-up menus to transfer to
  // a different page. Ignore if the value returned is a null string:
  function goPage (newURL) {

      // if url is empty, skip the menu dividers and reset the menu selection to default
      if (newURL != "") {
      
          // if url is "-", it is this page -- reset the menu:
          if (newURL == "-" ) {
              resetMenu();            
          } 
          // else, send page to designated URL            
          else {  
            document.location.href = newURL;
          }
      }
  }

// resets the menu selection upon entry to this page:
function resetMenu() {
   document.gomenu.selector.selectedIndex = 2;
}
</script>
</body>
</html>

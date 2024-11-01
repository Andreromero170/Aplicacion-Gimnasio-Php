<?php
session_start();
// Verifica si el usuario está autenticado
if (!isset($_SESSION['user_id'])) {
    header('location:../index.php');    
    exit();
}
?>
<!-- Visit codeastro.com for more projects -->
<!DOCTYPE html>
<html lang="en">
<head>
<title>Gym System Admin</title>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" href="../css/bootstrap.min.css" />
<link rel="stylesheet" href="../css/bootstrap-responsive.min.css" />
<link rel="stylesheet" href="../css/uniform.css" />
<link rel="stylesheet" href="../css/select2.css" />
<link rel="stylesheet" href="../css/matrix-style.css" />
<link rel="stylesheet" href="../css/matrix-media.css" />
<link href="../font-awesome/css/fontawesome.css" rel="stylesheet" />
<link href="../font-awesome/css/all.css" rel="stylesheet" />
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
</head>
<body>
<!-- Visit codeastro.com for more projects -->
<!--Header-part-->
<div id="header">
  <h1><a href="dashboard.html">Perfect Gym Admin</a></h1>
</div>
<!--close-Header-part--> 

<!--top-Header-menu-->
<?php include 'includes/topheader.php'; ?>
<!--close-top-Header-menu-->

<!--sidebar-menu-->
<?php $page = "attendance"; include 'includes/sidebar.php'; ?>
<!--sidebar-menu-->

<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.php" title="Go to Home" class="tip-bottom"><i class="fas fa-home"></i> Home</a> <a href="attendance.php" class="current">Manage Attendance</a> </div>
    <h1 class="text-center">Listado de Asistencias <i class="fas fa-calendar"></i></h1>
  </div>
  <div class="container-fluid">
    <div class="row-fluid">
      <div class="span12">
        <div class='widget-box'>
          <div class='widget-title'> <span class='icon'> <i class='fas fa-th'></i> </span>
            <h5>Tabla de Asistencias</h5>
          </div>
          <div class='widget-content nopadding'> 
            <table class='table table-bordered table-hover'>
              <thead>
                <tr>
                  <th>#</th>
                  <th>Nombre Completo</th>
                  <th>Fecha de Registro</th>
                  <th>Fecha de Pago</th>
                  <th>Acción</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                $conn = mysqli_connect('localhost', 'root', '', 'gymu');
                if (!$conn) {
                    die("Error de conexión: " . mysqli_connect_error());
                }
                date_default_timezone_set('Asia/Kathmandu');
                $current_date = date('Y-m-d');
                
                $qry = "SELECT * FROM miembros WHERE estado = 'Activo'";
                $result = mysqli_query($conn, $qry);
                $cnt = 1;

                while ($row = mysqli_fetch_array($result)) { 
                    $user_id = $row['id_usuario']; // Asegúrate de que esta columna existe en tu tabla miembros
                    $qry_attendance = "SELECT * FROM asistencia WHERE fecha_actual = '$current_date' AND id_usuario = '$user_id'";
                    $res_attendance = mysqli_query($conn, $qry_attendance);
                    $row_attendance = mysqli_fetch_array($res_attendance);

                    // Verifica si hay un registro de asistencia para el usuario en el día actual
                    if ($row_attendance) {
                        $check_in_time = $row_attendance['hora_actual'];
                        $action_button = "<a href='actions/delete-attendance.php?id=$user_id'><button class='btn btn-danger'>Check Out <i class='fas fa-clock'></i></button></a>";
                    } else {
                        $check_in_time = '';
                        $action_button = "<a href='actions/check-attendance.php?id=$user_id'><button class='btn btn-info'>Check In <i class='fas fa-map-marker-alt'></i></button></a>";
                    }
                ?>
                <tr>
                    <td><div class='text-center'><?php echo $cnt; ?></div></td>
                    <td><div class='text-center'><?php echo $row['nombre_completo']; ?></div></td>
                    <td><div class='text-center'><?php echo $row['fecha_registro']; ?></div></td>
                    <td><div class='text-center'><?php echo $row['fecha_pago']; ?></div></td>
                    <td><div class='text-center'><span class="label label-inverse"><?php echo $check_in_time; ?></span></div>
                        <div class='text-center'><?php echo $action_button; ?></div></td>
                </tr>
                <?php 
                    $cnt++; 
                } 
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!--end-main-container-part-->

<!--Footer-part-->
<div class="row-fluid">
  <div id="footer" class="span12"> <?php echo date("Y");?> &copy; Developed By Naseeb Bajracharya</div>
</div>

<style>
#footer {
  color: white;
}
</style>

<!--end-Footer-part-->

<script src="../js/jquery.min.js"></script> 
<script src="../js/jquery.ui.custom.js"></script> 
<script src="../js/bootstrap.min.js"></script>  
<script src="../js/matrix.js"></script> 
<script src="../js/jquery.validate.js"></script> 
<script src="../js/jquery.uniform.js"></script> 
<script src="../js/select2.min.js"></script> 
<script src="../js/jquery.dataTables.min.js"></script> 
<script src="../js/matrix.tables.js"></script> 

</script>
</body>
</html>

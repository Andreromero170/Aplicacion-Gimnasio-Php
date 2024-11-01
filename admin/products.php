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

<!--top-Header-menu-->
<?php include 'includes/topheader.php'?>

<!--sidebar-menu-->
<?php $page='product-list'; include 'includes/sidebar.php'?>

<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="#" title="Go to Home" class="tip-bottom"><i class="fas fa-home"></i> Inicio</a> <a href="#" class="current">Productos</a> </div>
    <h1 class="text-center">Lista de Productos <i class="fas fa-box"></i></h1>
  </div>
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="span12">

      <div class='widget-box'>
          <div class='widget-title'> 
            <span class='icon'> <i class='fas fa-th'></i> </span>
            <h5>Tabla de Productos</h5>
            <form id="custom-search-form" role="search" method="POST" action="" class="form-search form-horizontal pull-right">
                <div class="input-append span12">
                    <input type="text" class="search-query" placeholder="Buscar" name="search" required>
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
              $search = mysqli_real_escape_string($conn, $_POST['search']);
              // Consulta SQL para buscar productos por nombre de producto
              $qry = "SELECT id, nombre_producto,costo FROM productos WHERE nombre_producto LIKE '%$search%'";
          } else {
              // Consulta SQL para obtener todos los productos
              $qry = "SELECT id, nombre_producto, costo FROM productos";
          }

          $result = mysqli_query($conn, $qry);

          echo "<table class='table table-bordered table-hover'>
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Nombre del Producto</th>
                      <th>Costo</th>
                      <th>Acción</th>
                    </tr>
                  </thead>";

          $cnt = 1;
          while ($row = mysqli_fetch_array($result)) {
              echo "<tbody> 
                      <tr>
                        <td><div class='text-center'>".$cnt."</div></td>
                        <td><div class='text-center'>".$row['nombre_producto']."</div></td>
                        
                        <td><div class='text-center'>$".$row['costo']."</div></td>
                        
                        <td><div class='text-center'><a href='actions/delete-product.php?id=".$row['id']."' style='color:#F66;'><i class='fas fa-trash'></i> Eliminar</a></div></td>
                      </tr>
                    </tbody>";
              $cnt++;  
          }

          echo "</table>";
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

</body>
</html>

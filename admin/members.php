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

<!--Header-part-->
<div id="header">
  <h1><a href="dashboard.html">Perfect Gym Admin</a></h1>
</div>
<!--close-Header-part--> 


<!--top-Header-menu-->
<?php include 'includes/topheader.php'?>
<!--close-top-Header-menu-->
<!--start-top-serch-->
<!-- <div id="search">
  <input type="hidden" placeholder="Search here..."/>
  <button type="submit" class="tip-bottom" title="Search"><i class="icon-search icon-white"></i></button>
</div> -->
<!--close-top-serch-->
<!-- Visit codeastro.com for more projects -->
<!--sidebar-menu-->
<?php $page='members-update'; include 'includes/sidebar.php'?>
<!--sidebar-menu-->

<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="#" title="Go to Home" class="tip-bottom"><i class="fas fa--home"></i>Inicio</a> <a href="#" class="current">Miembros Registrados</a> </div>
    <h1 class="text-center">Lista de Miembros Registrados <i class="fas fa-group"></i></h1>
  </div>
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="span12">

      <div class='widget-box'>
          <div class='widget-title'> <span class='icon'> <i class='fas fa-th'></i> </span>
            <h5>Tabla de Miembros</h5>
            <form id="custom-search-form" role="search" method="POST" action="search-result.php" class="form-search form-horizontal pull-right">
                <div class="input-append span12">
                    <input type="text" class="search-query" placeholder="Search" name="search" required>
                    <button type="submit" class="btn"><i class="fas fa-search"></i></button>
                </div>
            </form>
          </div>
          
          <?php
         
         $conn = mysqli_connect('localhost', 'root', '', 'gymu');
         if (!$conn) {
             die("Error de conexión: " . mysqli_connect_error());
         }
         
         if (isset($_POST['search'])) {
             $search = mysqli_real_escape_string($conn, $_POST['search']);
         
             // Consulta SQL para buscar por nombre o fecha de registro
             $qry = "SELECT 
                         m.id_usuario,
                         m.nombre_completo,
                         m.fecha_registro,
                         m.fecha_pago,
                         m.precio
                     FROM miembros m
                     WHERE m.nombre_completo LIKE '%$search%' 
                     OR m.fecha_registro LIKE '%$search%'
                     ";
         } else {
             // Consulta SQL por defecto si no hay búsqueda
             $qry = "SELECT 
                         m.id_usuario,
                         m.nombre_completo,
                         m.fecha_registro,
                         m.fecha_pago,
                         m.precio
                     FROM miembros m";
         }
         
         $result = mysqli_query($conn, $qry);
         
         echo "<table class='table table-bordered table-hover'>
                 <thead>
                   <tr>
                     <th>#</th>
                     <th>Nombre Completo</th>
                     <th>Fecha Registro</th>
                     <th>Fecha Pago</th>
                     <th>Total A Pagar</th>
                     <th>Accion</th>
                   </tr>
                 </thead>";
         
         $cnt = 1;
         while ($row = mysqli_fetch_array($result)) {
             echo "<tbody> 
                     <tr>
                       <td><div class='text-center'>".$cnt."</div></td>
                       <td><div class='text-center'>".$row['nombre_completo']."</div></td>
                       <td><div class='text-center'>".$row['fecha_registro']."</div></td>
                       <td><div class='text-center'>".$row['fecha_pago']."</div></td>
                       <td><div class='text-center'>".$row['precio']."</div></td>
                       <td><div class='text-center'><a href='edit-memberform.php?id=".$row['id_usuario']."'><i class='fas fa-edit'></i> Editar</a></div>
                   <div class='text-center'><a href='actions/delete-member.php?id=".$row['id_usuario']."' style='color:#F66;'><i class='fas fa-trash'></i> Eliminar</a></div></td>
       
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

<!--end-main-container-part-->

<!--Footer-part-->
<!-- Visit codeastro.com for more projects -->
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

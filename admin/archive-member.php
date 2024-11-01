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

<!--Header-part--><!-- Visit codeastro.com for more projects -->
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

<!--sidebar-menu-->
<?php $page='members-entry'; include 'includes/sidebar.php'?>
<!--sidebar-menu-->
<div id="content">
<div id="content-header">
  <div id="breadcrumb"> <a href="index.php" title="Go to Home" class="tip-bottom"><i class="fas fa-home"></i>Inicio</a> <a href="#" class="tip-bottom">Administracion de Miembros</a> <a href="#" class="current">Añadir Archivos</a> </div>
  <h1>Formulario Archivos Socios</h1>
</div>
<div class="container-fluid">
  <hr>
  <div class="container-fluid">
  <hr>
  <div class="row-fluid">
    <!-- Primer Contenedor -->
    <div class="span6">
      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="fas fa-align-justify"></i> </span>
          <h5>Foto de Miembro</h5>
        </div>
        <div class="widget-content nopadding">
          <form action="add-photo-member-req.php" method="POST" enctype="multipart/form-data" class="form-horizontal">
          <div class="control-group">
              <label class="control-label">Miembros:</label>
              <div class="controls">
              <select name="id_miembro" required="required" id="select">
                                        <?php
                                        // Connect to the database
                                        $conn = mysqli_connect('localhost', 'root', '', 'gymu');
                                        if (!$conn) {
                                            die("Error de conexión: " . mysqli_connect_error());
                                        }

                                        // Query to get user types
                                        $qry = "SELECT id_usuario, nombre_completo FROM miembros";
                                        $result = mysqli_query($conn, $qry);

                                        if (mysqli_num_rows($result) > 0) {
                                            // Generate options for the select field
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                echo '<option value="' . $row['id_usuario'] . '">' . $row['nombre_completo'] . '</option>';
                                            }
                                        } else {
                                            echo '<option value="">No hay usuarios disponibles</option>';
                                        }

                                        // Close the connection
                                        mysqli_close($conn);
                                        ?>
                                    </select>
              </div>
            </div>
           
            <div class="control-group">
  <label class="control-label">Foto de Perfil (desde cámara o galería):</label>
  <div class="controls">
    <!-- Campo para cargar el archivo desde la cámara o galería -->
    <input type="file" class="span11" name="fotos" accept="image/*" capture="environment" required />
  </div>
</div>


            <div class="form-actions text-center">
              <button type="submit" class="btn btn-success">Añadir Fotografia</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <!-- Segundo Contenedor (Al lado del primero) -->
    <div class="span6">
      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="fas fa-align-justify"></i> </span>
          <h5>Información Detalles</h5>
        </div>
        <div class="widget-content nopadding">
          <form action="add-document-member-req.php" method="POST" class="form-horizontal" enctype="multipart/form-data">
          <div class="control-group">
              <label class="control-label">Miembros:</label>
              <div class="controls">
              <select name="id_miembro" required="required" id="select">
                                        <?php
                                        // Connect to the database
                                        $conn = mysqli_connect('localhost', 'root', '', 'gymu');
                                        if (!$conn) {
                                            die("Error de conexión: " . mysqli_connect_error());
                                        }

                                        // Query to get user types
                                        $qry = "SELECT id_usuario, nombre_completo FROM miembros";
                                        $result = mysqli_query($conn, $qry);

                                        if (mysqli_num_rows($result) > 0) {
                                            // Generate options for the select field
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                echo '<option value="' . $row['id_usuario'] . '">' . $row['nombre_completo'] . '</option>';
                                            }
                                        } else {
                                            echo '<option value="">No hay usuarios disponibles</option>';
                                        }

                                        // Close the connection
                                        mysqli_close($conn);
                                        ?>
                                    </select>
              </div>
            </div>

            <div class="control-group">
  <label class="control-label">Documentos (desde cámara o galería):</label>
  <div class="controls">
    <input type="file" class="span11" name="documentos" accept="image/*" capture="environment" required />
  </div>
</div>


            <div class="form-actions text-center">
              <button type="submit" class="btn btn-success">Añadir Documentos</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

</div>
  </div>
</div>



<!--end-main-container-part-->

<!--Footer-part-->

<div class="row-fluid">
  <div id="footer" class="span12"> <?php echo date("Y");?> &copy; Desarrollado por Union Digital</a> </div>
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

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


<?php $page='members-entry'; include 'includes/sidebar.php'?>
<!--sidebar-menu-->
<div id="content">
<div id="content-header">
  <div id="breadcrumb"> <a href="#"  class="tip-bottom"><i class="fas fa-home"></i>Inicio</a> <a href="#" class="tip-bottom">Administracion de Eventos</a> </div>
  <h1>Entrada de Formulario</h1>
</div>
<div class="container-fluid">
  <hr>
  <div class="row-fluid">
    <div class="span6">
      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="fas fa-align-justify"></i> </span>
          <h5>Info-Evento</h5>
        </div>
        <div class="widget-content nopadding">
          <form action="add-event-req.php" method="POST" class="form-horizontal">
            <div class="control-group">
              <label class="control-label">Nombre del Evento :</label>
              <div class="controls">
                <input type="text" class="span11" name="nombre_evento" placeholder="Nombre del Evento" />
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Cantidad de Cupos :</label>
              <div class="controls">
              <input type="number" class="span11" name="cantidad_cupos" placeholder="Cantidad de Cupos" />
              </div>
              <div class="control-group">
              <label class="control-label">Costo del Evento :</label>
              <div class="controls">
                <input type="text" class="span11" name="costo_evento" placeholder="Costo del Evento" />
              </div>
            </div>

              <div class="form-actions text-center">
              <button type="submit" class="btn btn-success">Registrar Evento</button>
            </div>
            </form>
            </div>
          
            
</div>
</div></div>
        

    
    
    <div class="span6">
      <div class="widget-box">
       
        <div class="widget-content nopadding">
        <form action="add-people-req.php" method="POST" class="form-horizontal">

              <div class="widget-title"> <span class="icon"> <i class="fas fa-align-justify"></i> </span>
          <h5>Info-Personas</h5>
        </div>
        <div class="widget-content nopadding">
          <div class="form-horizontal">
      
          <div class="control-group">
  <label class="control-label">Cedula :</label>
  <div class="controls">
  <input type="text" class="span11" name="cedula" placeholder="Cedula" />

  </div>
</div>
<div class="control-group">
  <label class="control-label">Nombre :</label>
  <div class="controls">
  <input type="text" class="span11" name="nombre_completo" placeholder="Nombre Completo" />

  </div>
</div>
<div class="control-group">
  <label class="control-label">Telefono :</label>
  <div class="controls">
  <input type="text" class="span11" name="telefono" placeholder="Telefono" />
  </div>
</div>
<div class="control-group">
                                <label class="control-label">Fecha de Nacimiento:</label>
                                <div class="controls">
                                    <input type="date" name="fecha_nacimiento" class="span11" required/>
                                    <span class="help-block">Fecha de Nacimiento</span>
                                </div>
                            </div>
            
            
            <div class="form-actions text-center">
              <button type="submit" class="btn btn-success">Registrar Persona</button>
            </div>
            </form>

          </div>



        </div>

        </div>
      </div>

	</div>
  </div>
  
  
</div></div>


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

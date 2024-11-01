<?php
session_start();
//the isset function to check username is already loged in and stored on the session
if(!isset($_SESSION['user_id'])){
header('location:../index.php');	
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
  <div id="breadcrumb"> <a href="index.php" title="Go to Home" class="tip-bottom"><i class="fas fa-home"></i> Home</a> <a href="#" class="tip-bottom">Manamge Members</a> <a href="#" class="current">Add Members</a> </div>
  <h1>Entrada de Formulario Eventos</h1>
</div>
<div class="container-fluid">
  <hr>
  <div class="row-fluid">
    <div class="span6">
      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="fas fa-align-justify"></i> </span>
          <h5>Personal-info</h5>
        </div>
        <div class="widget-content nopadding">
          <form action="add-member-req.php" method="POST" class="form-horizontal">
            <div class="control-group">
              <label class="control-label">Cedula :</label>
              <div class="controls">
                <input type="text" class="span11" name="nombreCompleto" placeholder="Cedula" />
              </div>
            </div>

            <div class="control-group">
              <label class="control-label">Nombre :</label>
              <div class="controls">
                <input type="text" class="span11" name="nombreCompleto" placeholder="Nombre Completo" />
              </div>
            </div>

            <div class="control-group">
              <label class="control-label">Celular :</label>
              <div class="controls">
                <input type="text" class="span11" name="nombreCompleto" placeholder="Celular" />
              </div>
            </div>
            
            <div class="control-group">
  <label class="control-label">Tipo de Pago :</label>
  <div class="controls">
    <select name="grupo" required="required" id="select">
     <option value="">Cuotas</option>
     <option value="">Totalidad</option>
    </select>
  </div>
</div>
           
            
          
        </div>
     
        
    

            <div class="control-group">
              
              
            </div>
          </div>

          </div>



        </div>
      </div>
	  
	
    </div>

    
    
    <div class="span6">
      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="fas fa-align-justify"></i> </span>
          <h5>Contacto-info</h5>
        </div>
        <div class="widget-content nopadding">
          <div class="form-horizontal">
            <div class="control-group">
              <label for="normal" class="control-label">Celular</label>
              <div class="controls">
                <input type="number" id="mask-phone" name="contacto" placeholder="9876543210" class="span8 mask text">
                <span class="help-block blue span8">(999) 999-9999</span> 
                </div>
            </div>
            <div class="control-group">
              <label class="control-label">Direccion :</label>
              <div class="controls">
                <input type="text" class="span11" name="direccion" placeholder="Direccion" />
              </div>
            </div>
          </div>

              <div class="widget-title"> <span class="icon"> <i class="fas fa-align-justify"></i> </span>
          <h5>Detalles de Servicios</h5>
        </div>
        <div class="widget-content nopadding">
          <div class="form-horizontal">
      
          <div class="control-group">
  <label class="control-label">Servicios :</label>
  <div class="controls">
  <select name="tarifa" required="required" id="selectTarifa">
  <?php
   $conn = mysqli_connect('localhost', 'root', '', 'gymu');
   if (!$conn) {
       die("Error de conexión: " . mysqli_connect_error());
   }
  // Consulta para obtener las tarifas y sus precios
  $query = "SELECT nombre, costo FROM tarifas";
  $result = mysqli_query($conn, $query);
  
  // Mostrar cada opción dentro del select, con el precio como un atributo de datos
  while ($row = mysqli_fetch_assoc($result)) {
      echo "<option value='".$row['nombre']."' data-precio='".$row['costo']."'>".$row['nombre']."</option>";
  }
  ?>
</select>

  </div>
</div>


          

            <div class="control-group">
              <label class="control-label">Total</label>
              <div class="controls">
                <div class="input-append">
                  <span class="add-on">$</span> 
                  <input type="texto" placeholder="" name="precio" class="span11">
                  </div>
              </div>
            </div>
            
          
            
            <div class="form-actions text-center">
              <button type="submit" class="btn btn-success">Submit Member Details</button>
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
  <div id="footer" class="span12"> <?php echo date("Y");?> &copy; Developed By Naseeb Bajracharya</a> </div>
</div>

<style>
#footer {
  color: white;
}
</style>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
 

<script>
$(document).ready(function(){
  // Escucha el cambio de selección en el select de tarifas
  $('#selectTarifa').change(function() {
    // Obtener el precio de la tarifa seleccionada usando el atributo data-precio
    var precioSeleccionado = $(this).find('option:selected').data('precio');
    
    // Actualizar el campo de precio
    $('input[name="precio"]').val(precioSeleccionado);
  });
});

</script>


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

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
  #content{
    height:930px;
  }
</style>

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

<?php
   // Connect to the database
   $conn = mysqli_connect('localhost', 'root', '', 'gymu');
   if (!$conn) {
       die("Error de conexión: " . mysqli_connect_error());
   }

$id=$_GET['id'];
$qry= "select * from miembros where id_usuario='$id'";
$result=mysqli_query($conn,$qry);
while($row=mysqli_fetch_array($result)){
?> 
<!--sidebar-menu-->
<div id="content">
<div id="content-header">
  <div id="breadcrumb"> <a href="#"  class="tip-bottom"><i class="fas fa-home"></i>Inicio</a> <a href="#" class="tip-bottom">Administracion de Miembros</a> <a href="#" class="current">Actualizar Miembros</a> </div>
  <h1>Entrada de Formulario Socios</h1>
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
          <form action="edit-member-req.php?id=<?php echo $id?>" method="POST" class="form-horizontal">
            <div class="control-group">
              <label class="control-label">Nombre Completo :</label>
              <div class="controls">
                <input type="text" class="span11" name="nombre_completo" placeholder="Nombre Completo" value='<?php echo $row['nombre_completo']; ?>'/>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Patologias :</label>
              <div class="controls">
               
                <textarea name="patologias" id=""><?php echo $row['patologias']; ?></textarea>
              </div>
            </div>
           
            <div class="control-group">
              <label class="control-label">Genero Seleccionado Previamente :</label>
              <div class="controls">
                <input type="text" class="span11" value='<?php echo $row['genero']; ?>'/>
              </div>
            </div>
           
            <div class="control-group">
              <label class="control-label">Genero :</label>
              <div class="controls">
              <select name="genero" required="required" id="select">
                  <option value="Masculino" selected="selected">Masculino</option>
                  <option value="Femenino">Femenino</option>
                </select>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Fecha Añadida Previamente:</label>
              <div class="controls">
                <input type="text" class="span11" value='<?php echo $row['fecha_registro']; ?>'/>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Fecha de Inscripcion:</label>
              <div class="controls">
                <input type="date" name="dor" class="span11" />
                <span class="help-block">Fecha de Registro</span> </div>
            </div>
            
          
        </div>
     
        
        <div class="widget-content nopadding">
          <div class="form-horizontal">
          
        </div>
        <div class="widget-content nopadding">
          <div class="form-horizontal">
          <div class="control-group">
              <label class="control-label">Nivel Fisico :</label>
              <div class="controls">
               
                <textarea name="nivel_fisico" id=""><?php echo $row['nivel_aptitud']; ?></textarea>
              </div>
            </div>

            <div class="control-group">
  <label class="control-label">Grupo Seleccionado Previamente :</label>
  <div class="controls">
    <?php
    // Conexión a la base de datos
    $conn = mysqli_connect('localhost', 'root', '', 'gymu');
    if (!$conn) {
        die("Error de conexión: " . mysqli_connect_error());
    }

    $id = $_GET['id'];
    $qry = "SELECT g.* FROM miembro_grupo mg 
            JOIN grupos g ON mg.id_grupo = g.id_grupo 
            WHERE mg.id_usuario = '$id'";
    $result = mysqli_query($conn, $qry);

    // Verificar si hay grupos
    if(mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_array($result)) {
            // Mostrar los nombres de los grupos en una lista
            echo '<textarea readonly>' . $row['nombre_grupo'] . '</textarea><br>';
        }
    } else {
        echo '<p>No hay grupos seleccionados previamente.</p>';
    }
    
    mysqli_close($conn);
    ?>
  </div>
</div>


            <div class="control-group">
  <label class="control-label">Grupo :</label>
  <div class="controls">
  <select name="grupo[]" multiple="multiple" required="required" id="selectGrupo">
    <?php
    // Conectar a la base de datos
    $conn = mysqli_connect('localhost', 'root', '', 'gymu');
    if (!$conn) {
        die("Error de conexión: " . mysqli_connect_error());
    }
    
    // Consulta para obtener los grupos
    $query = "SELECT id_grupo, nombre_grupo FROM grupos";
    $result = mysqli_query($conn, $query);
    
    // Mostrar cada opción dentro del select
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<option value='".$row['id_grupo']."'>".$row['nombre_grupo']."</option>";
    }
    ?>
</select>


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
        <?php
   // Connect to the database
   $conn = mysqli_connect('localhost', 'root', '', 'gymu');
   if (!$conn) {
       die("Error de conexión: " . mysqli_connect_error());
   }

$id=$_GET['id'];
$qry= "select * from miembros where id_usuario='$id'";
$result=mysqli_query($conn,$qry);
while($row=mysqli_fetch_array($result)){
  ?> 
        <div class="widget-content nopadding">
          <div class="form-horizontal">
            <div class="control-group">
              <label for="normal" class="control-label">Celular</label>
              <div class="controls">
                <input type="text" id="mask-phone" name="contacto" placeholder="9876543210" class="span8 mask text" value='<?php echo $row['contacto']; ?>'>
                <span class="help-block blue span8">(999) 999-9999</span> 
                </div>
            </div>
            <div class="control-group">
              <label class="control-label">Direccion :</label>
              <div class="controls">
                <input type="text" class="span11" name="direccion" placeholder="Direccion" value='<?php echo $row['direccion']; ?>'/>
              </div>
            </div>
          </div>

              <div class="widget-title"> <span class="icon"> <i class="fas fa-align-justify"></i> </span>
          <h5>Detalles de Servicios</h5>
        </div>
        <div class="widget-content nopadding">
          <div class="form-horizontal">
      
          <div class="control-group">
  <label class="control-label">Servicio Seleccionado Previamente :</label>
  <div class="controls">
    <?php
    // Conexión a la base de datos
    $conn = mysqli_connect('localhost', 'root', '', 'gymu');
    if (!$conn) {
        die("Error de conexión: " . mysqli_connect_error());
    }

    $id = $_GET['id'];
    $qry = "SELECT g.* FROM miembro_tarifa mg JOIN tarifas g ON mg.id = g.id WHERE mg.id_usuario ='$id'";
    $result = mysqli_query($conn, $qry);

    // Verificar si hay grupos
    if(mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_array($result)) {
            // Mostrar los nombres de los grupos en una lista
            echo '<textarea readonly>' . $row['nombre'] . '</textarea><br>';
        }
    } else {
        echo '<p>No hay grupos seleccionados previamente.</p>';
    }
    
    mysqli_close($conn);
    ?>
  </div>
</div>
  
<div class="control-group">
  <label class="control-label">Servicios :</label>
  <div class="controls">
    <select name="tarifas[]" multiple="multiple" required="required" id="selectTarifa">
      <?php
      $conn = mysqli_connect('localhost', 'root', '', 'gymu');
      if (!$conn) {
          die("Error de conexión: " . mysqli_connect_error());
      }
      $query = "SELECT id, nombre, costo FROM tarifas"; // Asegúrate de que la columna precio exista en la tabla tarifas
      $result = mysqli_query($conn, $query);
      while ($row = mysqli_fetch_assoc($result)) {
          echo "<option value='".$row['id']."' data-precio='".$row['costo']."'>".$row['nombre']."</option>";
      }
      ?>
    </select>
  </div>
</div>

<?php
   // Connect to the database
   $conn = mysqli_connect('localhost', 'root', '', 'gymu');
   if (!$conn) {
       die("Error de conexión: " . mysqli_connect_error());
   }

$id=$_GET['id'];
$qry= "select * from miembros where id_usuario='$id'";
$result=mysqli_query($conn,$qry);
while($row=mysqli_fetch_array($result)){
  ?> 
          

            <div class="control-group">
              <label class="control-label">Total</label>
              <div class="controls">
                <div class="input-append">
                  <span class="add-on">$</span> 
                  <input type="texto" placeholder="" name="precio" class="span11" value='<?php echo $row['precio']; ?>'>
                  </div>
              </div>
            </div>
            <?php
}
?>

          
            
            <div class="form-actions text-center">
              <button type="submit" class="btn btn-success">Actualizar Detalles Socio</button>
            </div>
            </form>

          </div>

       
          <?php
}
?>
         <?php
}
?>

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
<div id="footer" class="span12"> <?php echo date("Y");?> &copy; Desarrollado por Union Digital</div>

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

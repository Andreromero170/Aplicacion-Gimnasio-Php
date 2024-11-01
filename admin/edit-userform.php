<?php
session_start();
//the isset function to check username is already loged in and stored on the session
if(!isset($_SESSION['user_id'])){
header('location:../index.php');	
}
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
<!--close-Header-part--> 


<!--top-Header-menu-->
<?php include 'includes/topheader.php'?>

<!--sidebar-menu-->
<?php $page='users-update'; include 'includes/sidebar.php'?>
<!--sidebar-menu-->

<?php
   // Connect to the database
   $conn = mysqli_connect('localhost', 'root', '', 'gymu');
   if (!$conn) {
       die("Error de conexión: " . mysqli_connect_error());
   }

$id=$_GET['id'];
$qry= "select * from usuarios where id_usuario='$id'";
$result=mysqli_query($conn,$qry);
while($row=mysqli_fetch_array($result)){
?> 
<!-- Visit codeastro.com for more projects -->
<div id="content">
<div id="content-header">
  <div id="breadcrumb"> <a href="#" class="tip-bottom"><i class="fas fa-home"></i> Home</a> <a href="#" class="tip-bottom">Editar Miembros</a> </div>
  <h1>Actualizar Usuarios</h1>
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


        <?php

          $id = $_GET["id"];

          ?>          
          <form action="edit-user-req.php?id=<?php echo $id; ?>" method="POST" class="form-horizontal">

          <div class="control-group">
                                <label class="control-label">Usuario :</label>
                                <div class="controls">
                                    <input type="text" class="span11" name="usuario" placeholder="Nombre de Usuario" value='<?php echo $row['nombre_usuario']; ?>' />
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Contraseña :</label>
                                <div class="controls">
                                    <input type="text" class="span11" name="contrasena" placeholder="Contraseña" value='<?php echo $row['contrasena']; ?>'/>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">Tipo de Usuario :</label>
                                <div class="controls">
                                    <input type="text" class="span11" placeholder="Tipo de Usuario" value='<?php echo $row['id_tipo']; ?>'/>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">Tipo de Usuario :</label>
                                <div class="controls">
                                    <select name="id_tipo" required="required" id="select">
                                        <?php
                                        // Connect to the database
                                        $conn = mysqli_connect('localhost', 'root', '', 'gymu');
                                        if (!$conn) {
                                            die("Error de conexión: " . mysqli_connect_error());
                                        }

                                        // Query to get user types
                                        $qry = "SELECT id_tipo, tipo FROM tipos_usuarios";
                                        $result = mysqli_query($conn, $qry);

                                        if (mysqli_num_rows($result) > 0) {
                                            // Generate options for the select field
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                echo '<option value="' . $row['id_tipo'] . '">' . $row['tipo'] . '</option>';
                                            }
                                        } else {
                                            echo '<option value="">No hay tipos de usuario disponibles</option>';
                                        }

                                        // Close the connection
                                        mysqli_close($conn);
                                        ?>
                                    </select>
                                </div>
                            </div>

                          
                            <div class="form-actions">
                                <button type="submit" class="btn btn-success">Actualizar Usuario</button>
                            </div>
     
      </div>
	  
	
    </div>

    
    
       
<?php
}
?>


        </div>

        </div>
      </div>

	
  </div>
  
  
</div></div>


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
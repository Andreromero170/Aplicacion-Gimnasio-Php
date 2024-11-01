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
<!--close-Header-part-->

<!--top-Header-menu-->
<?php include 'includes/topheader.php'; ?>
<!--close-top-Header-menu-->

<!--sidebar-menu-->
<?php $page='members-entry'; include 'includes/sidebar.php'; ?>
<!--sidebar-menu-->

<div id="content">
    <div id="content-header">
        <div id="breadcrumb"> 
            <a href="#" class="tip-bottom"><i class="fas fa-home"></i> Home</a> 
            <a href="#" class="tip-bottom">Añadir Roles a Usuarios</a> 

        </div>
        <h1>Roles Formulario</h1>
    </div>
    <div class="container-fluid">
        <hr>
        <div class="row-fluid">
            <div class="span6">
                <div class="widget-box">
                    <div class="widget-title"> 
                        <span class="icon"> 
                            <i class="fas fa-align-justify"></i> 
                        </span>
                        <h5>Personal-info</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <form action="add-user-req-rols.php" method="POST" class="form-horizontal">
                
                        <div class="control-group">
                                <label class="control-label">Usuario :</label>
                                <div class="controls">
                                <select name="id_usuario" required="required" id="select">
                                        <?php
                                        // Connect to the database
                                        $conn = mysqli_connect('localhost', 'root', '', 'gymu');
                                        if (!$conn) {
                                            die("Error de conexión: " . mysqli_connect_error());
                                        }

                                        // Query to get user types
                                        $qry = "SELECT nombre_usuario, id_usuario FROM usuarios";
                                        $result = mysqli_query($conn, $qry);

                                        if (mysqli_num_rows($result) > 0) {
                                            // Generate options for the select field
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                echo '<option value="' . $row['id_usuario'] . '">' . $row['nombre_usuario'] . '</option>';
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

                            <!-- Page Access Selection -->
                            <div class="control-group">
                                <label class="control-label">Asignar Páginas :</label>
                                <div class="controls">
                                    <select name="page_access[]" multiple="multiple" required="required">
                                        <!-- Gestionar Usuarios -->
                                        <option value="list-users.php">Listar Todos los Usuarios</option>
                                        <option value="user-entry.php">Formulario de Entrada de Usuarios</option>
                                        <option value="user-rols.php">Asignar Permisos o Roles</option>

                                        <!-- Gestionar Miembros -->
                                        <option value="members.php">Listar Todos los Miembros</option>
                                        <option value="member-entry.php">Formulario de Entrada de Miembros</option>
                                        <option value="archive-member.php">Añadir Archivos</option>
                                        <option value="files.php">Listar Archivos</option>
                                        <option value="member-group-remove.php">Eliminar Grupos y Servicios</option>
                                        <option value="member-group.php">Lista de Miembros por Grupos</option>
                                        <option value="members-attendence.php">Listado de Asistencia</option>
                                        <option value="detalles_miembros.php">Listado de Pagos Miembros</option>

                                        <!-- Ges. Grupos y Servicios -->
                                        <option value="groups.php">Listar Todos los Grupos</option>
                                        <option value="services.php">Listar Todos los Servicios</option>
                                        <option value="group_service.php">Formulario de Entrada</option>

                                        <!-- Gestionar Eventos -->
                                        <option value="event.php">Registro de Entrada</option>
                                        <option value="events.php">Ver Eventos</option>
                                        <option value="persons.php">Ver Personas</option>
                                        <option value="inscripciones.php">Entrada Inscripciones</option>
                                        <option value="inscripciones-list.php">Listado Eventos</option>

                                        <!-- Gestionar Ventas -->
                                        <option value="shop.php">Registro de Entrada (Ventas)</option>
                                        <option value="shops.php">Ver Ventas</option>
                                        <option value="products.php">Ver Productos</option>

                                        <!-- Gestionar Ganancias -->
                                        <option value="egreso-entry.php">Entrada de Egresos</option>
                                        <option value="list-egreso.php">Lista de Egresos</option>
                                    </select>
                                   
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">Estado de Acceso :</label>
                                <div class="controls">
                              
                                <select name="estado" id="estado" required>
                                    <option value="Permitido">Permitido</option>
                                    <option value="Bloqueado">Bloqueado</option>
                                </select>
                                </div>
                            </div>
                          
                            <div class="form-actions">
                                <button type="submit" class="btn btn-success">Actualizar Permisos</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--Footer-part-->
<div class="row-fluid">
    <div id="footer" class="span12"> 
    <div id="footer" class="span12"> <?php echo date("Y");?> &copy; Desarrollado por Union Digital</div>
    </div>
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
  // Function to redirect to a different page
  function goPage (newURL) {
      if (newURL != "") {
          if (newURL == "-" ) {
              resetMenu();            
          } else {  
            document.location.href = newURL;
          }
      }
  }

  // Reset the menu selection upon entry to this page
  function resetMenu() {
     document.gomenu.selector.selectedIndex = 2;
  }
</script>
</body>
</html>

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
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" href="../css/bootstrap.min.css"/>
    <link rel="stylesheet" href="../css/bootstrap-responsive.min.css"/>
    <link rel="stylesheet" href="../css/fullcalendar.css"/>
    <link rel="stylesheet" href="../css/matrix-style.css"/>
    <link rel="stylesheet" href="../css/matrix-media.css"/>
    <link href="../font-awesome/css/fontawesome.css" rel="stylesheet"/>
    <link href="../font-awesome/css/all.css" rel="stylesheet"/>
    <link rel="stylesheet" href="../css/jquery.gritter.css"/>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
</head>
<body>

<style>
    #selectGrupo {
        height: 45px;
    }
</style>

<!--Header-part-->
<div id="header">
    <h1><a href="dashboard.html">Perfect Gym Admin</a></h1>
</div>
<!--close-Header-part-->

<!--top-Header-menu-->
<?php include 'includes/topheader.php' ?>
<!--close-top-Header-menu-->

<!--sidebar-menu-->
<?php $page = 'members-entry'; include 'includes/sidebar.php' ?>
<!--sidebar-menu-->

<div id="content">
    <div id="content-header">
        <div id="breadcrumb">
            <a href="#" class="tip-bottom"><i class="fas fa-home"></i>Inicio</a>
            <a href="#" class="tip-bottom">Administracion de Eventos</a>
            <a href="#" class="current">Inscripciones</a>
        </div>
        <h1>Entrada de Formulario Inscripciones</h1>
    </div>
    <div class="container-fluid">
        <hr>
        <div class="row-fluid">
           

            <div class="span6">
                <div class="widget-box">
                    <div class="widget-title"><span class="icon"><i class="fas fa-align-justify"></i></span>
                        <h5>Inscripcion-info</h5>
                    </div>
                    <div class="widget-content nopadding">
                    <form action="add-inscripciones-req.php" method="POST" class="form-horizontal">

                        <div class="form-horizontal">
                        <div class="control-group">
                                <label class="control-label">Persona :</label>
                                <div class="controls">
                                    <select name="id_persona" required="required" id="select">
                                        <?php
                                        // Connect to the database
                                        $conn = mysqli_connect('localhost', 'root', '', 'gymu');
                                        if (!$conn) {
                                            die("Error de conexión: " . mysqli_connect_error());
                                        }

                                        // Query to get user types
                                        $qry = "SELECT cedula, nombre FROM personas";
                                        $result = mysqli_query($conn, $qry);

                                        if (mysqli_num_rows($result) > 0) {
                                            // Generate options for the select field
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                echo '<option value="' . $row['cedula'] . '">' . $row['nombre'] . '</option>';
                                            }
                                        } else {
                                            echo '<option value="">No hay personas disponibles</option>';
                                        }

                                        // Close the connection
                                        mysqli_close($conn);
                                        ?>
                                    </select>
                                </div>
                            </div>
                        <div class="control-group">
                                <label class="control-label">Fecha del Evento :</label>
                                <div class="controls">
                                    <input type="date" name="fecha_viaje" class="span11" required/>
                                    <span class="help-block">Fecha del Evento</span>
                                </div>
                            </div>
                           
                            <div class="control-group">
                                <label class="control-label">Tipo de Pago :</label>
                                <div class="controls">
                                <select name="id_tipo" required="required" id="selectTipoPago">
                                <option value="">Seleccione una cuota</option>
                                        <?php
                                        // Connect to the database
                                        $conn = mysqli_connect('localhost', 'root', '', 'gymu');
                                        if (!$conn) {
                                            die("Error de conexión: " . mysqli_connect_error());
                                        }

                                        // Query to get user types
                                        $qry = "SELECT id, nombre FROM tipo_pago";
                                        $result = mysqli_query($conn, $qry);

                                        if (mysqli_num_rows($result) > 0) {
                                            // Generate options for the select field
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                echo '<option value="' . $row['id'] . '">' . $row['nombre'] . '</option>';
                                            }
                                        } else {
                                            echo '<option value="">No hay tipo de pagos disponibles</option>';
                                        }

                                        // Close the connection
                                        mysqli_close($conn);
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="control-group" id="cuotasDiv" style="display: none;">
    <label class="control-label">Cuotas:</label>
    <div class="controls">
        <select name="cuotas" required>
            <option value="">Seleccione una cuota</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
        </select>
    </div>
</div>


                        </div>

                        <div class="widget-title"><span class="icon"><i class="fas fa-align-justify"></i></span>
                            <h5>Detalles del Evento</h5>
                        </div>
                        <div class="widget-content nopadding">
                            <div class="form-horizontal">
                                <div class="control-group">
                                    <label class="control-label">Eventos :</label>
                                    <div class="controls">
                                        <select name="evento-pagos" required="required" id="selectTarifa">
                                            <?php
                                            $conn = mysqli_connect('localhost', 'root', '', 'gymu');
                                            if (!$conn) {
                                                die("Error de conexión: " . mysqli_connect_error());
                                            }
                                            $query = "SELECT id, nombre, costo FROM eventos";
                                            $result = mysqli_query($conn, $query);
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                echo "<option value='" . $row['id'] . "' data-precio='" . $row['costo'] . "'>" . $row['nombre'] . "</option>";
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
                                            <input type="text" placeholder="" name="pago" class="span11" readonly>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-actions text-center">
                                    <button type="submit" class="btn btn-success">Registrar Inscripcion</button>
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
    <div id="footer" class="span12"> <?php echo date("Y"); ?> &copy; Desarrollado por Union Digital</div>
</div>

<style>
    #footer {
        color: white;
    }
</style>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
 
 $(document).ready(function () {
    // Escucha el cambio de selección en el select de tipo de pago
    $('select[name="id_tipo"]').change(function () {
        var selectedValue = $(this).val();
        
        // Verifica si se seleccionó "Cuotas" (asumiendo que el valor para "Cuotas" es "2")
        if (selectedValue === "2") { // Cambia "2" por el valor correcto si es diferente
            $('#cuotasDiv').show(); // Muestra el div de cuotas
        } else {
            $('#cuotasDiv').hide(); // Oculta el div de cuotas
        }

        // Actualiza el total al cambiar el método de pago
        updateTotal();
    });

    // Escucha el cambio de selección en el select de eventos
    $('#selectTarifa').change(function () {
        // Actualiza el campo total con el costo del evento seleccionado
        updateTotal();
    });

    // Función para actualizar el total
    function updateTotal() {
        var selectedOption = $('#selectTarifa').find('option:selected');
        var precioEvento = selectedOption.data('precio');
        var tipoPago = $('select[name="id_tipo"]').val();
        var cuotas = $('select[name="cuotas"]').val();

        if (tipoPago === "2" && cuotas) { // Si es por cuotas y hay una cantidad seleccionada
            var totalCuotas = precioEvento / cuotas; // Calcula el total por cuota
            $('input[name="pago"]').val(totalCuotas.toFixed(2)); // Muestra el precio con 2 decimales
        } else {
            $('input[name="pago"]').val(precioEvento.toFixed(2)); // Muestra el precio completo
        }
    }
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

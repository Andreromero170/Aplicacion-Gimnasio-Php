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
<!-- Visit codeastro.com for more projects -->
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

<!--sidebar-menu-->
  <?php $page='members-entry'; include 'includes/sidebar.php'?>
<!--sidebar-menu-->
<div id="content">
<div id="content-header">
  <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="fas fa-home"></i> Home</a> <a href="#" class="tip-bottom">Administracion de Usuarios</a> <a href="#" class="current">Añadir Usuarios</a> </div>
  <h1>Formulario de Miembros</h1>
</div>

    <form role="form" action="index.php" method="POST">
    <?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Recoger y validar los datos del formulario
  $nombre_completo = isset($_POST["nombre_completo"]) ? trim($_POST["nombre_completo"]) : '';
  $genero = isset($_POST["genero"]) ? trim($_POST["genero"]) : '';
  $fecha_registro = isset($_POST["dor"]) ? trim($_POST["dor"]) : '';
  $precio = isset($_POST["precio"]) ? trim($_POST["precio"]) : '';
  $direccion = isset($_POST["direccion"]) ? trim($_POST["direccion"]) : '';
  $contacto = isset($_POST["contacto"]) ? trim($_POST["contacto"]) : '';
  $grupo = isset($_POST["grupo"]) ? $_POST["grupo"] : array();
  $nivel_aptitud = isset($_POST["nivel_fisico"]) ? trim($_POST["nivel_fisico"]) : '';
  $patologias = isset($_POST["patologias"]) ? trim($_POST["patologias"]) : '';
  $tarifas = isset($_POST["tarifas"]) ? $_POST["tarifas"] : array();

  // Verificar que todos los campos requeridos no estén vacíos
  $campos_faltantes = array();

  // Campos individuales
  $campos_individuales = array(
      "nombre_completo" => $nombre_completo,
      "genero" => $genero,
      "fecha_registro" => $fecha_registro,
      "precio" => $precio,
      "direccion" => $direccion,
      "contacto" => $contacto,
      "nivel_aptitud" => $nivel_aptitud,
      "patologias" => $patologias
  );

  foreach ($campos_individuales as $campo => $valor) {
      if (empty(trim($valor))) {
          $campos_faltantes[] = $campo;
      }
  }

  // Verificar que los arrays no estén vacíos
  if (empty($grupo) || !is_array($grupo)) {
      $campos_faltantes[] = 'grupo';
  }

  if (empty($tarifas) || !is_array($tarifas)) {
      $campos_faltantes[] = 'tarifas';
  }

  // Imprimir resultados
  if (!empty($campos_faltantes)) {
      echo "<div class='container-fluid'>";
      echo "<div class='error_ex'>";
      echo "<h1 style='color:maroon;'>Error</h1>";
      echo "<h3>Faltan los siguientes campos o están vacíos:</h3>";
      echo "<ul>";
      foreach ($campos_faltantes as $campo) {
          echo "<li>$campo</li>";
      }
      echo "</ul>";
      echo "<a class='btn btn-warning btn-big' href='members-entry.php'>Go Back</a>";
      echo "</div>";
      echo "</div>";
  } else {
      // Conexión a la base de datos
      $conn = new mysqli('localhost', 'root', '', 'gymu');
      if ($conn->connect_error) {
          die("Error de conexión: " . $conn->connect_error);
      }

      // Ejemplo de inserción en la base de datos para el grupo y tarifas
      $fecha_pago = date("Y-m-d"); // Usamos la fecha actual
      $ano_pago = date('Y'); // Año actual
      $estado = 'Activo'; // Estado por defecto

      // Consulta SQL para insertar los datos en la tabla miembros
      $qry = "INSERT INTO miembros (nombre_completo, genero, fecha_registro, precio, fecha_pago, ano_pago, direccion, contacto, estado, nivel_aptitud, patologias)
              VALUES ('$nombre_completo', '$genero', '$fecha_registro', '$precio', '$fecha_pago', '$ano_pago', '$direccion', '$contacto', '$estado', '$nivel_aptitud', '$patologias')";

      if ($conn->query($qry) === TRUE) {
          $miembro_id = $conn->insert_id; // Obtener el ID del nuevo miembro
          $miembro_id = $conn->insert_id; // Obtener el ID del nuevo miembro

          // Insertar los grupos en la tabla intermedia
          foreach ($grupo as $id_grupo) {
              $qry_grupo = "INSERT INTO miembro_grupo (id_usuario, id_grupo) VALUES ('$miembro_id', '$id_grupo')";
              $conn->query($qry_grupo);
          }

          // Insertar las tarifas en la tabla intermedia
          foreach ($tarifas as $id_tarifa) {
              $qry_tarifa = "INSERT INTO miembro_tarifa (id_usuario, id) VALUES ('$miembro_id', '$id_tarifa')";
              $conn->query($qry_tarifa);
          }

          // Mensaje de éxito
          echo "<div class='container-fluid'>";
          echo "<div class='error_ex'>";
          echo "<h1>Éxito</h1>";
          echo "<h3>¡Los detalles del miembro han sido añadidos!</h3>";
          echo "<a class='btn btn-inverse btn-big' href='members.php'>Ir al Listado</a>";
          echo "</div>";
          echo "</div>";
      } else {
          echo "<div class='container-fluid'>";
          echo "<div class='error_ex'>";
          echo "<h1 style='color:maroon;'>Error</h1>";
          echo "<h3>Error al registrar el miembro. Por favor, intenta de nuevo.</h3>";
          echo "<a class='btn btn-warning btn-big' href='members-entry.php'>Go Back</a>";
          echo "</div>";
          echo "</div>";
      }

      $conn->close();
  }
}


    ?>
</form>


</div>


<!--end-main-container-part-->

<!--Footer-part-->
<!-- Visit codeastro.com for more projects -->
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

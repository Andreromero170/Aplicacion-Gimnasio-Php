<?php
session_start();
// Verificar si el usuario ha iniciado sesión
if(!isset($_SESSION['user_id'])){
  header('location:../index.php');
  exit();	
}
?>
<!DOCTYPE html>
<html lang="es">
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
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
</head>
<body>
  <!-- Header -->
  <div id="header">
    <h1><a href="dashboard.html">Perfect Gym Admin</a></h1>
  </div>

  <!-- Top header menu -->
  <?php include 'includes/topheader.php'?>

  <!-- Sidebar -->
  <?php $page='members-entry'; include 'includes/sidebar.php'?>

  <div id="content">
    <div id="content-header">
      <div id="breadcrumb"> 
        <a href="#" class="tip-bottom"><i class="fas fa-home"></i> Home</a> 
        <a href="#" class="tip-bottom">Administración de Usuarios</a> 
      </div>
      <h1>Formulario de Actualización de Usuario</h1>
    </div>
    
    <form role="form" action="edit-user.php" method="POST">
      <?php 
      $user_id = $_GET['id'];

      // Verificar si se ha enviado el formulario
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
          $usuario = $_POST["usuario"] ?? '';
          $contrasena = $_POST["contrasena"] ?? '';
          $id_tipo = $_POST["id_tipo"] ?? '';
        

          // Validación básica
          if (empty($usuario) || empty($contrasena) || empty($id_tipo)) {
              echo "<script>
                      Swal.fire({
                        icon: 'warning',
                        title: 'Campos incompletos',
                        text: 'Por favor, complete todos los campos requeridos.',
                      }).then(function() {
                        window.history.back();
                      });
                    </script>";
          } else {
              // Conectar a la base de datos
              $conn = new mysqli('localhost', 'root', '', 'gymu');

              // Verificar la conexión
              if ($conn->connect_error) {
                  die("Error de conexión: " . $conn->connect_error);
              }

              // Preparar la consulta de actualización
              $stmt = $conn->prepare("UPDATE usuarios SET nombre_usuario = ?, contrasena = ?, id_tipo = ? WHERE id_usuario = ?");
              
              // Verificar que la preparación sea exitosa
              if ($stmt) {
                  // Asignar parámetros a la consulta
                  $stmt->bind_param("ssii", $usuario, $contrasena, $id_tipo, $user_id);
                  
                  // Ejecutar la consulta
                  if ($stmt->execute()) {
                      // Mensaje de éxito con SweetAlert
                      echo "<script>
                              Swal.fire({
                                icon: 'success',
                                title: 'Actualización exitosa',
                                text: 'Usuario actualizado correctamente.',
                              }).then(function() {
                                window.location.href = 'list-users.php';
                              });
                            </script>";
                  } else {
                      // Mostrar mensaje de error si la consulta falla
                      echo "<script>
                              Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Error al actualizar los detalles. Intente de nuevo.',
                              }).then(function() {
                                window.history.back();
                              });
                            </script>";
                  }
                  // Cerrar la declaración
                  $stmt->close();
              } else {
                  echo "Error en la preparación de la consulta: " . $conn->error;
              }

              // Cerrar la conexión
              $conn->close();
          }
      } else {
          echo "<h3>NO ESTÁ AUTORIZADO A REDIRIGIR ESTA PÁGINA. VOLVER A <a href='index.php'> DASHBOARD </a></h3>";
      }
      ?>
    </form>
  </div>

  <!-- Footer -->
  <div class="row-fluid">
    <div id="footer" class="span12"> <?php echo date("Y");?> &copy; Desarrollado por UnionDigital</div>
  </div>

  <style>
    #footer {
      color: white;
    }
  </style>

  <!-- JS Scripts -->
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
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>

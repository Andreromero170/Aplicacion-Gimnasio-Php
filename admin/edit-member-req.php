<?php
session_start();
if (!isset($_SESSION['user_id'])) {
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

<?php $page='members-entry'; include 'includes/sidebar.php'; ?>

<div id="content">
    <div id="content-header">
        <div id="breadcrumb">
            <a href="index.html" title="Go to Home" class="tip-bottom"><i class="fas fa-home"></i> Home</a>
            <a href="#" class="tip-bottom">Administracion de Usuarios</a>
            <a href="#" class="current">Modificar Miembros</a>
        </div>
        <h1>Formulario de Miembros</h1>
    </div>

    <form role="form" action="index.php" method="POST">
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
          $user_id = $_GET['id'];
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

            // Verificar si el miembro ya existe en la base de datos
            $conn = new mysqli('localhost', 'root', '', 'gymu');
            if ($conn->connect_error) {
                die("Error de conexión: " . $conn->connect_error);
            }

            if ($user_id > 0) {
                // El miembro ya existe, actualizar los datos
                $qry_update = "UPDATE miembros SET 
                    nombre_completo='$nombre_completo', 
                    genero='$genero', 
                    fecha_registro='$fecha_registro', 
                    precio='$precio', 
                    direccion='$direccion', 
                    contacto='$contacto', 
                    nivel_aptitud='$nivel_aptitud', 
                    patologias='$patologias' 
                    WHERE id_usuario='$user_id'";

                if ($conn->query($qry_update) === TRUE) {
                    // Actualizar grupos y tarifas
                    $conn->query("DELETE FROM miembro_grupo WHERE id_usuario='$user_id'");
                    foreach ($grupo as $id_grupo) {
                        $conn->query("INSERT INTO miembro_grupo (id_usuario, id_grupo) VALUES ('$user_id', '$id_grupo')");
                    }

                    $conn->query("DELETE FROM miembro_tarifa WHERE id_usuario='$user_id'");
                    foreach ($tarifas as $id_tarifa) {
                        $conn->query("INSERT INTO miembro_tarifa (id_usuario, id) VALUES ('$user_id', '$id_tarifa')");
                    }
                    echo "<div class='container-fluid'>
                    <div class='row-fluid'>
                      <div class='span12'>
                        <div class='widget-box'>
                          <div class='widget-title'>
                            <span class='icon'> <i class='fas fa-info'></i> </span>
                            <h5>Mensaje</h5>
                          </div>
                          <div class='widget-content'>
                            <div class='error_ex'>
                              <h1>Exitoso</h1>
                              <h3>Miembro Actualizado Correctamente!</h3>
                              <p>Se actualizaron los datos solicitados. Haga clic en el botón para volver atrás.</p>
                              <a class='btn btn-inverse btn-big'  href='members.php'>Ir al Listado</a> 
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>";
              
                } else {
                    echo "<div class='container-fluid'>
                    <div class='row-fluid'>
                      <div class='span12'>
                        <div class='widget-box'>
                          <div class='widget-title'>
                            <span class='icon'> <i class='fas fa-info'></i> </span>
                            <h5>Mensaje de Error</h5>
                          </div>
                          <div class='widget-content'>
                            <div class='error_ex'>
                              <h1 style='color:maroon;'>Error 404</h1>
                              <h3>Error al actualizar los detalles</h3>
                              <p>Intente de nuevo.</p>
                              <a class='btn btn-warning btn-big'  href='edit-memberform.php'>Atrás</a> 
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>";

                }
            } else {
                // Código para inserción si es necesario (en tu caso esto ya estaba cubierto)
            }

            $conn->close();
        }
        ?>
    </form>
</div>

<!--Footer-part-->
<div class="row-fluid">
    <div id="footer" class="span12"> <?php echo date("Y");?> &copy; Desarrollado por Union Digital</div>
</div>
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
</body>
</html>

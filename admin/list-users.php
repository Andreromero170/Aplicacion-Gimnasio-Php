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



$conn = mysqli_connect('localhost', 'root', '', 'gymu');
if (!$conn) {
    die("Error de conexión: " . mysqli_connect_error());
}

$search = ''; // Inicializar la variable de búsqueda

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['search'])) {
    $search = mysqli_real_escape_string($conn, $_POST['search']); // Escapar caracteres especiales
}

// Consulta para obtener los usuarios y sus tipos, con búsqueda opcional
$qry = "
    SELECT u.id_usuario, u.nombre_usuario, t.tipo AS nombre_tipo, u.suspendido
    FROM usuarios u
    JOIN tipos_usuarios t ON u.id_tipo = t.id_tipo
";

if (!empty($search)) {
    // Agregar filtro de búsqueda
    $qry .= " WHERE u.nombre_usuario LIKE '%$search%'";
}

$result = mysqli_query($conn, $qry);
$cnt = 1;
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
<!--close-top-Header-menu-->

<!--sidebar-menu-->
<?php $page='users'; include 'includes/sidebar.php'?>
<!--sidebar-menu-->

<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="#" class="tip-bottom"><i class="fas fa-home"></i> Home</a> <a href="#" class="current">Listar Usuarios</a> </div>
    <h1 class="text-center">Administrar Usuarios <i class="fas fa-users"></i></h1>
  </div>
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="span12">

      <div class='widget-box'>
          <div class='widget-title'> <span class='icon'> <i class='fas fa-th'></i> </span>
            <h5>Tabla Usuarios</h5>
            <form id="custom-search-form" role="search" method="POST" action="" class="form-search form-horizontal pull-right">
                <div class="input-append span12">
                    <input type="text" class="search-query" placeholder="Search" name="search" value="<?php echo htmlspecialchars($search); ?>" required>
                    <button type="submit" class="btn"><i class="fas fa-search"></i></button>
                </div>
            </form>
          </div>
          
          <div class='widget-content nopadding'>
            <table class='table table-bordered data-table table-hover'>
              <thead>
                <tr>
                  <th>#</th>
                  <th>Usuario</th>
                  <th>Tipo de Usuario</th>
                  <th>Estado</th>
                  <th>Acción</th>
                </tr>
              </thead>
              <tbody>
                <?php while ($row = mysqli_fetch_array($result)) { ?>
                <tr>
                  <td><div class='text-center'><?php echo $cnt; ?></div></td>
                  <td><div class='text-center'><?php echo $row['nombre_usuario']; ?></div></td>
                  <td><div class='text-center'><?php echo $row['nombre_tipo']; ?></div></td>
                  <td><div class='text-center'>
                    <?php echo ($row['suspendido'] == 1 ? "<span class='label label-danger'>Suspendido</span>" : "<span class='label label-success'>Activo</span>"); ?>
                  </div></td>
                  <td>
                    <div class='text-center'>
                      <?php if ($row['suspendido'] == 1) { ?>
                        <a href='reactivate.php?id=<?php echo $row['id_usuario']; ?>'><button class='btn btn-success btn'><i class='fas fa-check'></i> Reactivar</button></a>
                      <?php } else { ?>
                        <a href='suspend.php?id=<?php echo $row['id_usuario']; ?>'><button class='btn btn-danger btn'><i class='fas fa-ban'></i> Suspender</button></a>
                      <?php } ?>
                      <a href='edit-userform.php?id=<?php echo $row['id_usuario']; ?>'><button class='btn btn-warning btn'><i class='fas fa-edit'></i> Editar</button></a>
                      <a href='actions/delete-usuario.php?id=<?php echo $row['id_usuario']; ?>'><button class='btn btn-delete btn'><i class='fas fa-trash'></i> Eliminar</button></a>
    
                    </div>
                  </td>
                </tr>
                <?php $cnt++; } ?>
              </tbody>
            </table>
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
<!--end-Footer-part-->

<style>
    #custom-search-form {
        margin:0;
        margin-top: 5px;
        padding: 0;
    }
 
    #custom-search-form .search-query {
        padding-right: 3px;
        padding-right: 4px \9;
        padding-left: 3px;
        padding-left: 4px \9;
        /* IE7-8 doesn't have border-radius, so don't indent the padding */
 
        margin-bottom: 0;
        -webkit-border-radius: 3px;
        -moz-border-radius: 3px;
        border-radius: 3px;
    }
 
    #custom-search-form button {
        border: 0;
        background: none;
        /** belows styles are working good */
        padding: 2px 5px;
        margin-top: 2px;
        position: relative;
        left: -28px;
        /* IE7-8 doesn't have border-radius, so don't indent the padding */
        margin-bottom: 0;
        -webkit-border-radius: 3px;
        -moz-border-radius: 3px;
        border-radius: 3px;
    }
 
    .search-query:focus + button {
        z-index: 3;   
    }
</style>

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

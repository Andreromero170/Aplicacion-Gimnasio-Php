<?php
session_start();
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
</head>
<body>

<div id="header">
  <h1><a href="dashboard.html">Perfect Gym Admin</a></h1>
</div>

<?php include 'includes/topheader.php'?>
<?php $page='members-entry'; include 'includes/sidebar.php'?>

<div id="content">
<div id="content-header">
  <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="fas fa-home"></i> Home</a> <a href="#" class="tip-bottom">Administración de Usuarios</a> <a href="#" class="current">Añadir Usuarios</a> </div>
  <h1>Formulario de Usuarios</h1>
</div>
<form role="form" action="index.php" method="POST">
  <?php 

$conn = new mysqli('localhost', 'root', '', 'gymu');
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

$stmt = $conn->prepare("SELECT estado_acceso FROM permisos_usuarios WHERE id_usuario = ? AND enlace_pagina = ?");
$stmt->bind_param("is", $id_usuario, $pagina);
$stmt->execute();
$result = $stmt->get_result();
$estado_acceso = $result->fetch_assoc()['estado_acceso'];

$stmt->close();
$conn->close();

$paginas = [
    "Usuarios" => [
        "list-users.php" => "Listar Todos los Usuarios",
        "user-entry.php" => "Formulario de Entrada de Usuarios",
        "user-rols.php" => "Asignar Permisos o Roles"
    ],
    "Miembros" => [
        "members.php" => "Listar Todos los Miembros",
        "member-entry.php" => "Formulario de Entrada de Miembros",
        "archive-member.php" => "Añadir Archivos",
        "files.php" => "Listar Archivos",
        "member-group-remove.php" => "Eliminar Grupos y Servicios",
        "member-group.php" => "Lista de Miembros por Grupos",
        "members-attendence.php" => "Listado de Asistencia",
        "detalles_miembros.php" => "Listado de Pagos Miembros"
    ],
    "Grupos y Servicios" => [
        "groups.php" => "Listar Todos los Grupos",
        "services.php" => "Listar Todos los Servicios",
        "group_service.php" => "Formulario de Entrada"
    ],
    "Eventos" => [
        "event.php" => "Registro de Entrada",
        "events.php" => "Ver Eventos",
        "persons.php" => "Ver Personas",
        "inscripciones.php" => "Entrada Inscripciones",
        "inscripciones-list.php" => "Listado Eventos"
    ],
    "Ventas" => [
        "shop.php" => "Registro de Entrada (Ventas)",
        "shops.php" => "Ver Ventas",
        "products.php" => "Ver Productos"
    ],
    "Ganancias" => [
        "egreso-entry.php" => "Entrada de Egresos",
        "list-egreso.php" => "Lista de Egresos"
    ]
];

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = $_POST["usuario"] ?? '';
    $contrasena = $_POST["contrasena"] ?? '';
    $id_tipo = $_POST["id_tipo"] ?? '';

    if (empty($usuario) || empty($contrasena) || empty($id_tipo)) {
        echo "<script>
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Por favor, complete todos los campos requeridos.'
        }).then((result) => {
            if (result.isConfirmed) {
                window.history.back();
            }
        });
    </script>";
    } else {
        $conn = new mysqli('localhost', 'root', '', 'gymu');
        if ($conn->connect_error) {
            die("Error de conexión: " . $conn->connect_error);
        }

        $stmt_check = $conn->prepare("SELECT * FROM usuarios WHERE nombre_usuario = ?");
        $stmt_check->bind_param("s", $usuario);
        $stmt_check->execute();
        $result_check = $stmt_check->get_result();

        if ($result_check->num_rows > 0) {
            echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'El nombre de usuario ya está registrado. Por favor, elija otro.'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.history.back();
                }
            });
        </script>";
        } else {
            $stmt = $conn->prepare("INSERT INTO usuarios (nombre_usuario, contrasena, id_tipo) VALUES (?, ?, ?)");
            $stmt->bind_param("ssi", $usuario, $contrasena, $id_tipo);

            if ($stmt->execute()) {
                $user_id = $stmt->insert_id;

                foreach ($paginas as $categoria => $paginas_enlace) {
                    foreach ($paginas_enlace as $enlace => $descripcion) {
                        $estado_acceso = 'Bloqueado';
                        if ($id_tipo == 1) { 
                            $estado_acceso = 'Permitido';
                        } elseif ($id_tipo == 2 && in_array($enlace, ["member-group.php", "detalles_grupo.php"])) {
                            $estado_acceso = 'Permitido';
                        } elseif ($id_tipo == 3 && in_array($enlace, ["member-group.php", "detalles_grupo.php"])) {
                            $estado_acceso = 'Permitido';
                        }

                        $stmt_permiso = $conn->prepare("INSERT INTO permisos_usuarios (id_usuario, enlace_pagina, estado_acceso) VALUES (?, ?, ?)");
                        $stmt_permiso->bind_param("iss", $user_id, $enlace, $estado_acceso);
                        $stmt_permiso->execute();
                    }
                }

                echo "<div class='container-fluid'>
                        <div class='row-fluid'>
                        <div class='span12'>
                        <div class='widget-box'>
                        <div class='widget-title'> <span class='icon'> <i class='fas fa-info'></i> </span>
                            <h5>Mensaje</h5>
                        </div>
                        <div class='widget-content'>
                            <div class='error_ex'>
                            <h1>Exitoso</h1>
                            <h3>Usuario Registrado Correctamente!</h3>
                            <p>Se añadieron los datos solicitados. Haga clic en el botón para volver atrás.</p>
                            <a class='btn btn-inverse btn-big' href='list-users.php'>Ir al Listado</a>
                            </div>
                        </div>
                        </div>
                        </div>
                        </div>
                      </div>";
            }
        }
        $stmt_check->close();
        $conn->close();
    }
  } else {
      echo "<h3>NO ESTÁ AUTORIZADO A REDIRIGIR ESTA PÁGINA. VOLVER A <a href='index.php'> DASHBOARD </a></h3>";
  }
  ?>
</form>
</div>
</div>

<div class="row-fluid">
<div id="footer" class="span12"> <?php echo date("Y");?> &copy; Desarrollado por Union Digital</div>
</div>

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

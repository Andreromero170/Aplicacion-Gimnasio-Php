<?php
session_start();
// Check if the user is already logged in
if (!isset($_SESSION['user_id'])) {
    header('location:../index.php');    
}

// Connect to the database
$conn = mysqli_connect('localhost', 'root', '', 'gymu');
if (!$conn) {
    die("Error de conexión: " . mysqli_connect_error());
}

$id_grupo = $_GET['id_grupo'];

// Get the group name
$qry_group = "SELECT nombre_grupo FROM grupos WHERE id_grupo = $id_grupo";
$result_group = mysqli_query($conn, $qry_group);
$group_name = '';

if ($row_group = mysqli_fetch_array($result_group)) {
    $group_name = $row_group['nombre_grupo'];
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

<style>
.table > tbody > tr > td:nth-child(1) {
    width: 40px; /* Cambia este valor al ancho que desees */
}


.table > tbody > tr > td > .input-casilla {
    height: 25px; /* Ajusta la altura del input */
    width: 100px;  /* Ajusta el ancho del input */
    text-align: center; /* Alineación del texto dentro del input */
    font-size: 16px; /* Aumenta el tamaño de la fuente para hacer el texto más grande */
    padding: 10px;  /* Agrega espacio dentro del input para hacerlo más espacioso */
}

    /* Ajustes para pantallas pequeñas */
@media (max-width: 768px) {
    .input-append {
        width: 100%;
    }

    
    .input-append > .search-query{
        width:340px;
    }
   
    .input-append .btn{
margin-right:2px;

    }


    .btn-group {
        width: 100%;
    }

    .btn-group > button{
    width:133px;
    }

  
    
}

</style>
<!--Header-part-->
<div id="header">
    <h1><a href="dashboard.html">Perfect Gym Admin</a></h1>
</div>

<!--top-Header-menu-->
<?php include 'includes/topheader.php' ?>

<!--sidebar-menu-->
<?php $page='members-update'; include 'includes/sidebar.php' ?>

<div id="content">
    <div id="content-header">
        <div id="breadcrumb">
            <a href="#" title="Go to Home" class="tip-bottom"><i class="fas fa-home"></i>Inicio</a>
            <a href="#" class="current">Miembros Registrados</a>
        </div>
        <h1 class="text-center">Lista de Miembros Registrados - Grupo: <strong><?php echo $group_name; ?></strong> <i class="fas fa-users"></i></h1>
    </div>
    <div class="container-fluid">
        <hr>
        <div class="row-fluid">
            <div class="span12">
                <div class='widget-box'>
                    <div class='widget-title'> 
                        <span class='icon'> <i class='fas fa-th'></i> </span>
                        <h5>Tabla de Miembros Por Grupos</h5>
                       <div>
                       </div>
       
                     
                    </div>
                    <div class="col-3 col-md-2 mb-1">
    <form id="custom-search-form" role="search" method="POST" action="search-result-group.php?id_grupo=<?php echo $id_grupo; ?>" class="form-search form-horizontal pull-right">
                            <div class="input-append span12">
                                <input type="text" class="search-query" placeholder="Buscar Miembro" name="search" required>
                                <button type="submit" class="btn"><i class="fas fa-search"></i></button>
                            </div>
                        </form>
        <div class="btn-group btn-group-justified d-flex" role="group">
        <form method='POST' action='attendance-group.php'>
        <input type='hidden' name='id_grupo' value='<?php echo $id_grupo; ?>'>
       
            
           
        </div>
    </div>
        

                    <?php
                    $search_term = isset($_POST['search']) ? $_POST['search'] : '';

                    // Connect to the database
$conn = mysqli_connect('localhost', 'root', '', 'gymu');
if (!$conn) {
    die("Error de conexión: " . mysqli_connect_error());
}
              
$search_term = isset($_POST['search']) ? $_POST['search'] : '';
$qry = "SELECT m.id_usuario, m.nombre_completo, m.estado_pago FROM miembros m 
        JOIN miembro_grupo gm ON m.id_usuario = gm.id_usuario 
        WHERE gm.id_grupo = $id_grupo 
        AND m.nombre_completo LIKE '%$search_term%'";

                    $result = mysqli_query($conn, $qry);

                    echo "<div class='table-responsive'>";
                    echo " <select name='id_usuarios[".$row['id_usuario']."]' class='form-control'>
                                            <option value='pendiente' ".($row['estado_pago'] == 'pendiente' ? 'selected' : '').">Pendiente</option>
                                            <option value='pago' ".($row['estado_pago'] == 'pago' ? 'selected' : '').">Pago</option>
                                        </select>";
                    echo "<table class='table table-striped table-bordered table-hover'>
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nombre Completo</th>
                                    <th>Estado de Pago</th>
                                </tr>
                            </thead>";

                    $cnt = 1;
                    while ($row = mysqli_fetch_array($result)) {
                        echo "<tbody> 
                                <tr>

                                    <td class='text-center'> <input type='checkbox' class = 'input-casilla' name='id_usuarios[]' value='".$row['id_usuario']."'></td>
                                    <td class='text-center'>".$row['nombre_completo']."</td>
                                                               
                                    
                                </tr>
                              </tbody>";
                        $cnt++;  
                    }
                    echo "</table> </form>";
                    
                    echo "</div>";
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Footer-part -->
<div class="row-fluid">
    <div id="footer" class="span12 text-center"> <?php echo date("Y"); ?> &copy; Desarrollado por Union Digital</div>
</div>

<style>
#footer {
    color: white;
    background-color: #2f2f2f;
    padding: 10px;
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

<script type="text/javascript">
function goPage(newURL) {
    if (newURL != "") {
        if (newURL == "-") {
            resetMenu();            
        } else {  
            document.location.href = newURL;
        }
    }
}

function resetMenu() {
   document.gomenu.selector.selectedIndex = 2;
}



</script>
</body>
</html>


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

$id_grupo = isset($_GET['id_grupo']) ? intval($_GET['id_grupo']) : 0;

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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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



.container-select  select{
    margin-top:10px;
    margin-left:2px;
 }

 .container2 .input-append {
   margin-left:-10px;
   margin-top:-40px;

}

select{
    width: 350px;
    display: inline-block;
}

/* Ajustes para pantallas pequeñas */
@media (max-width: 768px) {

    .container-select{
        float: none;
        margin-bottom:-20px;
    }
    .input-append {
        width: 100%;
    }
    

    select {
        width: 310px;
    }

    .input-append .btn {
        margin-right: 2px;
      
    }

    .btn-group {
        width: 100%;
    }

    .btn-group > button {
        width: 133px;
    }

    .container2{
        height:70px;
    }

    select{
        margin-top:5px;
    }

    .btn{
        margin-bottom:1px;
    }

    .search-query{
    margin-top:42px;
    margin-right:148px;   
    }
.btn-query{
    margin-top:42px;
}  

.container2 .input-append input{
   width:330px;
   margin-right:2px;
}

}






</style>

<!--Header-part-->
<div id="header">
    <h1><a href="dashboard.html">Perfect Gym Admin</a></h1>
</div>

<!--top-Header-menu-->
<?php include 'includes/topheader.php'; ?>

<!--sidebar-menu-->
<?php $page='members-update'; include 'includes/sidebar.php'; ?>

<div id="content">
    <div id="content-header">
        <div id="breadcrumb">
            <a pxhref="#" title="Go to Home" class="tip-bottom"><i class="fas fa-home"></i> Inicio</a>
            <a href="#" class="current">Miembros Registrados</a>
        </div>
        <h1 class="text-center">Lista de Miembros Registrados - Grupo: <strong><?php echo htmlspecialchars($group_name); ?></strong> <i class="fas fa-users"></i></h1>
    </div>
    <div class="container-fluid">
        <hr>
        <div class="row-fluid">
            <div class="span12">
                <div class='widget-box'>
                    <div class='widget-title'> 
                        <span class='icon'> <i class='fas fa-th'></i> </span>
                        <h5>Tabla de Miembros Por Grupos</h5>
                    </div>
                    <div class="container2 col-3 col-md-2">
                       
                    <div class="input-append span12">
                        
                      
                        <form id="custom-search-form" role="search" method="POST" class="form-search form-horizontal pull-right">
             
                    <input type="text" class="search-query" placeholder="Buscar Miembro" name="search" required>
                    <button type="submit" class="btn btn-query"><i class="fas fa-search"></i></button>
                    </form>
                </div>
                    <div class="container-select">

                    <?php $id_grupo = $_GET['id_grupo']?>
                    <form action="cambiar_estado_pago.php?id_grupo=<?php echo $id_grupo; ?>" method="post">

                            <input type='hidden' name='id_usuarios[]' value='<?php echo $row['id_usuario']; ?>'>

                        <select id='estado_pago_<?php echo $row['id_usuario']; ?>' name='estado_pago' class='form-control'>
                                            <option value='Pendiente' " . ($row['estado_pago'] == 'Pendiente' ? 'selected' : '') . ">Pendiente</option>
                                            <option value='Pagado' " . ($row['estado_pago'] == 'Pagado' ? 'selected' : '') . ">Pagado</option>
                                        </select>
                                        <button type='submit' class='btn btn-success' name='cambiar_estado'>Cambiar</button>
                                      
                                    </div>  
                    
                    
                       
                        
                    </div>

                    <?php
                    $search_term = isset($_POST['search']) ? mysqli_real_escape_string($conn, $_POST['search']) : '';

                 $qry = "
                    SELECT 
                        pm.id_usuario,
                        m.nombre_completo,
                        pm.estado_pago,
                        pm.fecha_pago
                    FROM pagos_mensuales pm
                    JOIN miembros m ON pm.id_usuario = m.id_usuario
                    JOIN miembro_grupo gm ON m.id_usuario = gm.id_usuario 
                    WHERE gm.id_grupo = $id_grupo
                    AND m.nombre_completo LIKE '%$search_term%'";
                    
            
                    
                
                    
                    
                    $result = mysqli_query($conn, $qry);

                    if (mysqli_num_rows($result) > 0) {
                        echo "<table class='table table-striped table-bordered table-hover'>
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nombre Completo</th>
                                        <th>Estado del Miembro</th>
                                        <th>Fecha de Pago</th>
                                      
                                    </tr>
                                </thead>
                                <tbody>";

                        while ($row = mysqli_fetch_array($result)) {
                            echo "<tr>
                                    <td class='text-center'><input type='checkbox' class='input-casilla' name='id_usuarios[]' value='" . $row['id_usuario'] . "'></td>
                                    <td class='text-center'>" . htmlspecialchars($row['nombre_completo']) . "</td>
                                 <td class='text-center'>" . htmlspecialchars($row['estado_pago']) . "</td>
                                 <td class='text-center'>" . htmlspecialchars($row['fecha_pago']) . "</td>
                                  </tr>";
                        }
                        echo "</tbody></table></form>";
                    } else {
                        echo "<p class='text-center'>No se encontraron miembros.</p>";
                    }
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

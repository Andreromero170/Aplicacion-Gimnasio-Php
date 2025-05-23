<?php
session_start();
//the isset function to check username is already loged in and stored on the session
if(!isset($_SESSION['user_id'])){
header('location:../index.php');	
}
include "dbcon.php";
$qry="SELECT t.nombre AS servicio, COUNT(*) AS number
FROM miembro_tarifa mt
JOIN miembros m ON mt.id_usuario = m.id_usuario
JOIN tarifas t ON mt.id = t.id
GROUP BY t.nombre;
";
$result=mysqli_query($con,$qry);
$qry="SELECT genero, count(*) as enumber FROM miembros GROUP BY genero;";
$result3=mysqli_query($con,$qry);

?>
<!-- Visit codeastro.com for more projects -->
<!DOCTYPE html>

<html lang="en">
<head>
<title>Sistema de Gimnasio Panel</title>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" href="../css/bootstrap.min.css" />
<link rel="stylesheet" href="../css/bootstrap-responsive.min.css" />
<link rel="stylesheet" href="../css/fullcalendar.css" />
<link rel="stylesheet" href="../css/matrix-style.css" />
<link rel="stylesheet" href="../css/matrix-media.css" />
<link href="../font-awesome/css/all.css" rel="stylesheet" />
<link href="../font-awesome/css/fontawesome.css" rel="stylesheet" />
<link rel="stylesheet" href="../css/jquery.gritter.css" />
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>  
<script type="text/javascript">  
google.charts.load('current', {'packages':['corechart']});  
google.charts.setOnLoadCallback(drawChart);  

function drawChart() {  
     var data = google.visualization.arrayToDataTable([  
               ['Services', 'Number'],  
               <?php  
               while($row = mysqli_fetch_array($result)) {  
                    echo "['".$row["servicio"]."', ".$row["number"]."],";  
               }  
               ?>  
          ]);  
     var options = {  
           pieHole: 0.4,  
     };  
     var chart = new google.visualization.PieChart(document.getElementById('piechart'));  
     chart.draw(data, options);  
}  
</script>


<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
  google.charts.load('current', {'packages':['bar']});
  google.charts.setOnLoadCallback(drawStuff);

  function drawStuff() {
    var data = new google.visualization.DataTable();
    data.addColumn('string', 'Service');
    data.addColumn('number', 'Number');

    <?php
    // Actualiza la consulta SQL para obtener los datos.
    $query = "SELECT t.nombre AS servicio, COUNT(*) AS number
FROM miembro_tarifa mt
JOIN miembros m ON mt.id_usuario = m.id_usuario
JOIN tarifas t ON mt.id = t.id
GROUP BY t.nombre;
";
    $res = mysqli_query($con, $query);

    // Genera los datos para el gráfico.
    while($data = mysqli_fetch_array($res)) {
      $servicio = $data['servicio'];
      $number = $data['number'];
    ?>
    data.addRow(['<?php echo $servicio; ?>', <?php echo $number; ?>]);
    <?php
    }
    ?>

    var options = {
      width: 710,
      legend: { position: 'none' },
      bars: 'vertical', // Required for Material Bar Charts.
      axes: {
        x: {
          0: { side: 'top', label: 'Total'} // Top x-axis.
        }
      },
      bar: { groupWidth: "100%" }
    };

    var chart = new google.charts.Bar(document.getElementById('top_x_div'));
    chart.draw(data, options);
  };
</script>


<script type="text/javascript">
  google.charts.load('current', {'packages':['bar']});
  google.charts.setOnLoadCallback(drawStuff);

  function drawStuff() {
    var data = new google.visualization.DataTable();
    data.addColumn('string', 'Categorias');
    data.addColumn('number', 'Total');

    <?php
    // Consulta para obtener las ganancias totales de la tabla miembros
    $query1 = "SELECT SUM(precio) AS total_earnings FROM miembros";
    $rezz = mysqli_query($con, $query1);
    $earnings = mysqli_fetch_array($rezz)['total_earnings'];
    ?>
    data.addRow(['Ganancias', <?php echo $earnings; ?>]);

    <?php
    // Consulta para obtener los gastos totales de la tabla equipo
    $query10 = "SELECT SUM(precio * cantidad) AS total_expenses FROM equipo";
    $res1000 = mysqli_query($con, $query10);
    $expenses = mysqli_fetch_array($res1000)['total_expenses'];
    ?>
    data.addRow(['Gastos', <?php echo $expenses; ?>]);

    var options = {
      width: 1050,
      legend: { position: 'none' },
      bars: 'horizontal', // Required for Material Bar Charts.
      axes: {
        x: {
          0: { side: 'top', label: 'Total'} // Top x-axis.
        }
      },
      bar: { groupWidth: "100%" }
    };

    var chart = new google.charts.Bar(document.getElementById('top_y_div'));
    chart.draw(data, options);
  };
</script>

<script type="text/javascript">
  google.charts.load("current", {packages:["corechart"]});
  google.charts.setOnLoadCallback(drawChart);

  function drawChart() {
    var data = google.visualization.arrayToDataTable([  
      ['Gender', 'Number'],  
      <?php  
      // Suponiendo que $result3 es el resultado de ejecutar la consulta SQL
      $qry="SELECT genero, count(*) as enumber FROM miembros GROUP BY genero;";
      $result3 = mysqli_query($con, $qry); // Ejecutar la consulta
      while($row = mysqli_fetch_array($result3)) {  
          // Generar las filas del gráfico
          echo "['".$row["genero"]."', ".$row["enumber"]."],";  
      }  
      ?>  
    ]);

    var options = {
      pieHole: 0.4, // Configura el gráfico como un gráfico de dona
    };

    var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
    chart.draw(data, options);
  }
</script>

<script type="text/javascript">
  google.charts.load("current", {packages:["corechart"]});
  google.charts.setOnLoadCallback(drawChart);

  function drawChart() {
    var data = google.visualization.arrayToDataTable([  
      ['Price', 'Number of Members'],  
      <?php  
      // Ajusta la consulta SQL para contar los miembros por precio
      $qry = "SELECT precio, COUNT(*) AS num_members FROM miembros GROUP BY precio;";
      $result = mysqli_query($con, $qry); // Ejecutar la consulta
      while($row = mysqli_fetch_array($result)) {  
          // Generar las filas del gráfico
          echo "['".$row["precio"]."', ".$row["num_members"]."],";  
      }  
      ?>  
    ]);

    var options = {
      pieHole: 0.4, // Configura el gráfico como un gráfico de dona
      title: 'Miembros por Precio', // Opcional: Agrega un título al gráfico
    };

    var chart = new google.visualization.PieChart(document.getElementById('donutchart2'));
    chart.draw(data, options);
  }
</script>

     
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

<!-- Visit codeastro.com for more projects -->
<!--sidebar-menu-->
  <?php $page='dashboard'; include 'includes/sidebar.php'?>
<!--sidebar-menu-->

<!--main-container-part-->
<div id="content">
<!--breadcrumbs-->
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.php" title="You're right here" class="tip-bottom"><i class="fa fa-home"></i> Home</a></div>
  </div>
<!--End-breadcrumbs-->

<!--Action boxes-->
  <div class="container-fluid">
    <div class="quick-actions_homepage">
      <ul class="quick-actions">
        <li class="bg_ls span"> <a href="index.php" style="font-size: 16px;"> <i class="fas fa-user-check"></i> <span class="label label-important"><?php include'actions/dashboard-activecount.php'?></span> Miembros Activos </a> </li>
        <li class="bg_lo span3"> <a href="members.php" style="font-size: 16px;"> <i class="fas fa-users"></i></i><span class="label label-important"><?php include'dashboard-usercount.php'?></span> Miembros Registrados</a> </li>
        <li class="bg_lg span3"> <a href="payment.php" style="font-size: 16px;"> <i class="fa fa-dollar-sign"></i> Total Ganancia: $<?php include'income-count.php' ?></a> </li>
        <li class="bg_lb span2"> <a href="announcement.php" style="font-size: 16px;"> <i class="fas fa-bullhorn"></i><span class="label label-important"><?php include'actions/count-announcements.php'?></span>Avisos </a> </li>

        
      </ul>
    </div>
<!--End-Action boxes-->    

<!--Chart-box-->    
    <div class="row-fluid">
      <div class="widget-box">
        <div class="widget-title bg_lg"><span class="icon"><i class="fas fa-file"></i></span>
          <h5>Servicio Reporte</h5>
        </div>
        <div class="widget-content" >
          <div class="row-fluid">
            <div class="span8">
              <!-- <div id="piechart"></div>   -->
              <div id="top_x_div" style="width: 700px; height: 290px;"></div>
            </div>
            <div class="span4">
              <ul class="site-stats">
              <li class="bg_lh"><i class="fas fa-users"></i> <strong><?php include 'dashboard-usercount.php';?></strong> <small>Total Miembros</small></li>
<li class="bg_lg"><i class="fas fa-user-clock"></i> <strong><?php include 'actions/dashboard-staff-count.php';?></strong> <small>Usuarios del Staff</small></li>
<li class="bg_ls"><i class="fas fa-dumbbell"></i> <strong><?php include 'actions/count-equipments.php';?></strong> <small>Equipos Disponibles</small></li>
<li class="bg_ly"><i class="fas fa-file-invoice-dollar"></i> <strong>$<?php include 'actions/total-exp.php';?></strong> <small>Gastos Totales</small></li>
<li class="bg_lr"><i class="fas fa-user-ninja"></i> <strong><?php include 'actions/count-trainers.php';?></strong> <small>Entrenadores Activos</small></li>
<li class="bg_lb"><i class="fas fa-calendar-check"></i> <strong><?php include 'actions/count-attendance.php';?></strong> <small>Miembros Presentes</small></li>

              </ul>
            </div>
          </div>
        </div>
      </div><!-- Visit codeastro.com for more projects -->
    </div><!-- End of row-fluid -->

    <div class="row-fluid">
      <div class="widget-box">
        <div class="widget-title bg_lg"><span class="icon"><i class="fas fa-file"></i></span>
          <h5>Informes de Ganancias y Gastos</h5>
        </div>
        <div class="widget-content" >
          <div class="row-fluid">
            <div class="span12">
              <!-- <div id="piechart"></div>   -->
              <div id="top_y_div" style="width: 700px; height: 180px;"></div>
            </div>
            
          </div>
        </div>
      </div>
    </div><!-- End of row-fluid -->

    <div class="row-fluid">
      <div class="span6">
        <div class="widget-box">
          <div class="widget-title bg_ly" data-toggle="collapse" href="#collapseG2"><span class="icon"><i class="fas fa-chevron-down"></i></span>
            <h5>Miembros Registrados del Gimnasio por Género: Resumen</h5>
          </div>
          <div class="widget-content nopadding collapse in" id="collapseG2">
            <ul class="recent-posts">
              
              <div id="donutchart" style="width: 600px; height: 300px;"></div>

            </ul>
          </div>
        </div>

      </div>

      <div class="span6">
  <div class="widget-box">
    <div class="widget-title bg_ly" data-toggle="collapse" href="#collapseG2">
      <span class="icon"><i class="fas fa-chevron-down"></i></span>
      <h5>Miembros del Personal por Cargo: Resumen</h5>
    </div>
    <div class="widget-content nopadding collapse in" id="collapseG2">
      <ul class="recent-posts">
        <li>
          <div id="donutchart2" style="width: 600px; height: 300px;"></div>
        </li>
      </ul>
    </div>
  </div>   
</div>
      </div>
	
<!--End-Chart-box--> <!-- Visit codeastro.com for more projects -->
    <!-- <hr/> -->
    <div class="row-fluid">
      <div class="span6">
        <div class="widget-box">
          <div class="widget-title bg_ly" data-toggle="collapse" href="#collapseG2"><span class="icon"><i class="fas fa-chevron-down"></i></span>
            <h5>Anuncios del Gimnasio</h5>
          </div>
          <div class="widget-content nopadding collapse in" id="collapseG2">
            <ul class="recent-posts">
              <li>

              <?php
 include "dbcon.php";
 $qry = "SELECT * FROM anuncios";
 $result = mysqli_query($con, $qry);
 if (!$result) {
  die("Error in query: " . mysqli_error($con));
}

while($row = mysqli_fetch_array($result)){
  echo "<div class='user-thumb'> <img width='70' height='40' alt='User' src='../img/demo/av1.jpg'> </div>";
  echo "<div class='article-post'>"; 
  echo "<span class='user-info'> By: System Administrator / Date: " . $row['fecha'] . " </span>";
  echo "<p><a href='#'>" . $row['mensaje'] . "</a> </p>";
  echo "</div>";
}
                  
               
                echo"</li>";
              ?>

              <a href="manage-announcement.php"><button class="btn btn-warning btn-mini">Ver Todos</button></a>
              </li>
            </ul>
          </div>
        </div>
       
         
      </div>
      <div class="span6">
       
      <div class="widget-box">
  <div class="widget-title"> 
    <span class="icon"><i class="fas fa-tasks"></i></span>
    <h5>Listas de Tareas</h5>
  </div>
  <div class="widget-content">
    <div class="todo">
      <ul>
        <?php
        include "dbcon.php";
        $qry = "SELECT * FROM tareas";
        $result = mysqli_query($con, $qry);

        while ($row = mysqli_fetch_array($result)) {
          // Aquí cambiamos 'descripcion_tareas' por 'descripcion_tarea'
          ?>
          <li class='clearfix'> 
            <div class='txt'> 
              <?php echo $row["descripcion_tarea"]; ?> 
              <?php 
              // Usamos 'estado_tarea' para determinar el estado de la tarea
              if ($row["estado_tarea"] == "Pendiente") { 
                echo '<span class="by label label-info">Pendiente</span>'; 
              } else { 
                echo '<span class="by label label-success">En Progreso</span>'; 
              } 
              ?>
            </div>
          </li>
          <?php
        }
        ?>
      </ul>
    </div>
  </div>
</div>

       
                </div>
       
      </div> <!-- End of ToDo List Bar -->
    </div><!-- End of Announcement Bar -->
  </div><!-- End of container-fluid -->
</div><!-- End of content-ID -->

<!--end-main-container-part-->

<!--Footer-part-->

<div class="row-fluid">
  <div id="footer" class="span12"> <?php echo date("Y");?> &copy; Desarrollado Por UnionDigital</a> </div>
</div>

<style>
#footer {
  color: white;
}

#piechart {
  width: 800px; 
  height: 280px;  
  margin-left:auto; 
  margin-right:auto;
}
</style>

<!--end-Footer-part-->

<script src="../js/excanvas.min.js"></script> <!-- Visit codeastro.com for more projects -->
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
<!-- <script src="../js/matrix.interface.js"></script>  -->
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

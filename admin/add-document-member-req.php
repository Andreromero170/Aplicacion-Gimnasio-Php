<?php
session_start();

// Check if user is logged in
if(!isset($_SESSION['user_id'])){
    header('location:../index.php');
    exit;
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

<?php $page='members-entry'; include 'includes/sidebar.php'; ?>

<div id="content">
    <div id="content-header">
        <div id="breadcrumb">
            <a href="#" class="tip-bottom"><i class="fas fa-home"></i> Home</a>
            <a href="#" class="tip-bottom">Administracion de Usuarios</a>
            <a href="#" class="current">Modificar Miembros</a>
        </div>
        <h1>Formulario de Miembros</h1>
    </div>

    <?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ensure the file was uploaded
    if (isset($_FILES['documentos']) && $_FILES['documentos']['error'] == UPLOAD_ERR_OK) {
        
        $file = $_FILES['documentos'];
        $id_usuario = $_POST['id_miembro'];
        $fileName = $file['name'];
        $fileTmpName = $file['tmp_name'];
        $fileSize = $file['size'];
        $fileError = $file['error'];
        $fileType = $file['type'];

        // Define the directory where the files will be uploaded
        $uploadDirectory = "../uploads/"; // Make sure this directory exists and is writable

        // Create a unique filename to avoid overwriting
        $fileNewName = uniqid('', true) . "-" . $fileName;

        // Move the file from temp directory to the upload directory
        if (move_uploaded_file($fileTmpName, $uploadDirectory . $fileNewName)) {
            // File uploaded successfully
           
            $ruta_documento = $uploadDirectory . $fileNewName;
            $fecha_subida = date("Y-m-d");

            // Database connection
            $conn = new mysqli('localhost', 'root', '', 'gymu');
            if ($conn->connect_error) {
                die("Error de conexión: " . $conn->connect_error);
            }

            // Insert file information into the database
            $stmt = $conn->prepare("INSERT INTO miembro_documento (id_usuario, ruta_documento, fecha_subida) VALUES (?, ?, ?)");
            $stmt->bind_param("iss", $id_usuario, $ruta_documento, $fecha_subida);

            if ($stmt->execute()) {
                // Success message
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
                                            <h3>Documento Añadido Correctamente!</h3>
                                            <p>Se añadieron los datos solicitados. Haga clic en el botón para volver atrás.</p>
                                            <a class='btn btn-inverse btn-big' href='files.php'>Ir al Listado</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>";
            } else {
                echo "Error al subir el archivo a la base de datos.";
            }

            // Close the connection
            $stmt->close();
            $conn->close();

        } else {
            
            echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Error al mover el archivo.',
            });
        </script>";
        }

    } else {
        
        echo "<script>
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Error al subir el archivo.',
        });
    </script>";
    }
}
?>

</div>
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

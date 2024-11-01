<?php 
session_start(); 
include('dbcon.php'); 
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Sistema de Gimnasio - Inicio de Sesión</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/bootstrap-responsive.min.css" />
    <link rel="stylesheet" href="css/matrix-style.css" />
    <link rel="stylesheet" href="css/matrix-login.css" />
    <link href="font-awesome/css/fontawesome.css" rel="stylesheet" />
    <link href="font-awesome/css/all.css" rel="stylesheet" />
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
</head>

<body>

    <div id="loginbox">            
        <form id="loginform" method="POST" class="form-vertical" action="">
            <div class="control-group normal_text"> 
                <h3><img src="img/icontest3.png" alt="Logo" /></h3>
            </div>
            <div class="control-group">
                <div class="controls">
                    <div class="main_input_box">
                        <span class="add-on bg_lg"><i class="fas fa-user-circle"></i></span>
                        <input type="text" name="nombre_usuario" placeholder="Nombre de usuario" required/>
                    </div>
                </div>
            </div>
            <div class="control-group">
                <div class="controls">
                    <div class="main_input_box">
                        <span class="add-on bg_ly"><i class="fas fa-lock"></i></span>
                        <input type="password" name="contrasena" placeholder="Contraseña" required />
                    </div>
                </div>
            </div>
            <div class="form-actions center">
                <button type="submit" class="btn btn-block btn-large btn-info" title="Iniciar sesión" name="login" value="Login">Iniciar sesión</button>
            </div>
        </form>
        <?php
if (isset($_POST['login'])) {
    $nombre_usuario = $_POST['nombre_usuario'];
    $contrasena = $_POST['contrasena'];

    // Usar Prepared Statements para evitar inyecciones SQL
    $stmt = $con->prepare("SELECT id_usuario, contrasena, id_tipo, suspendido FROM usuarios WHERE nombre_usuario = ?");
    $stmt->bind_param("s", $nombre_usuario);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id_usuario, $stored_password, $id_tipo, $suspendido);
        $stmt->fetch();
        
        // Comparar la contraseña en texto plano
        if ($contrasena === $stored_password) {
            // Verificar el estado de suspensión
            if ($suspendido == 1) {
                echo "<div class='alert alert-warning alert-dismissible' role='alert'>
                    Tu cuenta está suspendida. Por favor, contacta al administrador.
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                    </button>
                </div>";
            } else {
                $_SESSION['user_id'] = $id_usuario;

                // Redirigir según el tipo de usuario
                switch ($id_tipo) {
                    case 1: // Administrador
                        header('Location: admin/index.php');
                        break;
                    case 2: // Profesor
                        header('Location: admin/index.php');
                        break;
                    case 3: // Socio
                        header('Location: admin/index.php');
                        break;
                    default:
                        header('Location: error.php');
                        break;
                }
                exit();
            }
        } else {
            echo "<div class='alert alert-danger alert-dismissible' role='alert'>
                Usuario o contraseña incorrectos
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                </button>
            </div>";
        }
    } else {
        echo "<div class='alert alert-danger alert-dismissible' role='alert'>
            Usuario o contraseña incorrectos
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
            </button>
        </div>";
    }

    $stmt->close();
}
?>

        
    </div>

    <script src="js/jquery.min.js"></script>  
    <script src="js/matrix.login.js"></script> 
    <script src="js/bootstrap.min.js"></script> 
    <script src="js/matrix.js"></script>
</body>
</html>

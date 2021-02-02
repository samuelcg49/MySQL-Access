<?php require("funciones.php");
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="author" content="Samuel Cies Gracia">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="icon" type="image/png" href="./images/disc-fill.svg">
    <title>BDD Discográfica</title>
</head>
<body>
    <!-- Barra de navegación -->
<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
    <div id="imageheader">
        <img src="./images/disc-fill.svg" width="30" height="30" class="d-inline-block align-top" alt="" loading="lazy">
        <a class="navbar-brand" href="index.php"> DISCOGRÁFICAS</a>
        
    </div>
    
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item active">
          <a class="nav-link" href="registro.php">Registrarse</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="login.php">Iniciar Sesión</a>
        </li>
      </ul>
    </div>
</nav>
<br><br>
<!-- Fin barra navegación --> 
<div class="registerform">
    <h2>¿Aún no tienes cuenta? ¿A qué esperas?</h2>
    <h1>¡ ES GRATIS !</h1>
    <br>
    <?php
        if(isset($_SESSION["error_repite"])){
            printf("<div class='error-repite'> %s </div>",$_SESSION["error_repite"]); 
            session_unset(); //Elimina la sesion(cartel de aviso) al cargar la pagina o al cambiar de página
        }else{
            if(isset($_SESSION["error_registro"])){
                printf("<div class='error'> %s </div>",$_SESSION["error_registro"]); 
                session_unset(); //Elimina la sesion(cartel de aviso) al cargar la pagina o al cambiar de página
            }else{
                if(isset($_SESSION["success_registro"])){
                    printf("<div class='success'> %s </div>",$_SESSION["success_registro"]);    
                    session_unset(); //Elimina la sesion(cartel de aviso) al cargar la pagina o al cambiar de página
                }else{}
            }
        }     
    ?>
    <br>
    <div class="registro">
    <?php printf("<form action='%s' method='POST'>", $_SERVER["PHP_SELF"]); ?>
        <div class="form-row">
            <div class="form-group col-md-6">
            <label for="email">Correo electrónico <span class="rojo">*</span></label>
            <input type="email" class="form-control" name="email" id="email" required>
            </div>
            <div class="form-group col-md-6">
            <label for="usuario">Nombre de usuario <span class="rojo">*</span></label>
            <input type="text" class="form-control" name="usuario" id="usuario" required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
            <label for="ape1">1<sup>er</sup> Apellido</label>
            <input type="text" class="form-control" name="ape1" id="ape1" >
            </div>
            <div class="form-group col-md-6">
            <label for="ape2">2º Apellido</label>
            <input type="text" class="form-control" name="ape2" id="ape2" >
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="contrasena">Contraseña <span class="rojo">*</span></label>
                <input type="password" class="form-control" name="contrasena" id="contrasena" required>
            </div>
            <div class="form-group col-md-6">
                <label for="repite">Repetir contraseña <span class="rojo">*</span></label>
                <input type="password" class="form-control" name="repite" id="repite" required>
            </div>
        </div>
        
        <input type="submit" class="btn btn-primary" name="registrarse" value="Registrarse">
        </form>
        <br>
        <p>¿Ya tienes cuenta? <a href="login.php">Inicia Sesión</a></p>
        </div>
</div>

<?php 
    if(empty($_POST["registrarse"])){
        printf("");
    }
    else{
        $usuario = trim($_POST["usuario"]);
        $contrasena = trim($_POST["contrasena"]);
        $repite = trim($_POST["repite"]);
        $email = trim($_POST["email"]);

        if(isset($_POST["ape1"])){
            $ape1 = $_POST["ape1"];
        }else{
            $ape1 = "null";
        }
        if(isset($_POST["ape2"])){
            $ape2 = $_POST["ape2"];
        }else{
            $ape2 = "null";
        }   

        registro($usuario, $contrasena, $email, $ape1, $ape2, $repite);
    }
?>    


<?php include("footer.html"); ?>
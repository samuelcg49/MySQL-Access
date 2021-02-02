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
    
    <h1>Iniciar Sesión</h1>
    <br>
    <?php
        if(isset($_SESSION["error_login"])){
            printf("<div class='error'> %s </div>",$_SESSION["error_login"]);    
            session_unset(); //Elimina la sesion(cartel de aviso) al cargar la pagina o al cambiar de página
        }else{}      
    ?>
    <br>
    <div class="registro">
    <?php printf("<form action='%s' method='POST'>", $_SERVER["PHP_SELF"]); ?>
        <div class="form-group">
            <label for="contrasena">Usuario o Correo electrónico</label>
            <input type="text" class="form-control" name="usuario" id="usuario" 
            <?php if(empty($_COOKIE['usuario'])){}else{ echo "value=".$_COOKIE['usuario']; }?> required>
        </div>
        <div class="form-group">
            <label for="contrasena">Contraseña</label>
            <input type="password" class="form-control" name="contrasena" id="contrasena" required>
        </div>
        
        <input type="submit" class="btn btn-primary" name="login" value="Iniciar Sesión">
            <div class="recordar">
                <input type="checkbox" name="recordar" id="recordar">
                <label for="recordar" >Recordar usuario</label>
            </div>
        </form>
        <br>
        <p>¿Aún no tienes cuenta? <a href="registro.php">Regístrate Gratis</a></p>
        </div>
</div>

<?php 
    if(empty($_POST["login"])){
        printf("");
    }
    else{

        $usuario = trim($_POST["usuario"]);
        $contrasena = trim($_POST["contrasena"]);
        $recordar = $_POST["recordar"];

        if($recordar){
            setcookie("usuario",$usuario);
        }

        login($usuario, $contrasena);
    }
?>    


<?php include("footer.html"); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="author" content="Samuel Cies Gracia">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="icon" type="image/png" href="./images/disc-fill.svg">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
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
      <!-- ****************************************************************************************************************-->
    <!-- ************************************* SOLO SE VE SI SE HA INICIADO SESIÓN **********************************-->
    <?php
      session_start();

        if(!empty($_SESSION["Usuario_logueado"])){
          printf('
            <li class="nav-item active">
            <a class="nav-link" href="consulta.php">Realizar Consulta</a>
            </li>
            <li class="nav-item active">
              <a class="nav-link btn text-white" href="Mi-Cuenta.php" style="background: #7952b3;"> <i class="fas fa-user-circle"></i>'); printf(" %s ",$_SESSION["Usuario_logueado"]); printf(' </a>
            </li>
            <li class="nav-item active">
            <a class="nav-link btn btn-danger text-white" href="loguot.php"><i class="fas fa-sign-out-alt"></i> Salir</a>
            </li>
          ');
        }else{
          printf('
            <li class="nav-item active">
            <a class="nav-link" href="registro.php">Registrarse</a>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="login.php">Iniciar Sesión</a>
            </li>
          ');
        }
    ?>       
      </ul>
    </div>
  </nav>

  <!-- Banner -->
<div id="wellcome">
    <h1>ACCEDE A TODA LA INFORMACIÓN DE TU MÚSICA</h1>
</div>
<br><br>
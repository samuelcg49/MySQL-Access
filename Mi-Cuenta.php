<!-- HEADER -->
<?php
  session_start();

  if(empty($_SESSION["Usuario_logueado"])){
    
    header("Location: index.php");
    
  }else

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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
    <title>BDD Discográfica</title>
</head>
<body>
    <!-- Barra de navegación -->
<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
    <div id="imageheader">
        <img src="./images/disc-fill.svg" width="30" height="30" class="d-inline-block align-top" loading="lazy">
        <a class="navbar-brand" href="index.php"> DISCOGRÁFICAS</a>
        
    </div>
    
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav ml-auto">     
          <?php 
            printf('
            <li class="nav-item active">
            <a class="nav-link" href="agregar.php">Agregar Datos</a>
            </li>
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
          ?>
      </ul>
    </div>
  </nav>
  <br><br><br><br>
  <h2>Mis datos</h2>
  <br>
<?php
define('DB_SERVER','localhost'); 
define('DB_NAME','usuariosdisco'); 
define('DB_USER','root'); 
define('DB_PASS','napoleon1'); 

    $conexion = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME); 
    $user = $_SESSION["Usuario_logueado"];
    $consulta = mysqli_query($conexion, "SELECT * FROM usuarios WHERE nombre = '$user' ");

  mysqli_query($conexion, "SET NAMES utf8");

printf('<div class="contenedor">');
    printf("<table>");

    while($datos = mysqli_fetch_assoc($consulta)){
        printf("<tr>");
            printf("<td class='bg-primary' style='color: white;'> ID </td>");
            printf("<td>%s</td>",$datos["id"]);
        printf("</tr>");
        printf("<tr>");
            printf("<td class='bg-primary' style='color: white;'> Nombre de Usuario </td>");
            printf("<td>%s</td>",$datos["nombre"]);
        printf("</tr>");
        printf("<tr>");
            printf("<td class='bg-primary' style='color: white;'> 1er Apellido </td>");
            printf("<td>%s</td>",$datos["ape1"]);
        printf("</tr>");
        printf("<tr>");
            printf("<td class='bg-primary' style='color: white;'> 2º Apellido </td>");
            printf("<td>%s</td>",$datos["ape2"]);
        printf("</tr>");
        printf("<tr>");
            printf("<td class='bg-primary' style='color: white;'> Correo electrónico </td>");
            printf("<td>%s</td>",$datos["email"]);
        printf("</tr>");
        printf("<tr>");
            printf("<td class='bg-primary' style='color: white;'> Fecha de alta </td>");
            printf("<td>%s</td>",$datos["FchCreacion"]);
        printf("</tr>");
    }       
    
printf("</table>
  </div> <br><br><br><br>");



include("footer.html");
    
   
?>
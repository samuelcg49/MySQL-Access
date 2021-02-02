<?php
define('DB_SERVER','localhost'); 
define('DB_NAME','usuariosdisco'); 
define('DB_USER','root'); 
define('DB_PASS','Fedoce.1'); 
/********************* FUNCIÓN DE CONSULTA ********************************/
/******************************************************************************************************/

function consulta($indiceConsulta){
    require("./comun.php");
    $tabla = $tablas[1][$indiceConsulta];

    printf("<br><br>");
    printf("<h4>Selecciona las columnas a mostrar</h4><br>");
   
    printf('    <form action="?procesa" method="POST">');
    for($i = 0 ; $i < count($$tabla[0]) ; $i++){
        printf("<input type='checkbox' name='%s' value='%s' id='%s'>", $$tabla[0][$i],$$tabla[0][$i],$$tabla[0][$i]);
        printf("<label for='%s'> %s </label>", $$tabla[0][$i], $$tabla[1][$i]);
        printf("<br>");
    }
    printf("<br>
            <h4>Ordenar por</h4>");
    for($i = 0 ; $i < count($$tabla[0]) ; $i++){
        printf("<input type='radio' name='filtro' value='%s' id='filtro%s'>", $$tabla[0][$i],$$tabla[0][$i],$$tabla[0][$i]);
        printf("<label for='filtro%s'> %s </label>", $$tabla[0][$i], $$tabla[1][$i]);
        printf("<br>");
    }
   printf('<br>
            <input type="radio" name="ordenacion" value="asc" id="ascendente"> 
            <label for="ascendente"> Acendente </label>
            <br>
            <input type="radio" name="ordenacion" value="desc" id="descendente"> 
            <label for="descendente"> Descendente </label>
            <br><br>
                    ');
    printf('<input type="submit" name="%d" value="Consultar" class="btn btn-primary" type="button">
    </form> ', $indiceConsulta); 
}


/************************* FUNCIÓN DE PROCESAMIENTO  ***********************************************/
/******************************************************************************************************/
function procesa($indiceTabla){
    require("comun.php"); 
    $tabla = $tablas[1][$indiceTabla];

    printf("<table>");
    printf("<tr>");

        for($i = 0 ; $i < count($$tabla[0]) ; $i++){    /* COMPRUEBA SI LOS CHECKBOX VIENEN VACIOS */
            $valor = $$tabla[0][$i];
            
            if(!isset($_POST["$valor"])){
                $$valor = null;
            }else{
                $$valor = $_POST["$valor"];
                printf("<th> %s </th>",$$tabla[1][$i]);
            }        
        }
    printf("</tr>");

    if(!isset($_POST["filtro"])){   /* COMPRUEBA SI LOS VALORES DE ORDENACION VIENEN VACIOS*/
        $filtro = null;
    }else{
        $filtro = $_POST["filtro"];
    }
    if(!isset($_POST["ordenacion"])){
        $ordenacion = null;
    }else{
        $ordenacion = $_POST["ordenacion"];
    }

    $conexion = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,"disco");
    
    if(mysqli_connect_errno()){
        printf("
            <script> alert('HA HABIDO UN ERROR EN LA CONEXIÓN') </script>
        ");

    }
    
    mysqli_query($conexion, "SET NAMES utf8");

    /* FILTRO SOBRE LA ORDENACIÓN, SI VIENEN VACIOS DARIA ERROR EN LA CONSULTA, PARA ELLO ESTE CONTROL */
        if(($filtro == null && $ordenacion == null) || ($filtro == null && $ordenacion == true)){
            if($indiceTabla == 4){
                $consulta = mysqli_query($conexion, "SELECT COMP.*, GRP.NOMBRE AS GRUPO FROM TCOMPONENTE COMP INNER JOIN TGRUPO GRP ON COMP.CODGRUPO = GRP.CODIGO");
            }else{
                $consulta = mysqli_query($conexion, "SELECT * FROM $tabla");
            }  
        }else{
            if($indiceTabla == 4){
                $consulta = mysqli_query($conexion, "SELECT COMP.*, GRP.NOMBRE AS GRUPO FROM TCOMPONENTE COMP INNER JOIN TGRUPO GRP ON COMP.CODGRUPO = GRP.CODIGO ORDER BY $filtro $ordenacion"); 
            }else{
                $consulta = mysqli_query($conexion, "SELECT * FROM $tabla ORDER BY $filtro $ordenacion"); 
            }
                
        }           

    /* GENERA LAS FILAS CON LOS DATOS */
          while($datos = mysqli_fetch_assoc($consulta)){
            printf("<tr>");
            
            for($i = 0 ; $i < count($$tabla[0]); $i++){
                $valor = $$tabla[0][$i];
                
                if($$valor == null){
                
                }else{
                    printf("<td>%s</td>",$datos["$valor"]);
                }
            }
            printf("</tr>");
        }
    printf("</table>");
}

/******************************************************************************************************************/
/********************************************** FUNCIÓN DE REGISTRO ***********************************************/

function registro($usuario, $contrasena, $email, $ape1, $ape2, $repite){
    
    if($contrasena != $repite){
        if(isset($_SESSION["error_repite"])){
            session_unset($_SESSION["error_repite"]); 
        }else{
            
            $_SESSION["error_repite"] = "Las contraseñas no coinciden";
            header("Location: registro.php");
        }
    }else{
    
        $conexion = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME); 
        
        $consulta = mysqli_query($conexion, "SELECT * FROM usuarios WHERE nombre = '$usuario'" );
        $consulta2 = mysqli_query($conexion, "SELECT * FROM usuarios WHERE email = '$email' ");
        
        $encriptada = password_hash($contrasena, PASSWORD_DEFAULT, ['cost' => 4]);
        
        if (mysqli_num_rows($consulta) > 0 && mysqli_num_rows($consulta2) > 0){
            
            if(isset($_SESSION["error_registro"])){
                session_unset($_SESSION["error_registro"]); 
            }else{
                
                $_SESSION["error_registro"] = "Este usuario ya ha sido registrado";
                header("Location: registro.php");
            }

        }else{
            if(isset($_SESSION["success_registro"])){
                session_unset($_SESSION["success_registro"]); 

            }else{
                $sql = "INSERT INTO usuarios (nombre,contrasena,email,ape1,ape2) VALUES ('$usuario','$encriptada','$email','$ape1','$ape2')"; 
                mysqli_query($conexion, $sql); 

                $_SESSION["success_registro"] = "SE HA REGISTRADO CON ÉXTIO";
                header("Location: registro.php");  
            }
        }
    }
}

function login ($usuario, $contrasena){
    

    $conexion = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME); 
    
    $consulta = mysqli_query($conexion, "SELECT * FROM usuarios WHERE nombre = '$usuario' OR email = '$usuario' ");
    
    if ($consulta && mysqli_num_rows($consulta) == 1){

        $datosUser = mysqli_fetch_assoc($consulta);
        
            if(password_verify($contrasena, $datosUser['contrasena'])){

                $_SESSION["Usuario_logueado"] = $datosUser['nombre'];

                if(isset($SESSION["error_login"])){
                    session_unset($_SESSION["error_login"]);
                }

                header("Location: consulta.php");

            }else{
                $_SESSION["error_login"] = "Usuario o Contraseña erróneos";
                header("Location: login.php");
            }

    }else{
        
        $_SESSION["error_login"] = "Usuario o Contraseña erróneos";
        header("Location: login.php");
    }

}



?>
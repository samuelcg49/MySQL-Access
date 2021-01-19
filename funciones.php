<?php

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

    $conexion = mysqli_connect("localhost","web","root","disco");
    
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

?>
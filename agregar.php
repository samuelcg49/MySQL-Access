<?php require("comun.php"); ?>
<?php require("funciones.php") ?>
<?php include("header.php"); 
?>

<?php

if(empty($_SESSION["Usuario_logueado"])){

  header("Location: index.php");

}else
?>
<!-- Zona de selección de tablas -->
<section>
    <div id="selection">
        <h2>¿Dónde quieres agregar datos?</h2>
        <br>
        <?php 
            if(isset($_POST['tabla'])){} else {
                $_POST['tabla'] = "0";
            }
            $tabla = $_POST["tabla"];

        printf("<form action='%s' method='POST'>", $_SERVER["PHP_SELF"]); ?>
            <fieldset>
                <select name="tabla" id="tabla">
                    <?php
                        for($i = 0 ; $i < count($tablas[0]); $i++){
                            printf("<option value='%d'", $i); if($i == $tabla) printf("selected");
                    printf("> %s </option>",$tablas[0][$i]);
                        }
                        
                    ?>
                </select>
            </fieldset>
            <br>
            <input type="submit" value="Seleccionar Tabla" name="seleccionar" class="btn btn-primary" type="button">
            </form>
        <br> <br>
        </div>
        <?php
            if(isset($_SESSION["agregado"])){
                printf("<div class='success'> %s </div>",$_SESSION["agregado"]); 
                unset($_SESSION["agregado"]);//Elimina la sesion(cartel de aviso) al cargar la pagina o al cambiar de página
            }
        ?>
            <?php
                    if(isset($_POST["control"]) && empty($_POST["seleccionar"])){
                        $indiceTabla = $_POST["control"];
                        agregaDatos($indiceTabla);                     
                    }    
                   if(empty($_POST["seleccionar"])){
                    printf("");
                        
                   }else{

                    $indiceTabla = $_POST["tabla"];
                    agregar($indiceTabla);   

                   }    

            ?>
</section>

<?php include("footer.html"); ?>
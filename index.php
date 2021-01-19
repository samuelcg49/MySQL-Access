<?php include("header.html"); ?>
<?php require("comun.php"); ?>
<?php require("funciones.php") ?>

<!-- Zona de selección de tablas -->
<section>
    <div id="selection">
        <h2>Selecciona la tabla que deseas consultar</h2>
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
                   if(empty($_POST["seleccionar"])){
                    printf("");
                    
                   }else{
                    $indiceTabla = $_POST["tabla"];
                    

                    switch($indiceTabla){
                        case '0':
                            consulta(0);
                            break;
                        case '1':
                            consulta(1);
                            break;
                        case '2':
                            consulta(2);
                        break;
                        case '3':
                            consulta(3);
                        break;
                        case '4':
                            consulta(4);
                        break;
                    }
                   } 
                   
/* SEGÚN EL FORMULARIO QUE SE HA RELLENADO SE MUESTRA, SI NO SE HA RELLENADO NO SE MUESTRA HASTA QUE SE RELLENE */
                   for($i = 0 ; $i < count($tablas[0]) ; $i++){
                        if(empty($_POST["$i"])){
                            printf("");
                        }else{
                            procesa($i);
                        }
                   }
                    

                    
            ?>
</section>


<?php include("footer.html"); ?>
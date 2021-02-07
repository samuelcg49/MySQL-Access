<?php

$tablas = array (
    array ("Canciones", "Cantante", "Discográfica", "Grupos","Componentes de Grupos") ,
    array("tcancion","tcantante","tdiscografica","tgrupo","tcomponente")
);

$tcancion = array(
    array("TITULO","DURACION","PUBLICACION","GENERO"),
    array("Título","Duración","Fecha de Publicación", "Género")

);

$tcantante = array(
    array("NOMBRE","APE1","APE2","NOM_ARTISTICO","NACIMIENTO","NACIONALIDAD","TIPO_VOZ","NOMBREDISCOGRAFICA"),
    array("Nombre","1er Apellido","2º Apellido","Nombre artístico","Fecha de nacimiento","Nacionalidad","Tipo de voz","Discográfica")
);

$tdiscografica = array (
    array ("NOMBRE", "FUNDACION", "SEDE", "NUM_EMPLEADOS"),
    array (" Nombre", "Año de fundación", " Sede", "Nº de empleados")
);

$tgrupo = array(
    array("NOMBRE","FUNDACION","NACIONALIDAD","NOMBREDISCOGRAFICA"),
    array("Nombre","Fecha de fundación","Pais de Origen","Discográfica")
);

$tcomponente = array(
    array("NOMBRE","APE1","APE2","NACIMIENTO","NACION","GRUPO"),
    array("Nombre","1er Apellido","2º Apellido","Fecha de Nacimiento","Nacionalidad","Grupo de pertenencia")
);


?>
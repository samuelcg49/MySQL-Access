/* CREA LA BDD PARA EL ALMACENAMIENTO DE USUARIOS DE LA WEB */

DROP DATABASE IF EXISTS usuariosdisco;
CREATE DATABASE usuariosdisco;

use usuariosdisco;

create table usuarios (
        id          INT NOT NULL AUTO_INCREMENT,
        nombre      VARCHAR(50) NOT NULL,
        contrasena  VARCHAR(255) NOT NULL,
        email       VARCHAR(255) NOT NULL,
        ape1        CHAR(50),
        ape2        CHAR(50),
        FchCreacion DATETIME DEFAULT CURRENT_TIMESTAMP,

        PRIMARY KEY (id)

) engine = InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;
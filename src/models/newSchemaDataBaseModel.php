<?php

namespace Src\Models;


class NewSchema
{

    private $conection = null;
    private $dbhost = "";
    private $dbuser = "";
    private $dbpass = "";
    private $bdname = "";

    public function __construct($bdname)
    {
        $this->dbhost = "localhost";
        $this->dbuser = "root";
        $this->dbpass = "";
        $this->bdname = $bdname;
        $this->conection = $this->getConnection($bdname);
    }

    public function createNewSchema()
    {

        mysqli_query($this->conection,"
        CREATE TABLE propiedades(
        codPropiedad INT(11) PRIMARY KEY AUTO_INCREMENT,
        nombre VARCHAR(50)
        );")or die("Problemas al crear la tabla propiedades ".mysqli_error($this->conection));

        mysqli_query($this->conection,"
        CREATE TABLE roles(
        codRol INT(11) PRIMARY KEY AUTO_INCREMENT,
        nombre VARCHAR(50)
        );")or die("Problemas al crear la tabla roles ".mysqli_error($this->conection));

        mysqli_query($this->conection,"
        CREATE TABLE usuarios(
        documento VARCHAR(11) NOT NULL,
        nombre VARCHAR(50) NULL DEFAULT NULL,
        apellido VARCHAR(50) NULL DEFAULT NULL,
        correo VARCHAR(100)UNIQUE,
        password VARCHAR(100) NOT NULL,
        edad INT(11) NULL DEFAULT NULL,
        codRol INT(11) NULL DEFAULT NULL,
        codPropiedad INT(11) NULL DEFAULT NULL,
        PRIMARY KEY (documento),
        FOREIGN KEY (codRol) REFERENCES roles (codRol),
        FOREIGN KEY (codPropiedad) REFERENCES propiedades (codPropiedad)
        );")or die("Problemas al crear la tabla usuarios ".mysqli_error($this->conection));

    mysqli_close($this->conection);

    }

    public function getConnection($dbname) 
    {
        $conexion=mysqli_connect($this->dbhost,$this->dbuser,$this->dbpass,$dbname) or
        die("Problemas con la conexión");

        return $conexion;
    }
}



        
<?php

include ("clases/BD.php");


$bd=new BD();


$conexion= $bd->conectoBD();


echo $bd->damecoordenadas();
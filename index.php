<?php

require_once "controladores/rutas.controladores.php";
require_once "controladores/cursos.controladores.php";
require_once "controladores/clientes.controladores.php";
require_once "modelos/clientes.modelo.php";
require_once "modelos/cursos.modelo.php";

$rutas = new ControladorRutas();
$rutas -> inicio();

?>
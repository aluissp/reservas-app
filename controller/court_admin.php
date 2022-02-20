<?php

require "../../database.php";

require_once('../../model/court.php');
$ob_cancha = new Curt();

if (!isset($_SESSION["admin"])) {
  header("Location: ../../view/login.php");
  return;
}

$todas_canchas = $ob_cancha->obtener_todas_canchas($conn, $_SESSION["admin"]["cod_empresa"]);

?>

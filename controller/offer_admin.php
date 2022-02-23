<?php

require "../../database.php";

require_once('../../model/offer.php');
$ob_offer = new Offer();

if (!isset($_SESSION["admin"])) {
  header("Location: ../../view/login.php");
  return;
}
$id_dis = $_GET["id_disciplina"];

$todas_promociones = $ob_offer->obtener_promocion($conn, $id_dis);
$dis = $ob_offer->obtener_nombre_disciplina($conn, $id_dis)->fetch(PDO::FETCH_ASSOC);


?>

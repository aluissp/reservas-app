<?php

require "../database.php";

require_once('../model/user.php');
$ob_user = new User();

if (!isset($_SESSION["user"])) {
  header("Location: login.php");
  return;
}

$promos = $ob_user->obtener_promociones_cancha($conn);
$mis_reservas = $ob_user->obtener_mis_reservas($conn, $_SESSION["user"]["cod_cliente"]);

// ->fetch(PDO::FETCH_ASSOC);


?>

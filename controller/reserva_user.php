<?php

require "../database.php";

require_once('../model/user.php');
$user = new User();

session_start();

if (!isset($_SESSION["user"])) {
  header("Location: ../view/login.php");
  return;
}

$reservas = $user->obtener_todas_reservas($conn, $_SESSION["user"]["cod_cliente"]);

?>

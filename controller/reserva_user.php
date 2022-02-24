<?php

require "../database.php";

require_once('../model/user.php');
$user = new User();

if (!isset($_SESSION["user"])) {
  header("Location: ../view/login.php");
  return;
}

$error = null;
$id_cancha = $_GET['id'];

// $reserva = $user->obtener_todas_reservas($conn, $_SESSION["user"]["cod_cliente"]);
$cancha = $user->obtener_cancha($conn, $id_cancha);
$fecha = $user->obtener_fecha($conn, $id_cancha);
// $cancha = $cancha->fetch(PDO::FETCH_ASSOC);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if ($_POST['action'] == 'get-reserve') {
    if ($_POST['promo'] == 'no') {
      
    }
  }
}

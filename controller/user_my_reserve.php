<?php
require "../database.php";

require_once('../model/user.php');
$user = new User();

if (!isset($_SESSION["user"])) {
  header("Location: ../view/login.php");
  return;
}

$mis_reservas = $user->obtener_mis_reservas($conn, $_SESSION['user']['cod_cliente']);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if ($_POST['action'] == 'get-reserve') {

  }
}

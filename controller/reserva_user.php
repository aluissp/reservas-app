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
    if ($_POST['promo'] == 'yes') {
      $id_cancha = $_POST["id_cancha"];
      $fecha_reserva = $_POST["fecha"];
      $precio = $_POST["precio"];
      $fecha_actual = strtotime(date("d-m-Y H:i:00", time()));
      $fecha_aux = strtotime($fecha_reserva);
      if ($fecha_aux < $fecha_actual) {
        $error = "La fecha debe ser mayor o igual a la fecha actual.";
        return;
      }

      if (isset($fecha['ultima_fecha_reserva'])) {
        $last_fecha = strtotime($fecha['ultima_fecha_reserva']);
        if ($fecha_aux < $last_fecha) {
          $error = "La fecha debe ser mayor o igual a la fecha disponible.";
          return;
        }
      }

      $user->registrar_reserva($conn, $id_cancha, $_SESSION['user']['cod_cliente'], $fecha_reserva, $precio);

      $_SESSION["flash"] = ["message" => "Cancha reservada correctamente."];

      header("Location: home.php");
      return;
    } elseif ($_POST['promo'] == 'no') {
      $id_cancha = $_POST["id_cancha"];
      $fecha_reserva = $_POST["fecha"];
      $precio = $_POST["precio"];
      $fecha_actual = strtotime(date("d-m-Y H:i:00", time()));
      $fecha_aux = strtotime($fecha_reserva);
      if ($fecha_aux < $fecha_actual) {
        $error = "La fecha debe ser mayor o igual a la fecha actual.";
        return;
      }

      if (isset($fecha['ultima_fecha_reserva'])) {
        $last_fecha = strtotime($fecha['ultima_fecha_reserva']);
        if ($fecha_aux < $last_fecha) {
          $error = "La fecha debe ser mayor o igual a la fecha disponible.";
          return;
        }
      }

      $user->registrar_reserva($conn, $id_cancha, $_SESSION['user']['cod_cliente'], $fecha_reserva, $precio);

      $_SESSION["flash"] = ["message" => "Cancha reservada correctamente."];

      header("Location: home.php");
      return;
    }
  }
}

<?php

require "../../database.php";

require_once('../../model/offer.php');
$ob_offer = new Offer();

if (!isset($_SESSION["admin"])) {
  header("Location: ../../view/login.php");
  return;
}
$error = null;
$id_dis = $_GET["id_disciplina"];
$todas_canchas = $ob_offer->obtener_promocion($conn, $id_dis);
$dis = $ob_offer->obtener_nombre_disciplina($conn, $id_dis)->fetch(PDO::FETCH_ASSOC);


if ($_SERVER["REQUEST_METHOD"] == "POST") {

  if (isset($_GET["add"])) {
    if (empty($_POST["name"]) || empty($_POST["observation"])) {
      $error = "Por favor completa todos los campos.";
    } else {
      $name = $_POST["name"];
      $obs = $_POST["observation"];
      $dis = $_POST["disciplina"];
      $status = isset($_POST["status"]) ? 1 : 0;

      if ($ob_offer->validar_cancha($conn, $name)) {
        $error = "La cancha ya se encuentra agregada.";
      } else {
        $ob_offer->registrar_cancha($conn, $name, $status, $obs, $dis);
        $_SESSION["flash"] = ["message" => "{$_POST['name']} agregada correctamente."];

        header("Location: ./court.php");
      }
    }
  } elseif (isset($_GET["update"])) {
    if (empty($_POST["name"]) || empty($_POST["observation"])) {
      $error = "Por favor completa todos los campos.";
    } else {
      $name = $_POST["name"];
      $obs = $_POST["observation"];
      $dis = $_POST["disciplina"];
      $status = isset($_POST["status"]) ? 1 : 0;
      $id_dis = $_POST["id_cancha"];

      $ob_offer->actualizar_cancha($conn, $name, $status, $obs, $id_dis, $dis);
      $_SESSION["flash"] = ["message" => "{$_POST['name']} actualizado correctamente."];

      header("Location: ./court.php");
      return;
    }
  } elseif (isset($_GET["delete"])) {

    $id_cancha = $_POST["id_cancha"];

    if ($statement->rowCount() == 0) {
      http_response_code(404);
      echo ("HTTP 404 NOT FOUND");
      return;
    }

    $cancha = $statement->fetch(PDO::FETCH_ASSOC);

    if ($ob_offer->tiene_registros_cancha($conn, $id_cancha)) {
      $error = "La cancha {$cancha['nombre_cancha']} ya tiene registros.";
    } else {
      $ob_offer->eliminar_cancha($conn, $id_cancha);

      $_SESSION["flash"] = ["message" => "{$cancha['nombre_cancha']} eliminado correctamente."];

      header("Location: ./court.php");
    }
  }
}

<?php

require "../../database.php";

require_once('../../model/court.php');
$ob_cancha = new Curt();

if (!isset($_SESSION["admin"])) {
  header("Location: ../../view/login.php");
  return;
}
$error = null;
$todas_canchas = $ob_cancha->obtener_todas_canchas($conn, $_SESSION["admin"]["cod_empresa"]);

$todas_disciplinas = $ob_cancha->obtener_todas_disciplinas($conn, $_SESSION["admin"]["cod_empresa"]);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  if (isset($_GET["add"])) {
    if (empty($_POST["name"]) || empty($_POST["observation"])) {
      $error = "Por favor completa todos los campos.";
    } else {
      $name = $_POST["name"];
      $obs = $_POST["observation"];
      $dis = $_POST["disciplina"];
      $status = isset($_POST["status"]) ? 1 : 0;

      if ($ob_cancha->validar_cancha($conn, $name)) {
        $error = "La cancha ya se encuentra agregada.";
      } else {
        $ob_cancha->registrar_cancha($conn, $name, $status, $obs, $dis);
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
      
      $admin->actualizar_disciplina($conn, $id, $name, $price);
      $_SESSION["flash"] = ["message" => "{$_POST['name']} actualizado correctamente."];

      header("Location: ./court.php");
      return;
    }
  }
}

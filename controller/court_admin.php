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
      $id_dis = $_POST["id_cancha"];

      $ob_cancha->actualizar_cancha($conn, $name, $status, $obs, $id_dis, $dis);
      $_SESSION["flash"] = ["message" => "{$_POST['name']} actualizado correctamente."];

      header("Location: ./court.php");
      return;
    }
  } elseif (isset($_GET["delete"])) {

    $id_cancha = $_POST["id_cancha"];

    $statement = $ob_cancha->obtener_cancha($conn, $id_cancha);

    if ($statement->rowCount() == 0) {
      http_response_code(404);
      echo ("HTTP 404 NOT FOUND");
      return;
    }

    $cancha = $statement->fetch(PDO::FETCH_ASSOC);

    if ($ob_cancha->tiene_registros_cancha($conn, $id_cancha)) {
      $error = "La cancha {$cancha['nombre_cancha']} ya tiene registros.";
    } else {
      $ob_cancha->eliminar_cancha($conn, $id_cancha);

      $_SESSION["flash"] = ["message" => "{$cancha['nombre_cancha']} eliminado correctamente."];

      header("Location: ./court.php");
    }
  }
}

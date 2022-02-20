<?php

require "../../database.php";

require_once('../../model/admin.php');
$admin = new Admin();

if (!isset($_SESSION["admin"])) {
  header("Location: ../../view/login.php");
  return;
}

$disciplinas = $admin->obtener_todas_disciplinas($conn, $_SESSION["admin"]["cod_empresa"]);

$error = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Edit, delete and update skill for admin
  if ($_POST['action'] == 'add_skill') {
    if (empty($_POST["name"]) || empty($_POST["price"])) {
      $error = "Por favor completa todos los campos.";
    } else {
      $name = $_POST["name"];
      $price = $_POST["price"];

      if ($admin->validar_disciplina($conn, $name)) {
        $error = "La disciplina ya se encuentra agregada.";
      } else {
        $admin->registrar_disciplina($conn, $name, $_SESSION["admin"]["cod_empresa"], $price);
        $_SESSION["flash"] = ["message" => "{$_POST['name']} agregada correctamente."];

        header("Location: ./home.php");
        return;
      }
    }
  } elseif ($_POST['action'] == 'delete_skill') {
  } elseif ($_POST['action'] == 'update_skill') {

    if (empty($_POST["name"]) || empty($_POST["price"])) {
      $error = "Por favor completa todos los campos.";
      $id_disciplina = $_GET["id_disciplina"];
      $statement = $admin->obtener_disciplina($conn, $id_disciplina);
      $disciplina = $statement->fetch(PDO::FETCH_ASSOC);

    } else {
      $id = $_GET["id_disciplina"];
      $name = $_POST["name"];
      $price = $_POST["price"];

      $admin->actualizar_disciplina($conn, $id, $name, $price);
      $_SESSION["flash"] = ["message" => "{$_POST['name']} actualizado correctamente."];

      header("Location: home.php");
      return;
    }
  }
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {

  // Get disciplina
  if (isset($_GET["id_disciplina"])) {

    $id_disciplina = $_GET["id_disciplina"];
    $statement = $admin->obtener_disciplina($conn, $id_disciplina);
    if ($statement->rowCount() == 0) {
      http_response_code(404);
      echo ("HTTP 404 NOT FOUND");
      return;
    }

    $disciplina = $statement->fetch(PDO::FETCH_ASSOC);

    if ($disciplina["empresa_cod_empresa"] !== $_SESSION["admin"]["cod_empresa"]) {
      http_response_code(403);
      echo ("HTTP 403 UNAUTHORIZED");
      return;
    }
  }
}

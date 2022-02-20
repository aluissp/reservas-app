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
  }
}
?>

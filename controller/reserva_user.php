<?php

require "../database.php";

require_once('../model/user.php');
$user = new User();

if (!isset($_SESSION["user"])) {
  header("Location: ../view/login.php");
  return;
}

// $reservas = $user->obtener_todas_reservas($conn, $_SESSION["user"]["cod_cliente"]);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["name"]) || empty($_POST["phone_number"])) {
    $error = "Please fill all the fields.";
  } else if (strlen($_POST["phone_number"]) < 9) {
    $error = "Phone number must be at least 9 characters.";
  } else {
    $name = $_POST["name"];
    $phoneNumber = $_POST["phone_number"];
    $_SESSION["flash"] = ["message" => "Contact {$_POST['name']} added."];

    return;
  }
}

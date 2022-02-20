<?php

require "../database.php";

require_once('../model/admin.php');
$admin = new Admin();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (
    empty($_POST["name"]) || empty($_POST["name_agent"])
    || empty($_POST["ruc"]) || empty($_POST["password"])
    || empty($_POST["direccion"]) || empty($_POST["cellphone"])
    || empty($_POST["email"])
  ) {
    header("Location: ../view/register_business.php?error_none=1");
  } else {

    $statement = $admin->registrar_admin(
      $conn,
      $_POST["name"],
      $_POST["name_agent"],
      $_POST["ruc"],
      $_POST["email"],
      $_POST["direccion"],
      $_POST["password"],
      $_POST["cellphone"],
    );
    $ob_user = $statement->fetch(PDO::FETCH_ASSOC);

    session_start();
    $_SESSION["admin"] = $ob_user;

    header("Location: ../view/admin/home.php");
  }
}

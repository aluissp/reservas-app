<?php

require "../database.php";

require_once('../model/user.php');
$user = new User();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (
    empty($_POST["name"]) || empty($_POST["surname"])
    || empty($_POST["email"]) || empty($_POST["password"])
    || empty($_POST["direccion"]) || empty($_POST["cellphone"])
  ) {
    header("Location: ../view/register.php?error_none=1");
  } else {

    if ($user->validar_correo($conn, $_POST["email"])) {
      header("Location: ../view/register.php?error_mail=1");
    } else {
      $statement = $user->registrar_usuario(
        $conn,
        $_POST["name"],
        $_POST["surname"],
        $_POST["email"],
        $_POST["direccion"],
        $_POST["password"],
        $_POST["genero"],
        $_POST["cellphone"],
        $_POST["fdate"]
      );
      $ob_user = $statement->fetch(PDO::FETCH_ASSOC);

      session_start();
      $_SESSION["user"] = $ob_user;

      header("Location: ../view/home.php");
    }
  }
}

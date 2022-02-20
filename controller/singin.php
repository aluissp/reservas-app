<?php

require "../database.php";
require_once('../model/user.php');
require_once('../model/admin.php');
$user = new User();
$admin = new Admin();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["email"]) || empty($_POST["password"])) {
    header("Location: ../view/login.php?error_none=1");
  } else {
    $statement = $user->iniciar_sesion($conn, $_POST['email']);
    $statement2 = $admin->iniciar_sesion($conn, $_POST["email"]);

    // DUAL SESSION
    if ($statement->rowCount() == 0 && $statement2->rowCount() == 0) {
      header("Location: ../view/login.php?error_auth=1");
      // USER
    } elseif ($statement->rowCount() > 0) {
      $ob_user = $statement->fetch(PDO::FETCH_ASSOC);

      if (!password_verify($_POST["password"], $ob_user["pass"])) {
        header("Location: ../view/login.php?error_auth=1");
      } else {
        session_start();

        unset($ob_user["pass"]);

        $_SESSION["user"] = $ob_user;

        header("Location: ../view/home.php");
      }
      // Admin
    } elseif ($statement2->rowCount() > 0) {
      $ob_admin = $statement2->fetch(PDO::FETCH_ASSOC);

      if (!password_verify($_POST["password"], $ob_admin["password"])) {
        header("Location: ../view/login.php?error_auth=1");
      } else {
        session_start();

        unset($ob_admin["password"]);

        $_SESSION["admin"] = $ob_admin;

        header("Location: ../view/admin/home.php");
      }
    }
  }
}

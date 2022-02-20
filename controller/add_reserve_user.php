<?php

  require "../database.php";

  session_start();

  if (!isset($_SESSION["user"])) {
    header("Location: ../view/login.php");
    return;
  }


  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["name"]) || empty($_POST["phone_number"])) {
      $error = "Please fill all the fields.";
      header("Location: ../view/add_reserve.php?error_none=1");
    } else if (strlen($_POST["phone_number"]) < 9) {
      $error = "Phone number must be at least 9 characters.";
      header("Location: ../view/register.php?error_none=1");
    } else {
      $name = $_POST["name"];
      $phoneNumber = $_POST["phone_number"];

      $statement = $conn->prepare("INSERT INTO contacts (user_id, name, phone_number) VALUES ({$_SESSION['user']['id']}, :name, :phone_number)");
      $statement->bindParam(":name", $_POST["name"]);
      $statement->bindParam(":phone_number", $_POST["phone_number"]);
      $statement->execute();

      $_SESSION["flash"] = ["message" => "Contact {$_POST['name']} added."];

      header("Location: ../view/home.php");
      return;
    }
  }
?>

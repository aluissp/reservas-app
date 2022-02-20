<?php

require "../../database.php";

require_once('../../model/court.php');
$admin = new Curt();

if (!isset($_SESSION["admin"])) {
  header("Location: ../../view/login.php");
  return;
}

$disciplinas = $admin->obtener_todas_disciplinas($conn, $_SESSION["admin"]["cod_empresa"]);

$error = null;


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

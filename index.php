<?php
require "database.php";

$empresa = $conn->query("SELECT * FROM empresa LIMIT 1");

?>
<?php require "./view/partials/header.php" ?>

<div class="welcome d-flex align-items-center justify-content-center">
  <div class="text-center">
    <h1 class="text-white">Reserva tu espacio deportivo ahora</h1>
    <a class="btn btn-lg btn-dark" href="./view/register.php">Empecemos</a>
  </div>
</div>

<?php require "./view/partials/footer.php" ?>

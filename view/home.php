<?php
session_start();
require "partials/header.php";
require "../controller/offer_user.php";
?>

<div class="container pt-4 p-3">
  <div class="row">
    
  </div>
  <div class="row">

    <?php if ($promos->rowCount() == 0) : ?>
      <div class="col-md-4 mx-auto">
        <div class="card card-body text-center border-info">
          <p>No hay promociones actualemente</p>
        </div>
      </div>
    <?php endif ?>
    <?php foreach ($promos as $promo) : ?>
      <div class="col-md-4 mb-3">
        <div class="card text-center border-warning">
          <div class="card-body">
            <h3 class="card-title text-capitalize"><?= $promo["nombre_cancha"] ?></h3>
            <p class="m-2"><?= $promo["nombre_promocion"] ?> </p>
            <p class="m-2">Disciplina: <?= $promo["nombre_disciplina"] ?></p>
            <p class="m-2">Precio: <?= $promo["precio_disciplina"] ?> $</p>
            <p class="m-2">Promoción: - <?= $promo["descuento_promocion"] ?> %</p>

            <button id="<?= $promo["cod_cancha"] ?>" class="btn btn-danger mb-2">Reservar cancha</button>
          </div>
        </div>
      </div>
    <?php endforeach ?>

  </div>
</div>

<script></script>

<?php require "partials/footer.php" ?>

<?php
session_start();
require "partials/header.php";
require "../controller/offer_user.php";
?>

<div class="container pt-4 p-3">
  <p class="text-danger text-center h4">PROMOCIONES</p>
  <div class="row my-3">
    <input type="text" class="form-control" placeholder="Filtrar promocion por nombre de promocion, nombre de cancha, precio o % de promoción" id="txt-filter1">
  </div>
  <div class="row" id="body-filter1">

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

            <a href="add_reserve.php?id=<?= $promo["cod_cancha"] ?>" class="btn btn-danger mb-2">Reservar cancha</a>
          </div>
        </div>
      </div>
    <?php endforeach ?>

  </div>
  <p class="text-success text-center h4 mt-5">CANCHAS</p>
  <div class="row my-3">
    <input type="text" class="form-control" placeholder="Filtrar canchas nombre de cancha o precio" id="txt-filter2">
  </div>
  <div class="row" id="body-filter2">

    <?php if ($todas_canchas->rowCount() == 0) : ?>
      <div class="col-md-4 mx-auto">
        <div class="card card-body text-center border-info">
          <p>No hay canchas disponibles actualemente</p>
        </div>
      </div>
    <?php endif ?>
    <?php foreach ($todas_canchas as $cancha) : ?>
      <div class="col-md-4 mb-3">
        <div class="card text-center border-warning">
          <div class="card-body">
            <h3 class="card-title text-capitalize"><?= $cancha["nombre_cancha"] ?></h3>
            <p class="m-2">Disciplina: <?= $cancha["nombre_disciplina"] ?></p>
            <p class="m-2">Precio: <?= $cancha["precio_disciplina"] ?> $</p>

            <a href="add_reserve.php?id=<?= $cancha["cod_cancha"] ?>" class="btn btn-info mb-2">Reservar cancha</a>
          </div>
        </div>
      </div>
    <?php endforeach ?>

  </div>
</div>

<script src="../controller/user_ajax.js"></script>

<?php require "partials/footer.php" ?>

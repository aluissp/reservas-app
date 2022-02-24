<?php
session_start();
require "partials/header.php";
require "../controller/reserva_user.php";
?>

<div class="container pt-5">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header h5 text-warning text-center"><?= $cancha['nombre_cancha'] ?></div>
        <div class="card-body">
          <?php if ($error) : ?>
            <p class="text-danger">
              <?= $error ?>
            </p>
          <?php endif ?>
          <?php if (isset($cancha["descuento_promocion"])) : ?>
            <p class="m-2 text-success h5">Descripción</p>
            <p class="m-2 text-info"><?= $cancha["obs_cancha"] ?> </p>
            <p class="m-2 text-success h5">Detalles</p>
            <p class="m-2 text-info h6 text-center">Promoción: <?= $cancha["nombre_promocion"] ?> </p>
            <p class="m-2 text-info">Disciplina: <?= $cancha["nombre_disciplina"] ?></p>
            <p class="m-2 text-info">Precio: <?= $cancha["precio_disciplina"] ?> $</p>
            <p class="m-2 text-info">Promoción: - <?= $cancha["descuento_promocion"] ?> %</p>
            <p class="m-2 text-info">Total: <?= $cancha["precio_disciplina"] - ($cancha["precio_disciplina"] * ($cancha["descuento_promocion"]) / 100) ?> $</p>
            <p class="m-2 text-warning">Fecha de promoción:
              <?= $fecha["fechai_promocion"] ?> hasta <?= $fecha["fechaf_promocion"] ?></p>
            <?php if (isset($fecha['ultima_fecha_reserva'])) : ?>
              <p class="m-2 text-success">Fecha disponible desde:
                <?= $fecha["ultima_fecha_reserva"] ?> en adelante.</p>
            <?php endif ?>
            <form method="POST" action="add_reserve.php?id=<?= $id_cancha ?>">
              <input value="<?= $cancha["cod_cancha"] ?>" type="hidden" name="id_cancha">
              <input value="get-reserve" type="hidden" name="action">
              <input value="<?= $cancha["precio_disciplina"] - ($cancha["precio_disciplina"] * ($cancha["descuento_promocion"]) / 100) ?>" type="hidden" name="precio">
              <input value="yes" type="hidden" name="promo">
              <div class="d-flex justify-content-center">
                <p class="m-2 text-info text-center col-6">Elige tu fecha de reserva.
                  <input class="form-control" type="date" name="fecha" required>
                </p>
              </div>
              <div class="mb-3 row justify-content-center">
                <div class="col-md-6 offset-md-4">
                  <button type="submit" class="btn btn-primary">Reservar</button>
                </div>
              </div>
            </form>

          <?php else : ?>
            <p class="m-2 text-success h5">Descripción</p>
            <p class="m-2 text-info"><?= $cancha["obs_cancha"] ?> </p>
            <p class="m-2 text-success h5">Detalles</p>
            <p class="m-2 text-info">Disciplina: <?= $cancha["nombre_disciplina"] ?></p>
            <p class="m-2 text-info">Precio: <?= $cancha["precio_disciplina"] ?> $</p>
            <?php if (isset($fecha['ultima_fecha_reserva'])) : ?>
              <p class="m-2 text-success">Fecha disponible desde:
                <?= $fecha["ultima_fecha_reserva"] ?> en adelante.</p>
            <?php endif ?>

            <form method="POST" action="add_reserve.php?id=<?= $id_cancha ?>">
              <input value="<?= $cancha["cod_cancha"] ?>" type="hidden" name="id_cancha">
              <input value="get-reserve" type="hidden" name="action">
              <input value="<?= $cancha["precio_disciplina"] ?>" type="hidden" name="precio">
              <input value="no" type="hidden" name="promo">
              <div class="d-flex justify-content-center">
                <p class="m-2 text-info text-center col-6">Elige tu fecha de reserva.
                  <input class="form-control" type="date" name="fecha" required>
                </p>
              </div>
              <div class="mb-3 row justify-content-center">
                <div class="col-md-6 offset-md-4">
                  <button type="submit" class="btn btn-primary">Reservar</button>
                </div>
              </div>
            </form>

          <?php endif ?>
        </div>
      </div>
    </div>
  </div>
</div>

<?php require "partials/footer.php" ?>

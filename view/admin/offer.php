<?php
session_start();
require "../partials/header.php";
require "../../controller/offer_admin.php";
?>

<div class="container pt-4 p-3">
  <p class="text-success text-center h4">Disciplina <?= $dis["nombre_disciplina"] ?></p>
  <?php if ($error) : ?>
    <p class="text-danger text-center">
      <?= $error ?>
    </p>
  <?php endif ?>
  <div class="row my-3">
    <p class="text-success h5">Buscar promoción</p>
    <div class="form-floating">
      <input type="text" class="form-control" id="txt-filter-court" placeholder="Filtrar por cancha o disciplina">
      <label for="txt-filter-court">Filtrar promoción.</label>
    </div>
    <p class="text-success h5 mt-3 mb-0">Añadir promoción</p>
  </div>

  <!-- Formulario de canchas -->
  <form class="row" method="POST" id="form-court">
    <div class="col-6 p-0">
      <div class="form-floating mb-3">
        <input type="text" class="form-control" id="floatingName" placeholder="Nombre de la cancha" name="name">
        <label for="floatingName">Nombre de la promoción</label>
      </div>
      <label for="finicio" class="">Fecha de inicio</label>
      <input type="date" name="finicio" id="finicio" class="form-control">
    </div>
    <div class="col-6">
      <!-- <label for="exampleSelect1" class="form-label mt-4">Example select</label> -->

      <div class="form-floating">
        <input type="number" class="form-control" id="floatingOffer" placeholder="Descuento" name="offer" step="0.01" min="1" max="100">
        <label for="floatingOffer">Introduce el descuento en % del 1 al 100</label>
      </div>
      <label for="finicio" class="mt-3">Fecha fin</label>
      <input type="date" name="ffin" id="finicio" class="form-control">
      <input type="hidden" name="id_cancha" value="" id="hidden_id_cancha">
      <button type="submit" class="btn btn-outline-success mt-4 col-5" id="add-court">Añadir</button>
      <button type="submit" class="btn btn-outline-info mt-4 col-5" id="update-court">Actualizar</button>
    </div>
  </form>

  <div class="row">
    <table class="table table-hover">
      <thead>
        <tr>
          <th scope="col">Nombre de la promoción</th>
          <th scope="col">Fecha inicio</th>
          <th scope="col">Fecha fin</th>
          <th scope="col">Descuento</th>
          <th scope="col">Acciones</th>
        </tr>
      </thead>
      <tbody id="table-cancha">
        <?php if ($todas_canchas->rowCount() == 0) : ?>
          <tr>
            <td colspan=5>
              <div class="col-md-4 mx-auto">
                <div class="card card-body text-center">
                  <p>No hay resultados</p>
                  <a>Agrega uno!</a>
                </div>
              </div>
            </td>
          </tr>
        <?php endif ?>

        <?php foreach ($todas_canchas as $cancha) : ?>
          <tr>
            <th><?= $cancha['nombre_cancha'] ?></th>
            <td><?= $cancha['nombre_disciplina'] ?></td>
            <td><?= ($cancha['estado_cancha'] > 0) ? 'ocupado' : 'desocupado' ?></td>
            <td>
              <button class="btn btn-outline-warning col-5" id="<?= $cancha['cod_cancha'] ?>">Editar</button>
              <form class="d-none" action="court.php?delete=1" method="POST" id="form-<?= $cancha['cod_cancha'] ?>">
                <input value="<?= $cancha['cod_cancha'] ?>" name="id_cancha">
              </form>
              <button class="btn btn-outline-danger ml-1 col-5" form="form-<?= $cancha['cod_cancha'] ?>" type="submit">Eliminar</button>
            </td>
          </tr>
        <?php endforeach ?>
      </tbody>
    </table>
  </div>

</div>

<script src="../../controller/ajax.js"></script>

<?php require "../partials/footer.php" ?>

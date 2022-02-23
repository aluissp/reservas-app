<?php
session_start();
require "../partials/header.php";
require "../../controller/offer_admin.php";
?>

<div class="container pt-4 p-3">
  <p class="text-success text-center h4">Disciplina <?= $dis["nombre_disciplina"] ?></p>
  <!-- Success and error message -->
  <p class="text-danger text-center" id="error">
  </p>
  <p class="text-info text-center" id="success">
  </p>

  <div class="row my-3">
    <!-- Search offer input -->
    <p class="text-success h5">Buscar promoción</p>
    <div class="form-floating">
      <input type="text" class="form-control" id="txt-filter-offer" placeholder="Filtrar por cancha o disciplina">
      <label for="txt-filter-offer">Filtrar promoción.</label>
    </div>
    <p class="text-success h5 mt-3 mb-0">Añadir promoción</p>
  </div>

  <!-- Formulario de canchas -->
  <div class="row" id="form-offer">
    <div class="col-6 p-0">
      <div class="form-floating mb-3">
        <input type="text" class="form-control" id="floatingName" placeholder="Nombre de la cancha" required>
        <label for="floatingName">Nombre de la promoción</label>
      </div>
      <label for="finicio" class="">Fecha de inicio</label>
      <input type="date" id="finicio" class="form-control" required>
    </div>
    <div class="col-6">
      <!-- <label for="exampleSelect1" class="form-label mt-4">Example select</label> -->

      <div class="form-floating">
        <input type="number" class="form-control" id="floatingOffer" placeholder="Descuento" step="0.01" min="1" max="100" required>
        <label for="floatingOffer">Introduce el descuento en % del 1 al 100</label>
      </div>
      <label for="ffin" class="mt-3">Fecha fin</label>
      <input type="date" id="ffin" class="form-control" required>
      <!-- Input id offer and id discipline -->
      <input type="hidden" value="" id="id_offer">
      <input type="hidden" id="id_dis" value="<?= $id_dis ?>">
      <!-- Button add and update -->
      <button class="btn btn-outline-success mt-4 col-5" id="add-offer">Añadir</button>
      <button class="btn btn-outline-info mt-4 col-5" id="update-offer">Actualizar</button>
    </div>
  </div>

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
      <tbody id="table-offer">
        <?php if ($todas_promociones->rowCount() == 0) : ?>
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

        <?php foreach ($todas_promociones as $promocion) : ?>
          <tr>
            <th><?= $promocion["nombre_promocion"] ?></th>
            <td><?= $promocion["fechai_promocion"] ?></td>
            <td><?= $promocion["fechaf_promocion"] ?></td>
            <td><?= $promocion["descuento_promocion"] ?> %</td>
            <td>
              <button class="btn btn-outline-warning col-5" id="<?= $promocion["cod_promocion"] ?>" des="<?= $promocion["descuento_promocion"] ?>">Editar</button>
              <button class="btn btn-outline-danger ml-1 col-5" id="<?= $promocion["cod_promocion"] ?>">Eliminar</button>
            </td>
          </tr>
        <?php endforeach ?>
      </tbody>
    </table>
  </div>

</div>

<script src="../../controller/ajax.js"></script>

<?php require "../partials/footer.php" ?>

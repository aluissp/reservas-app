<?php
session_start();
require "../partials/header.php";
require "../../controller/court_admin.php";
?>

<div class="container pt-4 p-3">
  <?php if ($error) : ?>
    <p class="text-danger text-center">
      <?= $error ?>
    </p>
  <?php endif ?>
  <div class="row my-3">
    <p class="text-success h5">Buscar cancha</p>
    <div class="form-floating">
      <input type="text" class="form-control" id="txt-filter" placeholder="Filtrar por cancha o disciplina">
      <label for="txt-filter">Filtrar por cancha o disciplina</label>
    </div>
    <p class="text-success h5 mt-3 mb-0">Añadir cancha</p>
  </div>

  <!-- Formulario de canchas -->
  <form class="row" method="POST" id="form-court">
    <div class="col-6 p-0">
      <div class="form-floating mb-3">
        <input type="text" class="form-control" id="floatingName" placeholder="Nombre de la cancha" name="name">
        <label for="floatingName">Nombre de la cancha</label>
      </div>
      <div class="form-floating">
        <textarea class="form-control" id="floatingObservation" rows="3" style="height: 88px;" name="observation" placeholder="Observaciones"></textarea>
        <label for="floatingObservation">Observaciones</label>
      </div>
    </div>
    <div class="col-6">
      <!-- <label for="exampleSelect1" class="form-label mt-4">Example select</label> -->
      <select class='form-select' name='disciplina' required>
        <option value=''>Elige una disciplina</option>
        <?php if ($todas_disciplinas->rowCount() == 0) : ?>
          <option value=''>No hay disciplinas</option>
        <?php endif ?>
        <?php foreach ($todas_disciplinas as $disciplina) : ?>
          <option value="<?= $disciplina['cod_disciplina'] ?>"><?= $disciplina["nombre_disciplina"] ?></option>
        <?php endforeach ?>
      </select>
      <div class="form-check form-switch mt-3">
        <label class="form-check-label" for="sw-status">Estado de la cancha</label>
        <input class="form-check-input" type="checkbox" id="sw-status" name="status">
      </div>

      <input type="hidden" name="id_cancha" value="">
      <button type="submit" class="btn btn-outline-success mt-4 col-5" id="add-court">Añadir</button>
      <button type="submit" class="btn btn-outline-info mt-4 col-5" id="update-court">Actualizar</button>
    </div>
  </form>

  <div class="row">
    <table class="table table-hover">
      <thead>
        <tr>
          <th scope="col">Nombre de la cancha</th>
          <th scope="col">Disciplina</th>
          <th scope="col">Estado</th>
          <th scope="col">Acciones</th>
        </tr>
      </thead>
      <tbody id="table-cancha">
        <?php if ($todas_canchas->rowCount() == 0) : ?>
          <div class="col-md-4 mx-auto">
            <div class="card card-body text-center">
              <p>No hay canchas guardadas todavía</p>
              <a href="#">Agrega uno!</a>
            </div>
          </div>
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
<script src="../../static/js/wildcard.js"></script>

<?php require "../partials/footer.php" ?>

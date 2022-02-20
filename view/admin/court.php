<?php
session_start();
require "../../controller/court_admin.php";
require "../partials/header.php";
?>

<div class="container pt-4 p-3">
  <div class="row my-3">
    <p class="text-success h5">Buscar cancha</p>
    <input type="text" class="form-control" placeholder="Filtrar canchas" id="txt-filter">
    <p class="text-success h5 mt-3 mb-0">Añadir cancha</p>
  </div>

  <form class="row">
    <div class="col-6 p-0">
      <div class="form-floating mb-3">
        <input type="text" class="form-control" id="floatingName" placeholder="Nombre de la cancha">
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
        <option value=''>Elige una cancha</option>
        <option value=''>Futbol</option>
      </select>
      <div class="form-check form-switch mt-3">
        <label class="form-check-label" for="sw-status">Estado de la cancha</label>
        <input class="form-check-input" type="checkbox" id="sw-status" name="status">
      </div>
      <button type="button" class="btn btn-outline-success mt-4 col-5">Añadir</button>
      <button type="button" class="btn btn-outline-info mt-4 col-5">Actualizar</button>
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
      <tbody>
        <tr>
          <th>Active container</th>
          <td>Column content</td>
          <td>Column content</td>
          <td>
            <button class="btn btn-outline-warning col-5">Editar</button>
            <button class="btn btn-outline-danger ml-1 col-5">Eliminar</button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>

</div>

<script src="../../controller/ajax.js"></script>

<?php require "../partials/footer.php" ?>

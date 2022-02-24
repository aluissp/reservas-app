<?php
session_start();
require "partials/header.php";
require "../controller/user_my_reserve.php";
?>

<div class="container pt-4 p-3">

  <div class="row my-3">
    <p class="text-success h5">Buscar reserva</p>
    <div class="form-floating">
      <input type="text" class="form-control" id="txt-filter" placeholder="Filtrar reserva">
      <input type="hidden" id="mi-id" value="<?= $_SESSION['user']['cod_cliente'] ?>">
      <label for="txt-filter-court">Filtrar reserva</label>
    </div>
  </div>

  <div class="row">
    <table class="table table-hover">
      <thead>
        <tr>
          <th scope="col">Nombre de la cancha</th>
          <th scope="col">Disciplina</th>
          <th scope="col">Fecha de reserva</th>
          <th scope="col">Precio</th>
          <th scope="col">Cantidad</th>
          <th scope="col">Estado</th>
          <th scope="col">Acciones</th>
        </tr>
      </thead>
      <tbody id="table-reserva">
        <?php if ($mis_reservas->rowCount() == 0) : ?>
          <tr>
            <td colspan=7>
              <div class="col-md-4 mx-auto">
                <div class="card card-body text-center">
                  <p>No hay reservas registradas todavía</p>
                  <a>Agrega uno!</a>
                </div>
              </div>
            </td>
          </tr>
        <?php endif ?>

        <?php foreach ($mis_reservas as $reserva) : ?>
          <tr>
            <th><?= $reserva['nombre_cancha'] ?></th>
            <td><?= $reserva['nombre_disciplina'] ?></td>
            <td><?= $reserva['fecha_reserva'] ?></td>
            <td><?= $reserva['precio'] ?> $</td>
            <td><?= $reserva['cantidad'] ?></td>
            <td><?= ($reserva['estado_reserva'] > 0) ? 'ocupado' : 'desocupado' ?></td>
            <td>
              <form class="d-none" action="" method="POST" id="form-<?= $reserva['cod_reserva'] ?>">
                <input value="<?= $reserva['cod_reserva'] ?>" name="id_reserva">
              </form>
              <button class="btn btn-outline-danger ml-1" form="form-<?= $reserva['cod_reserva'] ?>" type="submit">Imprimir
                <i class="fa-solid fa-file-pdf"></i>
              </button>
            </td>
          </tr>
        <?php endforeach ?>
      </tbody>
    </table>
  </div>

</div>

<script src="../controller/user_ajax.js"></script>

<?php require "partials/footer.php" ?>

<?php
session_start();
require "../partials/header.php";
require "../../controller/skill_admin.php";
?>

<div class="container pt-5">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">Añadir nueva disciplina</div>
        <div class="card-body">
          <?php if ($error) : ?>
            <p class="text-danger">
              <?= $error ?>
            </p>
          <?php endif ?>
          <form method="POST" action="add_skill.php">
            <div class="mb-3 row">
              <label for="name" class="col-md-4 col-form-label text-md-end">Nombre de la disciplina</label>
              <div class="col-md-6">
                <input id="name" type="text" class="form-control" name="name" autofocus>
              </div>
            </div>
            <div class="mb-3 row">
              <label for="price" class="col-md-4 col-form-label text-md-end">Precio</label>
              <div class="col-md-6">
                <input id="price" type="number" class="form-control" name="price" placeholder="0.00" step="0.01">
              </div>
              <input type="hidden" name="action" value="add_skill">
            </div>

            <div class="mb-3 row">
              <div class="d-flex col-md-6 offset-md-4 justify-content-end">
                <button type="submit" class="btn btn-outline-success">Guardar</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<?php require "../partials/footer.php" ?>

<?php
session_start();
require "../partials/header.php";
require "../../controller/skill_admin.php";
?>


<div class="container pt-5">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">Actualizar disciplina</div>
        <div class="card-body">
          <?php if ($error) : ?>
            <p class="text-danger">
              <?= $error ?>
            </p>
          <?php endif ?>
          <form method="POST" action="edit_skill.php?id_disciplina=<?= $disciplina['cod_disciplina'] ?>">
            <div class="mb-3 row">
              <label for="name" class="col-md-4 col-form-label text-md-end">Nombre de la disciplina</label>

              <div class="col-md-6">
                <input value="<?= $disciplina['nombre_disciplina'] ?>" id="name" type="text" class="form-control" name="name" autofocus>
              </div>
            </div>

            <div class="mb-3 row">
              <label for="phone_number" class="col-md-4 col-form-label text-md-end">Precio</label>

              <div class="col-md-6">
                <input value="<?= $disciplina['precio_disciplina']?>" type="number" class="form-control" name="price">
              </div>
              <input type="hidden" name="action" value="update_skill">
            </div>

            <div class="mb-3 row">
              <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">Guardar cambios</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<?php require "../partials/footer.php" ?>

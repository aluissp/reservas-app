<?php
session_start();
require "../../controller/skill_admin.php";
require "../partials/header.php";
?>

<div class="container pt-4 p-3">
  <div class="row my-3">
    <input type="text" class="form-control" placeholder="Filtrar disciplinas" id="txt-filter">
  </div>
  
  <?php if ($error) : ?>
    <p class="text-danger text-center">
      <?= $error ?>
    </p>
  <?php endif ?>

  <div class="row" id="body-skill">

    <?php if ($disciplinas->rowCount() == 0) : ?>
      <div class="col-md-4 mx-auto">
        <div class="card card-body text-center">
          <p>No hay disciplinas guardadas todavía</p>
          <a href="add_skill.php">Agrega uno!</a>
        </div>
      </div>
    <?php endif ?>
    <?php foreach ($disciplinas as $disciplina) : ?>
      <div class="col-md-4 mb-3">
        <div class="card text-center">
          <div class="card-body">
            <h3 class="card-title text-capitalize"><?= $disciplina["nombre_disciplina"] ?></h3>
            <p class="m-2">$ <?= $disciplina["precio_disciplina"] ?></p>

            <a href="edit.php?id_disciplina=<?= $disciplina["cod_disciplina"] ?>" class="btn btn-outline-info mb-2 col-7">Promocionar</a>

            <a href="edit.php?id_disciplina=<?= $disciplina["cod_disciplina"] ?>" class="btn btn-outline-warning mb-2">Añadir canchas</a>

            <a href="edit_skill.php?id_disciplina=<?= $disciplina["cod_disciplina"] ?>" class="btn btn-outline-secondary mb-2">Editar disciplina</a>

            <form class="d-none" action="home.php?id_disciplina=<?= $disciplina['cod_disciplina'] ?>" method="POST" id="form-<?= $disciplina['cod_disciplina'] ?>">
              <input value="delete_skill" name="action">
            </form>
            <button class="btn btn-danger mb-2" form="form-<?= $disciplina['cod_disciplina'] ?>" type="submit">Borrar disciplina</button>
          </div>
        </div>
      </div>
    <?php endforeach ?>

  </div>
</div>

<script src="../../controller/ajax.js"></script>

<?php require "../partials/footer.php" ?>

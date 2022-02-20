

<?php require "partials/header.php" ?>

<div class="container pt-5">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">Login</div>
        <div class="card-body">
        <?php if (isset($_GET["error_none"])) : ?>
            <p class="text-danger">
              Por favor completa todos los campos.
            </p>
          <?php endif ?>
          <?php if (isset($_GET["error_auth"])) : ?>
            <p class="text-danger">
              Correo o contraseña incorrecto.
            </p>
          <?php endif ?>
          <form method="POST" action="../controller/singin.php">
            <div class="mb-3 row">
              <label for="email" class="col-md-4 col-form-label text-md-end">Email</label>

              <div class="col-md-6">
                <input id="email" type="email" class="form-control" name="email" autocomplete="email" autofocus>
              </div>
            </div>

            <div class="mb-3 row">
              <label for="password" class="col-md-4 col-form-label text-md-end">Contraseña</label>

              <div class="col-md-6">
                <input id="password" type="password" class="form-control" name="password" autocomplete="password">
              </div>
            </div>

            <div class="mb-3 row">
              <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<?php require "partials/footer.php" ?>

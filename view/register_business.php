<?php require "partials/header.php" ?>

<div class="container pt-5">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">Registro de la empresa</div>
        <div class="card-body">
          <?php if (isset($_GET["error_none"])) : ?>
            <p class="text-danger">
              Por favor completa todos los campos.
            </p>
          <?php endif ?>
          <form method="POST" action="../controller/register_admin.php">

            <div class="mb-3 row">
              <label for="name" class="col-md-4 col-form-label text-md-end">Nombre empresa</label>
              <div class="col-md-6">
                <input id="name" type="text" class="form-control" name="name" placeholder="Ingresa el nombre de la empresa" autofocus>
              </div>
            </div>

            <div class="mb-3 row">
              <label for="name_agent" class="col-md-4 col-form-label text-md-end">Nombre del representate</label>
              <div class="col-md-6">
                <input id="name_agent" type="text" class="form-control" name="name_agent" placeholder="Ingresa el nombre del representate" autofocus>
              </div>
            </div>

            <div class="mb-3 row">
              <label for="ruc" class="col-md-4 col-form-label text-md-end">RUC</label>
              <div class="col-md-6">
                <input id="ruc" type="number" class="form-control" name="ruc">
              </div>
            </div>

            <div class="mb-3 row">
              <label for="email" class="col-md-4 col-form-label text-md-end">Email</label>
              <div class="col-md-6">
                <input id="email" type="email" class="form-control" name="email" placeholder="Ingresa el correo electrónico de la empresa">
              </div>
            </div>

            <div class="mb-3 row">
              <label for="password" class="col-md-4 col-form-label text-md-end">Contraseña</label>
              <div class="col-md-6">
                <input id="password" type="password" class="form-control" name="password">
              </div>
            </div>

            <div class="mb-3 row">
              <label for="direccion" class="col-md-4 col-form-label text-md-end">Dirección</label>
              <div class="col-md-6">
                <input id="direccion" type="text" class="form-control" name="direccion" placeholder="Escribe la direccion">
              </div>
            </div>

            <div class="mb-3 row">
              <label class="col-md-4 col-form-label text-md-end">Telefono</label>
              <div class="col-md-6">
                <input type="number" class="form-control" name="cellphone">
              </div>
            </div>

            <div class="mb-3 row">
              <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">Enviar</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<?php require "partials/footer.php" ?>

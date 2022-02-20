<?php require "partials/header.php" ?>

<div class="container pt-5">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">Registrarse</div>
        <div class="card-body">
          <?php if (isset($_GET["error_none"])) : ?>
            <p class="text-danger">
              Por favor completa todos los campos.
            </p>
          <?php endif ?>
          <?php if (isset($_GET["error_mail"])) : ?>
            <p class="text-danger">
              Este correo electrónico está en uso.
            </p>
          <?php endif ?>
          <form method="POST" action="../controller/register_user.php">

            <div class="mb-3 row">
              <label for="name" class="col-md-4 col-form-label text-md-end">Nombre</label>
              <div class="col-md-6">
                <input id="name" type="text" class="form-control" name="name" placeholder="Ingresa tu nombre" autofocus>
              </div>
            </div>

            <div class="mb-3 row">
              <label for="surname" class="col-md-4 col-form-label text-md-end">Apellido</label>
              <div class="col-md-6">
                <input id="surname" type="text" class="form-control" name="surname" placeholder="Ingresa tu apellido">
              </div>
            </div>

            <div class="mb-3 row">
              <label for="email" class="col-md-4 col-form-label text-md-end">Email</label>
              <div class="col-md-6">
                <input id="email" type="email" class="form-control" name="email" placeholder="Ingresa tu correo electrónico">
              </div>
            </div>

            <div class="mb-3 row">
              <label for="password" class="col-md-4 col-form-label text-md-end">Contraseña</label>
              <div class="col-md-6">
                <input id="password" type="password" class="form-control" name="password" autocomplete="password">
              </div>
            </div>

            <div class="mb-3 row">
              <label for="direccion" class="col-md-4 col-form-label text-md-end">Direccion</label>
              <div class="col-md-6">
                <input id="direccion" type="text" class="form-control" name="direccion" placeholder="Escribe tu direccion">
              </div>
            </div>

            <div class="mb-3 row">
              <label class="col-md-4 col-form-label text-md-end">Telefono</label>
              <div class="col-md-6">
                <input type="number" class="form-control" name="cellphone">
              </div>
            </div>

            <div class="mb-3 row">
              <label class="col-md-4 col-form-label text-md-end">Fecha de nacimiento</label>
              <div class="col-md-6">
                <input type="date" class="form-control" name="fdate" required>
              </div>
            </div>

            <div class="mb-3 row">
              <label class="col-md-4 col-form-label text-md-end">Género</label>
              <div class="col-md-6">
                <select class='custom-select' name='genero' id='list-generos' required>
                  <option value=''>Elige tu genero</option>
                  <option value='Hombre'>Hombre</option>
                  <option value='Mujer'>Mujer</option>
                  <option value='Otro'>Otro</option>
                </select>
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

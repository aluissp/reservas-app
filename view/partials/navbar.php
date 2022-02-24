<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand font-weight-bold" href="#">
      <img class="mr-2" src="/reservas-app/static/img/logo.png" />
      Reservas App
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <div class="d-flex justify-content-between w-100">
        <ul class="navbar-nav">
          <?php if (isset($_SESSION["user"])) : ?>
            <li class="nav-item">
              <a class="nav-link" href="/reservas-app/view/home.php">Inicio</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/reservas-app/view/my_reserve.php">Mis reservas</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/reservas-app/view/logout.php">Cerrar sesión</a>
            </li>
          <?php elseif (!isset($_SESSION["admin"]) && !isset($_SESSION["user"])): ?>
            <li class="nav-item">
              <a class="nav-link" href="/reservas-app/view/register.php">Registrarse</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/reservas-app/view/login.php">Iniciar sesión</a>
            </li>
            <?php if (isset($empresa) && $empresa->rowCount() == 0) : ?>
              <li class="nav-item">
                <a class="nav-link" href="/reservas-app/view/register_business.php">Registra tu empresa</a>
              </li>
            <?php endif ?>

          <?php endif ?>

          <?php if (isset($_SESSION["admin"])) : ?>
            <li class="nav-item">
              <a class="nav-link" href="/reservas-app/view/admin/home.php">Inicio</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/reservas-app/view/admin/add_skill.php">Añadir disciplina</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/reservas-app/view/admin/court.php">Añadir cancha</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/reservas-app/view/logout.php">Cerrar sesión</a>
            </li>
          <?php endif ?>
        </ul>
        <?php if (isset($_SESSION["user"])) : ?>
          <div class="p-2 text-white">
            <?= $_SESSION["user"]["correo_cliente"] ?>
            <i class="fa-solid fa-envelope"></i>
          </div>
        <?php endif ?>

        <?php if (isset($_SESSION["admin"])) : ?>
          <div class="p-2 text-white">
            <?= $_SESSION["admin"]["correo_empresa"] ?>
            <i class="fa-solid fa-envelope"></i>
          </div>
        <?php endif ?>
      </div>
    </div>
  </div>
</nav>

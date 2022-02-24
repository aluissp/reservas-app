<?php

if ($_POST) {
  require_once("../database.php");
  require_once("../model/user.php");
  $user = new User();


  if ($_POST['action'] == 'filter-search-1') {
    $searchData = $_POST['dataSearch'];

    $promos = $user->obtener_promociones_cancha_filtrado($conn, $searchData);
    $html = '';

    if ($promos->rowCount() == 0) {
      $html .= '<div class="col-md-4 mx-auto">
      <div class="card card-body text-center border-info">
        <p>No hay promociones actualemente</p>
      </div>
    </div>';
      echo json_encode($html, JSON_UNESCAPED_UNICODE);
    } else {

      foreach ($promos as $promo) {
        $html .= '<div class="col-md-4 mb-3">
        <div class="card text-center border-warning">
          <div class="card-body">
            <h3 class="card-title text-capitalize">' . $promo["nombre_cancha"] . '</h3>
            <p class="m-2">' . $promo["nombre_promocion"] . '</p>
            <p class="m-2">Disciplina: ' . $promo["nombre_disciplina"] . '</p>
            <p class="m-2">Precio: ' . $promo["precio_disciplina"] . ' $</p>
            <p class="m-2">Promoción: - ' . $promo["descuento_promocion"] . ' %</p>

            <a href="add_reserve.php?id=' . $promo["cod_cancha"] . '" class="btn btn-danger mb-2">Reservar cancha</a>
          </div>
        </div>
      </div>';
      }
      echo json_encode($html, JSON_UNESCAPED_UNICODE);
    }
  } elseif ($_POST['action'] == 'filter-search-2') {
    $searchData = $_POST['dataSearch'];

    $canchas = $user->obtener_todas_canchas_disponibles_filtrado($conn, $searchData);
    $html = '';

    if ($canchas->rowCount() == 0) {
      $html .= '<div class="col-md-4 mx-auto">
      <div class="card card-body text-center border-info">
        <p>No hay canchas disponibles actualemente</p>
      </div>
    </div>';
      echo json_encode($html, JSON_UNESCAPED_UNICODE);
    } else {

      foreach ($canchas as $cancha) {
        $html .= '<div class="col-md-4 mb-3">
        <div class="card text-center border-warning">
          <div class="card-body">
            <h3 class="card-title text-capitalize">' . $cancha["nombre_cancha"] . '</h3>
            <p class="m-2">Disciplina: ' . $cancha["nombre_disciplina"] . '</p>
            <p class="m-2">Precio: ' . $cancha["precio_disciplina"] . ' $</p>

            <a href="add_reserve.php?id=' . $cancha["cod_cancha"] . '" class="btn btn-info mb-2">Reservar cancha</a>
          </div>
        </div>
      </div>';
      }
      echo json_encode($html, JSON_UNESCAPED_UNICODE);
    }
  }
}

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
  } elseif ($_POST['action'] == 'filter-my-reserve') {
    $searchData = $_POST['dataSearch'];
    $miId = $_POST['miId'];

    $mi_reserva = $user->obtener_mis_reservas_filtrado($conn, $miId, $searchData);
    $html = '';

    if ($mi_reserva->rowCount() == 0) {
      $html .= '<tr>
      <td colspan=7>
        <div class="col-md-4 mx-auto">
          <div class="card card-body text-center">
            <p>No se encontró resultados</p>
            <a>Agrega uno!</a>
          </div>
        </div>
      </td>
    </tr>';
      echo json_encode($html, JSON_UNESCAPED_UNICODE);
    } else {

      foreach ($mi_reserva as $reserva) {
        $html .= '<tr>
        <th>' . $reserva["nombre_cancha"] . '</th>
        <td>' . $reserva["nombre_disciplina"] . '</td>
        <td>' . $reserva["fecha_reserva"] . '</td>
        <td>' . $reserva["precio"] . ' $</td>
        <td>' . (($reserva["estado_reserva"] > 0) ? "ocupado" : "desocupado") . '</td>
        <td>' . $reserva["hora_inicio"] . ' - ' . $reserva["hora_fin"] . '</td>
        <td>' . $reserva["fecha_contrato_reserva"] . '</td>
        <td>
          <form class="d-none" action="" method="POST" id="form-' . $reserva["cod_reserva"] . '">
            <input value="' . $reserva["cod_reserva"] . '" name="id_reserva">
          </form>
          <button class="btn btn-outline-danger ml-1" form="form-' . $reserva["cod_reserva"] . '" type="submit">Imprimir
            <i class="fa-solid fa-file-pdf"></i>
          </button>
        </td>
      </tr>';
      }
      echo json_encode($html, JSON_UNESCAPED_UNICODE);
    }
  }
}

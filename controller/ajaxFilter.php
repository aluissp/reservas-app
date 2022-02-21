<?php

if ($_POST) {
  require_once("../database.php");
  require_once("../model/court.php");
  $court = new Curt();

  // Filtro de disciplinas
  if ($_POST['action'] == 'filter-discipline') {

    $searchData = $_POST['dataSearch'];
    $sql = "SELECT * FROM disciplina WHERE nombre_disciplina LIKE '%$searchData%'";
    $statement = $conn->prepare($sql);
    $statement->execute();


    $disciplinas = $statement;
    $html = '';

    if ($disciplinas->rowCount() == 0) {
      $html .= '
      <div class="col-md-4 mx-auto">
        <div class="card card-body text-center">
          <p>No hay resultados</p>
          <a href="add_skill.php">Agrega uno!</a>
        </div>
      </div>';
      echo json_encode($html, JSON_UNESCAPED_UNICODE);
    } else {

      foreach ($disciplinas as $disciplina) {
        $html .= '<div class="col-md-4 mb-3">
          <div class="card text-center">
            <div class="card-body">
              <h3 class="card-title text-capitalize">' . $disciplina["nombre_disciplina"] . '</h3>
              <p class="m-2">$ ' . $disciplina["precio_disciplina"] . '</p>

              <a href="offer.php?id_disciplina=' . $disciplina["cod_disciplina"] . '" class="btn btn-outline-info mb-2 col-7">Promocionar</a>

              <a href="edit_skill.php?id_disciplina=' . $disciplina["cod_disciplina"] . '" class="btn btn-outline-warning mb-2 col-7 p-2">Editar disciplina</a>

              <form class="d-none" action="home.php?id_disciplina=' . $disciplina["cod_disciplina"] . '" method="POST" id="form-' . $disciplina["cod_disciplina"] . '">
                <input value="delete_skill" name="action">
              </form>
              <button class="btn btn-danger mb-2" form="form-' . $disciplina["cod_disciplina"] . '" type="submit">Borrar disciplina</button>
            </div>
          </div>
        </div>';
      }
      echo json_encode($html, JSON_UNESCAPED_UNICODE);
    }
  } elseif ($_POST['action'] == 'get_court') {
    $id_court = $_POST['id_court'];

    $statement = $court->obtener_cancha($conn, $id_court);
    $cancha = $statement->fetch(PDO::FETCH_ASSOC);
    echo json_encode($cancha, JSON_UNESCAPED_UNICODE);
  } elseif ($_POST['action'] == 'filter-court') {

    $searchData = $_POST['dataSearch'];

    $canchas = $court->filtro_canchas($conn, $searchData);
    $html = '';

    if ($canchas->rowCount() == 0) {
      $html .= '
      <tr>
        <td colspan=4>
          <div class="col-md-4 mx-auto">
          <div class="card card-body text-center">
          <p>No hay resultados</p>
          <a>Agrega uno!</a>
          </div>
          </div>
        </td>
      </tr>';
      echo json_encode($html, JSON_UNESCAPED_UNICODE);
    } else {

      foreach ($canchas as $cancha) {
        $status = ($cancha["estado_cancha"] > 0) ? "ocupado" : "desocupado";
        $html .= '<tr>
        <th>' . $cancha["nombre_cancha"] . '</th>
        <td>' . $cancha["nombre_disciplina"] . '</td>
        <td>' . $status . '</td>
        <td>
          <button class="btn btn-outline-warning col-5" id="' . $cancha["cod_cancha"] . '">Editar</button>
          <form class="d-none" action="court.php?delete=1" method="POST" id="form-' . $cancha["cod_cancha"] . '">
            <input value="' . $cancha["cod_cancha"] . '" name="id_cancha">
          </form>
          <button class="btn btn-outline-danger ml-1 col-5" form="form-' . $cancha['cod_cancha'] . '" type="submit">Eliminar</button>
        </td>
      </tr>';
      }
      echo json_encode($html, JSON_UNESCAPED_UNICODE);
    }
  }
}

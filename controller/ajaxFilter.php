<?php

if ($_POST) {
  require_once("../Modelo/cls_conexion.php");
  require('../Controlador/pdfSimple.php');

  $conection = $class->conectar();

  // Filtro de canchas
  if ($_POST['action'] == 'searchCanchaKey') {

    $searchData = $_POST['dataSearch'];
    $sentencia = "SELECT
						canchas.id AS id_cancha,
						canchas.nombre AS cancha_nombre,
						disciplinas.nombre AS disciplina,
						disciplinas.id AS id_disciplina
						FROM canchas
						INNER JOIN disciplinas ON disciplinas.id=canchas.id_disciplina WHERE
            canchas.nombre LIKE '%$searchData%' OR
            disciplinas.nombre LIKE '%$searchData%'";

    $query_select = mysqli_query($conection, $sentencia);
    $num_rows = mysqli_num_rows($query_select);
    if ($num_rows > 0) {
      $htmlTable = '';
      while ($row = mysqli_fetch_assoc($query_select)) {
        $htmlTable .= '<tr>
	      <td>' . $row["cancha_nombre"] . '</td>
	      <td>' . strtoupper($row["disciplina"]) . '</td>
	      <td><a href="modificar_cancha.php?valor=' . $row["id_cancha"] . '"><img src="../Config/Img/editar.png" width="20"></img></a></td>
	      <td><a href="eliminar_cancha.php?valor=' . $row["id_cancha"] . '"><img src="../Config/Img/eliminar.png" width="30"></img></a></td>
	    </tr>';
      }
      echo json_encode($htmlTable, JSON_UNESCAPED_UNICODE);
    } else {
      echo 'notData';
    }
  }

  if ($_POST['action'] == 'allCourts') {
    $sentencia = "SELECT
						canchas.id AS id_cancha,
						canchas.nombre AS cancha_nombre,
						disciplinas.nombre AS disciplina,
						disciplinas.id AS id_disciplina
						FROM canchas
						INNER JOIN disciplinas ON disciplinas.id=canchas.id_disciplina";
    $query_select = mysqli_query($conection, $sentencia);
    $num_rows = mysqli_num_rows($query_select);
    if ($num_rows > 0) {
      $htmlTable = '';
      while ($row = mysqli_fetch_assoc($query_select)) {
        $htmlTable .= '<tr>
	      <td>' . $row["cancha_nombre"] . '</td>
	      <td>' . strtoupper($row["disciplina"]) . '</td>
	      <td><a href="modificar_cancha.php?valor=' . $row["id_cancha"] . '"><img src="../Config/Img/editar.png" width="20"></img></a></td>
	      <td><a href="eliminar_cancha.php?valor=' . $row["id_cancha"] . '"><img src="../Config/Img/eliminar.png" width="30"></img></a></td>
	    </tr>';
      }
      echo json_encode($htmlTable, JSON_UNESCAPED_UNICODE);
    } else {
      echo 'notData';
    }
  }

  // Filtro de reservas
  if ($_POST['action'] == 'searchReservaKey') {
    $searchData = $_POST['dataSearch'];
    $fecha_inicio = $_POST['dtInicio'];
    $fecha_final = $_POST['dtFin'];

    if (strlen($fecha_inicio) > 0 and strlen($fecha_final) > 0) {
      $sentencia = "SELECT
			reservas.id AS id_reserva,
			reservas.cliente AS cliente_nombre,
			reservas.fecha_inicio,

			canchas.nombre AS cancha_nombre,

			disciplinas.nombre AS disciplina_nombre,
			disciplinas.duracion AS disciplina_duracion

			FROM reservas
			INNER JOIN canchas ON canchas.id=reservas.id_cancha
			INNER JOIN disciplinas ON disciplinas.id=canchas.id_disciplina
			WHERE (CAST(fecha_inicio AS DATE) BETWEEN '$fecha_inicio' AND '$fecha_final')
      AND (reservas.cliente LIKE '%$searchData%'
      OR canchas.nombre LIKE '%$searchData%')";
    } else {
      $sentencia = "SELECT
			reservas.id AS id_reserva,
			reservas.cliente AS cliente_nombre,
			reservas.fecha_inicio,

			canchas.nombre AS cancha_nombre,

			disciplinas.nombre AS disciplina_nombre,
			disciplinas.duracion AS disciplina_duracion

			FROM reservas
			INNER JOIN canchas ON canchas.id=reservas.id_cancha
			INNER JOIN disciplinas ON disciplinas.id=canchas.id_disciplina
			WHERE reservas.cliente LIKE '%$searchData%'
      OR canchas.nombre LIKE '%$searchData%'";
    }

    $query_select = mysqli_query($conection, $sentencia);
    $num_rows = mysqli_num_rows($query_select);
    if ($num_rows > 0) {
      $htmlTable = '';
      while ($row = mysqli_fetch_assoc($query_select)) {

        $minutes_to_add = $row["disciplina_duracion"];

        $time = new DateTime($row["fecha_inicio"]);
        $time->add(new DateInterval('PT' . $minutes_to_add . 'M'));
        $stamp = $time->format('H:i');

        $horario = substr(explode(" ", $row["fecha_inicio"])[1], 0, 5) . "h - " . $stamp . "h";

        $htmlTable .= '<tr>
	      <td>' . $row["cancha_nombre"] . '</td>
	      <td>' . strtoupper($row["disciplina_nombre"]) . '</td>
	      <td>' . $row["cliente_nombre"] . '</td>
	      <td>' . $row["fecha_inicio"] . '</td>
	      <td>' . $horario . '</td>
	      <td><a href="modificar_reserva.php?valor=' . $row["id_reserva"] . '"><img src="../Config/Img/editar.png" width="20"></img></a></td>
	      <td><a href="eliminar_reserva.php?valor=' . $row["id_reserva"] . '"><img src="../Config/Img/eliminar.png" width="30"></img></a></td>
	    </tr>';
      }
      echo json_encode($htmlTable, JSON_UNESCAPED_UNICODE);
    } else {
      echo 'notData';
    }
  }

  if ($_POST['action'] == 'allReserve') {
    $sentencia = "SELECT
			reservas.id AS id_reserva,
			reservas.cliente AS cliente_nombre,
			reservas.fecha_inicio,

			canchas.nombre AS cancha_nombre,

			disciplinas.nombre AS disciplina_nombre,
			disciplinas.duracion AS disciplina_duracion

			FROM reservas
			INNER JOIN canchas ON canchas.id=reservas.id_cancha
			INNER JOIN disciplinas ON disciplinas.id=canchas.id_disciplina
			";
    $query_select = mysqli_query($conection, $sentencia);
    $num_rows = mysqli_num_rows($query_select);
    if ($num_rows > 0) {
      $htmlTable = '';
      while ($row = mysqli_fetch_assoc($query_select)) {

        $minutes_to_add = $row["disciplina_duracion"];

        $time = new DateTime($row["fecha_inicio"]);
        $time->add(new DateInterval('PT' . $minutes_to_add . 'M'));
        $stamp = $time->format('H:i');

        $horario = substr(explode(" ", $row["fecha_inicio"])[1], 0, 5) . "h - " . $stamp . "h";

        $htmlTable .= '<tr>
	      <td>' . $row["cancha_nombre"] . '</td>
	      <td>' . strtoupper($row["disciplina_nombre"]) . '</td>
	      <td>' . $row["cliente_nombre"] . '</td>
	      <td>' . $row["fecha_inicio"] . '</td>
	      <td>' . $horario . '</td>
	      <td><a href="modificar_reserva.php?valor=' . $row["id_reserva"] . '"><img src="../Config/Img/editar.png" width="20"></img></a></td>
	      <td><a href="eliminar_reserva.php?valor=' . $row["id_reserva"] . '"><img src="../Config/Img/eliminar.png" width="30"></img></a></td>
	    </tr>';
      }
      echo json_encode($htmlTable, JSON_UNESCAPED_UNICODE);
    } else {
      echo 'notData';
    }
  }

  // PDF reservas
  if ($_POST['action'] == 'printReserva') {
    $searchData = $_POST['dataSearch'];
    $fecha_inicio = $_POST['dtInicio'];
    $fecha_final = $_POST['dtFin'];

    if (strlen($fecha_inicio) > 0 and strlen($fecha_final) > 0) {
      $sentencia = "SELECT
			reservas.id AS id_reserva,
			reservas.cliente AS cliente_nombre,
			reservas.fecha_inicio,

			canchas.nombre AS cancha_nombre,

			disciplinas.nombre AS disciplina_nombre,
			disciplinas.duracion AS disciplina_duracion

			FROM reservas
			INNER JOIN canchas ON canchas.id=reservas.id_cancha
			INNER JOIN disciplinas ON disciplinas.id=canchas.id_disciplina
			WHERE (CAST(fecha_inicio AS DATE) BETWEEN '$fecha_inicio' AND '$fecha_final')
      AND (reservas.cliente LIKE '%$searchData%'
      OR canchas.nombre LIKE '%$searchData%')";
    } else {
      $sentencia = "SELECT
			reservas.id AS id_reserva,
			reservas.cliente AS cliente_nombre,
			reservas.fecha_inicio,

			canchas.nombre AS cancha_nombre,

			disciplinas.nombre AS disciplina_nombre,
			disciplinas.duracion AS disciplina_duracion

			FROM reservas
			INNER JOIN canchas ON canchas.id=reservas.id_cancha
			INNER JOIN disciplinas ON disciplinas.id=canchas.id_disciplina
			WHERE reservas.cliente LIKE '%$searchData%'
      OR canchas.nombre LIKE '%$searchData%'";
    }

    $query_select = mysqli_query($conection, $sentencia);
    $num_rows = mysqli_num_rows($query_select);
    if ($num_rows > 0) {
      // Creación del objeto de la clase heredada
      $pdf->AliasNbPages();
      $pdf->AddPage(); //añade l apagina / en blanco
      $pdf->SetMargins(10, 10, 10);
      $pdf->SetAutoPageBreak(true, 20); //salto de pagina automatico
      $pdf->SetX(15);
      $pdf->SetFont('Helvetica', 'B', 15);
      $pdf->Cell(10, 8, 'Cancha', 1, 0, 'C', 0);
      $pdf->Cell(60, 8, 'Disciplina', 1, 0, 'C', 0);
      $pdf->Cell(80, 8, 'Cliente', 1, 0, 'C', 0);
      $pdf->Cell(80, 8, 'Fecha', 1, 0, 'C', 0);
      $pdf->Cell(35, 8, 'Horario', 1, 1, 'C', 0);

      $pdf->SetFillColor(233, 229, 235); //color de fondo rgb
      $pdf->SetDrawColor(61, 61, 61); //color de linea  rgb

      $pdf->SetFont('Arial', '', 12);
      //El ancho de las celdas
      $pdf->SetWidths(array(10, 60, 80, 35));

      while ($row = mysqli_fetch_assoc($query_select)) {

        $minutes_to_add = $row["disciplina_duracion"];

        $time = new DateTime($row["fecha_inicio"]);
        $time->add(new DateInterval('PT' . $minutes_to_add . 'M'));
        $stamp = $time->format('H:i');

        $horario = substr(explode(" ", $row["fecha_inicio"])[1], 0, 5) . "h - " . $stamp . "h";

        $pdf->Row(array(
          $row["cancha_nombre"],
          strtoupper($row["disciplina_nombre"]),
          $row["cliente_nombre"],
          $row["fecha_inicio"],
          $horario
        ), 15);
      }

      // cell(ancho, largo, contenido,borde?, salto de linea?)

    }
    // echo $pdf; $pdf->Output("nombre_archivo.pdf", "D"); //Salida al navegador
    $pdf->Output("reporte_reserva.pdf", "D");
  }
}

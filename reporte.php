<?php
require('fpdf/fpdf.php');
date_default_timezone_set('America/Guayaquil');

// Aqui requerimos nuestra conecion y la consula a la BDD
session_start();
require "database.php";

if (!isset($_SESSION["user"])) {
  header("Location: ../view/login.php");
  return;
}

require_once('model/user.php');
$user = new User();
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $id_reserva = $_POST['id_reserva'];
  $mi_reserva = $user->obtener_mi_reserva_pdf($conn, $_SESSION['user']['cod_cliente'], $id_reserva);

  define('MI_RESERVA', $mi_reserva);

  class PDF extends FPDF
  {
    function Header()
    {

      $this->setY(12);
      $this->setX(10);

      $this->Image('./static/img/shinheky.png', 25, 5, 33);

      $this->SetFont('times', 'B', 13);

      $this->Text(75, 15, utf8_decode('NUEVO AMANECER S.A.'));

      $this->Text(77, 21, utf8_decode('6ª av. Eloy Alfaro, Ibarra'));
      $this->Text(88, 27, utf8_decode('Tel: 7785-8223'));
      $this->Text(88, 33, utf8_decode('Cel: 0978563451'));
      $this->Text(78, 39, utf8_decode('nuevoamanecer@gmail.com'));

      $this->Image('./static/img/shinheky.png', 160, 5, 33);

      //información de # de factura
      $this->SetFont('Arial', 'B', 10);
      $this->Text(150, 48, utf8_decode('REPORTE N°:'));
      $this->SetFont('Arial', '', 10);
      $this->Text(176, 48, MI_RESERVA['cod_reserva']);



      // Agregamos los datos del cliente
      $this->SetFont('Arial', 'B', 10);
      $this->Text(10, 48, utf8_decode('Fecha:'));
      $this->SetFont('Arial', '', 10);
      $this->Text(25, 48, date('d/m/Y'));




      // Agregamos los datos de la factura
      $this->SetFont('Arial', 'B', 10);
      $this->Text(10, 54, utf8_decode('Cliente:'));
      $this->SetFont('Arial', '', 10);
      $this->Text(25, 54, $_SESSION['user']['nombre_cliente'] . ' ' . $_SESSION['user']['apellido_cliente']);

      $this->SetFont('Arial', 'B', 10);
      $this->Text(10, 60, utf8_decode('Dirección:'));
      $this->SetFont('Arial', '', 10);
      $this->Text(30, 60, $_SESSION['user']['dir_cliente']);

      $this->SetFont('Arial', 'B', 10);
      $this->Text(10, 66, utf8_decode('Email:'));
      $this->SetFont('Arial', '', 10);
      $this->Text(24, 66, $_SESSION['user']['correo_cliente']);

      $this->SetFont('Arial', 'B', 10);
      $this->Text(10, 72, utf8_decode('Teléfono:'));
      $this->SetFont('Arial', '', 10);
      $this->Text(30, 72, $_SESSION['user']['tel_cliente']);

      $this->Ln(50);
    }

    function Footer()
    {
      $this->SetFont('helvetica', 'B', 8);
      $this->SetY(-15);
      $this->Cell(95, 5, utf8_decode('Página ') . $this->PageNo() . ' / {nb}', 0, 0, 'L');
      $this->Cell(95, 5, date('d/m/Y | g:i:a'), 00, 1, 'R');
      $this->Line(10, 287, 200, 287);
      $this->Cell(0, 5, utf8_decode("Nuevo amanecer © Todos los derechos reservados."), 0, 0, "C");
    }

    var $widths;
    var $aligns;

    function SetWidths($w)
    {
      //Set the array of column widths
      $this->widths = $w;
    }

    function SetAligns($a)
    {
      //Set the array of column alignments
      $this->aligns = $a;
    }

    function Row($data)
    {
      //Calculate the height of the row
      $nb = 0;
      for ($i = 0; $i < count($data); $i++)
        $nb = max($nb, $this->NbLines($this->widths[$i], $data[$i]));
      $h = 5 * $nb;
      //Issue a page break first if needed
      $this->CheckPageBreak($h);
      //Draw the cells of the row
      for ($i = 0; $i < count($data); $i++) {
        $w = $this->widths[$i];
        $a = isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
        //Save the current position
        $x = $this->GetX();
        $y = $this->GetY();
        //Draw the border
        $this->Rect($x, $y, $w, $h);
        //Print the text
        $this->MultiCell($w, 5, $data[$i], 0, $a);
        //Put the position to the right of the cell
        $this->SetXY($x + $w, $y);
      }
      //Go to the next line
      $this->Ln($h);
    }

    function CheckPageBreak($h)
    {
      //If the height h would cause an overflow, add a new page immediately
      if ($this->GetY() + $h > $this->PageBreakTrigger)
        $this->AddPage($this->CurOrientation);
    }

    function NbLines($w, $txt)
    {
      //Computes the number of lines a MultiCell of width w will take
      $cw = &$this->CurrentFont['cw'];
      if ($w == 0)
        $w = $this->w - $this->rMargin - $this->x;
      $wmax = ($w - 2 * $this->cMargin) * 1000 / $this->FontSize;
      $s = str_replace("\r", '', $txt);
      $nb = strlen($s);
      if ($nb > 0 and $s[$nb - 1] == "\n")
        $nb--;
      $sep = -1;
      $i = 0;
      $j = 0;
      $l = 0;
      $nl = 1;
      while ($i < $nb) {
        $c = $s[$i];
        if ($c == "\n") {
          $i++;
          $sep = -1;
          $j = $i;
          $l = 0;
          $nl++;
          continue;
        }
        if ($c == ' ')
          $sep = $i;
        $l += $cw[$c];
        if ($l > $wmax) {
          if ($sep == -1) {
            if ($i == $j)
              $i++;
          } else
            $i = $sep + 1;
          $sep = -1;
          $j = $i;
          $l = 0;
          $nl++;
        } else
          $i++;
      }
      return $nl;
    }
  }



  $pdf = new PDF();
  $pdf->AliasNbPages();
  $pdf->AddPage();
  $pdf->SetAutoPageBreak(true, 20);
  $pdf->SetTopMargin(15);
  $pdf->SetLeftMargin(10);
  $pdf->SetRightMargin(10);



  $pdf->setY(78);
  $pdf->setX(135);
  $pdf->Ln();
  // En esta parte estan los encabezados
  $pdf->SetFont('Arial', 'B', 10);
  $pdf->Cell(30, 7, utf8_decode('Nombre cancha'), 1, 0, 'C', 0);
  $pdf->Cell(60, 7, utf8_decode('Descripción'), 1, 0, 'C', 0);
  $pdf->Cell(20, 7, utf8_decode('Disciplina'), 1, 0, 'C', 0);
  $pdf->Cell(26, 7, utf8_decode('Fecha compra'), 1, 0, 'C', 0);
  $pdf->Cell(29, 7, utf8_decode('Fecha reservada'), 1, 0, 'C', 0);
  $pdf->Cell(20, 7, utf8_decode('Hora'), 1, 1, 'C', 0);

  $pdf->SetFont('Arial', '', 10);
  $pdf->SetWidths(array(30, 60, 20, 26, 29, 20));
  //Aqui inicia el llenado de la tabla con la reserva

  $pdf->Row(array(
    utf8_decode(MI_RESERVA['nombre_cancha']),
    utf8_decode(MI_RESERVA['obs_cancha']),
    utf8_decode(MI_RESERVA['nombre_disciplina']),
    utf8_decode(MI_RESERVA['fecha_contrato_reserva']),
    utf8_decode(MI_RESERVA['fecha_reserva']),
    utf8_decode(MI_RESERVA['hora_inicio'] . ' - ' . MI_RESERVA['hora_fin'])
  ));
  /*$pdf->Cell(30, 7, utf8_decode(MI_RESERVA['nombre_cancha']), 1, 0, 'L', 0);
  $pdf->Cell(85, 7, utf8_decode(MI_RESERVA['obs_cancha']), 1, 0, 'L', 0);
  $pdf->Cell(20, 7, utf8_decode(MI_RESERVA['nombre_disciplina']), 1, 0, 'R', 0);
  $pdf->Cell(25, 7, utf8_decode(MI_RESERVA['fecha_contrato_reserva']), 1, 0, 'R', 0);
  $pdf->Cell(25, 7, utf8_decode(MI_RESERVA['fecha_reserva']), 1, 1, 'R', 0);
  $pdf->Cell(25, 7, utf8_decode(MI_RESERVA['hora_inicio'] . ' - ' . MI_RESERVA['hora_fin']), 1, 1, 'R', 0);*/


  //// Apartir de aqui esta la tabla con los subtotales y totales

  $pdf->Ln(10);

  $pdf->setX(95);
  $pdf->Cell(40, 6, 'Cantidad', 1, 0);
  $pdf->Cell(60, 6, utf8_decode(MI_RESERVA['cantidad']), '1', 1, 'R');
  $pdf->setX(95);
  $pdf->Cell(40, 6, 'Total', 1, 0);
  $pdf->Cell(60, 6, utf8_decode(MI_RESERVA['precio'] . ' $'), '1', 1, 'R');




  $pdf->Output('I', 'Reporte_' . $_SESSION['user']['nombre_cliente'] . '_' . MI_RESERVA['cod_reserva'] . '.pdf', true);
}

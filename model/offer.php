<?php
class Offer
{
  protected $id;
  protected $nombre;
  protected $estado;
  protected $obs;
  protected $cod_disciplina;

  function __construct()
  {
    $this->id = '';
    $this->nombre = '';
    $this->estado = '';
    $this->obs = '';
    $this->cod_disciplina = '';
  }

  public function obtener_promocion($conn, $id_dis)
  {
    try {
      $sql = "SELECT * FROM promocion
      WHERE Disciplina_cod_disciplina = $id_dis";

      $canchas = $conn->query($sql);

      return $canchas;
    } catch (Exception $e) {
      echo 'Excepción capturada: ',  $e->getMessage(), "\n";
    }
  }

  public function obtener_nombre_disciplina($conn, $id_dis)
  {
    $disciplina = $conn->query("SELECT nombre_disciplina FROM disciplina WHERE cod_disciplina = $id_dis");
    return $disciplina;
  }

  public function registrar_promocion($conn, $name, $finicio, $ffin, $desc_p, $id_dis)
  {
    try {
      $sql = "INSERT INTO promocion (nombre_promocion, fechai_promocion,
      fechaf_promocion, descuento_promocion, Disciplina_cod_disciplina)
      VALUES (:name, :finicio, :ffin, :desc_p, :id_dis)";
      $conn
        ->prepare($sql)
        ->execute([
          ":name" => $name,
          ":finicio" => $finicio,
          ":ffin" => $ffin,
          ":desc_p" => $desc_p,
          ":id_dis" => $id_dis
        ]);
    } catch (Exception $e) {
      echo 'Excepción capturada: ',  $e->getMessage(), "\n";
    }
  }

  public function validar_fecha_promocion($conn, $id_dis, $finicio)
  {
    try {
      $sql = "SELECT fechaf_promocion FROM promocion
      WHERE Disciplina_cod_disciplina = $id_dis
      ORDER BY fechaf_promocion DESC LIMIT 1";

      $statement = $conn->query($sql)->fetch(PDO::FETCH_ASSOC);

      $lastffin = strtotime($statement['fechaf_promocion']);
      $newfinicio = strtotime($finicio);

      return ($newfinicio > $lastffin);
    } catch (Exception $e) {
      echo 'Excepción capturada: ',  $e->getMessage(), "\n";
    }
  }
  public function validar_fecha_promocion_actualizar($conn, $id_dis, $finicio, $ffin, $id_offer)
  {
    try {
      $val = false;

      $sql1 = "SELECT fechaf_promocion FROM promocion
      WHERE Disciplina_cod_disciplina = $id_dis
      ORDER BY fechaf_promocion DESC LIMIT 1";

      $statement1 = $conn->query($sql1)->fetch(PDO::FETCH_ASSOC);

      $sql2 = "SELECT fechai_promocion, fechaf_promocion FROM promocion
      WHERE Disciplina_cod_disciplina = $id_dis AND cod_promocion = $id_offer LIMIT 1";

      $statement2 = $conn->query($sql2)->fetch(PDO::FETCH_ASSOC);

      if (
        strtotime($finicio) == $statement2["fechai_promocion"] &&
        strtotime($ffin) == $statement2["fechaf_promocion"]
      ) {
        $val = true;
      } else {
        $lastffin = strtotime($statement1['fechaf_promocion']);
        $newfinicio = strtotime($finicio);
        $val = ($newfinicio > $lastffin);
      }


      return $val;
    } catch (Exception $e) {
      echo 'Excepción capturada: ',  $e->getMessage(), "\n";
    }
  }

  public function actualizar_promocion($conn, $name, $finicio, $ffin, $desc_p, $idOffer)
  {
    try {
      $sql = "UPDATE promocion SET nombre_promocion = :name, fechai_promocion = :finicio,
      fechaf_promocion = :ffin, descuento_promocion = :desc_p
      WHERE cod_promocion = :idOffer";
      $conn
        ->prepare($sql)
        ->execute([
          ":name" => $name,
          ":finicio" => $finicio,
          ":ffin" => $ffin,
          ":desc_p" => $desc_p,
          ":idOffer" => $idOffer
        ]);
    } catch (Exception $e) {
      echo 'Excepción capturada: ',  $e->getMessage(), "\n";
    }
  }
}

<?php
class Curt
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

  public function obtener_todas_canchas($conn, $id_empresa)
  {
    try {
      $sql = "SELECT cod_cancha, nombre_cancha, nombre_disciplina, obs_cancha, estado_cancha
      FROM cancha c INNER JOIN disciplina d ON c.Disciplina_cod_disciplina=d.cod_disciplina
      INNER JOIN empresa e ON d.empresa_cod_empresa = e.cod_empresa
      WHERE e.cod_empresa = $id_empresa";

      $canchas = $conn->query($sql);

      return $canchas;
    } catch (Exception $e) {
      echo 'Excepción capturada: ',  $e->getMessage(), "\n";
    }
  }
  public function obtener_todas_disciplinas($conn, $id_empresa)
  {
    try {
      $sql = "SELECT cod_disciplina, nombre_disciplina FROM disciplina d WHERE d.empresa_cod_empresa = $id_empresa";

      $disciplinas = $conn->query($sql);

      return $disciplinas;
    } catch (Exception $e) {
      echo 'Excepción capturada: ',  $e->getMessage(), "\n";
    }
  }

  public function validar_cancha($conn, $name)
  {
    try {
      $statement = $conn->prepare("SELECT nombre_cancha FROM cancha WHERE nombre_cancha = :nombre");
      $statement->bindParam(":nombre", $name);
      $statement->execute();

      return $statement->rowCount() > 0;
    } catch (Exception $e) {
      echo 'Excepción capturada: ',  $e->getMessage(), "\n";
    }
  }

  public function registrar_cancha($conn, $name, $status, $obs, $id_disciplina)
  {
    try {
      $sql = "INSERT INTO cancha (nombre_cancha, estado_cancha, obs_cancha, Disciplina_cod_disciplina) VALUES (:name, :status, :obs, :id_disciplina)";
      $conn
        ->prepare($sql)
        ->execute([
          ":name" => $name,
          ":status" => $status,
          ":obs" => $obs,
          ":id_disciplina" => $id_disciplina
        ]);
    } catch (Exception $e) {
      echo 'Excepción capturada: ',  $e->getMessage(), "\n";
    }
  }

  public function actualizar_cancha($conn, $name, $status, $obs, $id, $id_dis)
  {
    try {
      $statement = $conn->prepare("UPDATE cancha SET nombre_cancha = :name, estado_cancha = :status, obs_cancha = :obs, Disciplina_cod_disciplina = :id_dis WHERE cod_cancha = :id");
      $statement->execute([
        ":id" => $id,
        ":name" => $name,
        ":status" => $status,
        ":obs" => $obs,
        ":id_dis" => $id_dis
      ]);
    } catch (Exception $e) {
      echo 'Excepción capturada: ',  $e->getMessage();
    }
  }

  public function eliminar_cancha($conn, $id)
  {
    try {
      $conn
        ->prepare("DELETE FROM cancha WHERE cod_cancha = :id")
        ->execute([":id" => $id]);
    } catch (Exception $e) {
      echo 'Excepción capturada: ',  $e->getMessage();
    }
  }

  public function obtener_cancha($conn, $id_cancha)
  {
    $statement = $conn->prepare("SELECT * FROM cancha WHERE cod_cancha = :id_cancha");
    $statement->execute([":id_cancha" => $id_cancha]);
    return $statement;
  }

  public function tiene_registros_cancha($conn, $id)
  {
    try {
      $statement = $conn->prepare("SELECT * FROM detalle_reserva WHERE cancha_cod_cancha  = :id LIMIT 1");
      $statement->execute([":id" => $id]);

      return ($statement->rowCount() > 0);
    } catch (Exception $e) {
      echo 'Excepción capturada: ',  $e->getMessage();
    }
  }

  public function filtro_canchas($conn, $filtro)
  {
    try {
      $sql = "SELECT cod_cancha, nombre_cancha, nombre_disciplina, obs_cancha, estado_cancha
      FROM cancha c
      INNER JOIN disciplina d ON c.Disciplina_cod_disciplina=d.cod_disciplina
      WHERE nombre_cancha LIKE '%$filtro%' OR nombre_disciplina LIKE '%$filtro%'";

      $canchas = $conn->query($sql);

      return $canchas;
    } catch (Exception $e) {
      echo 'Excepción capturada: ',  $e->getMessage(), "\n";
    }
  }
}

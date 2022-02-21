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
}

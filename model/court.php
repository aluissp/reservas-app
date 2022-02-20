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
}

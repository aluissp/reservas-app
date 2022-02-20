<?php

class Admin
{
  protected $nombre;
  protected $name_agent;
  protected $ruc;
  protected $email;
  protected $direccion;
  protected $pass;
  protected $telefono;

  function __construct()
  {
    $this->nombre = "";
    $this->name_agent = "";
    $this->ruc = "";
    $this->email = "";
    $this->direccion = "";
    $this->pass = "";
    $this->telefono = "";
  }

  public function registrar_admin($conn, $name, $name_agent, $ruc, $email, $dir, $pass, $tel)
  {
    $sql = "INSERT INTO
      empresa (nombre_empresa, ruc_empresa, direccion_empresa, telefono_empresa, correo_empresa, password, representante_empresa)
      VALUES (:name, :ruc, :dir, :tel, :email, :pass, :name_agent)";

    $conn
      ->prepare($sql)
      ->execute([
        ":name" => $name,
        ":ruc" => $ruc,
        ":dir" => $dir,
        ":tel" => $tel,
        ":email" => $email,
        ":pass" => password_hash($pass, PASSWORD_BCRYPT),
        ":name_agent" => $name_agent
      ]);

    $statement = $conn->prepare("SELECT * FROM empresa WHERE correo_empresa = :email LIMIT 1");
    $statement->bindParam(":email", $email);
    $statement->execute();

    return $statement;
  }

  public function iniciar_sesion($conn, $email)
  {
    $statement = $conn->prepare("SELECT * FROM empresa WHERE correo_empresa = :email LIMIT 1");
    $statement->bindParam(":email", $email);
    $statement->execute();

    return $statement;
  }

  // Disciplina functions
  public function obtener_todas_disciplinas($conn, $id)
  {
    $disciplinas = $conn->query("SELECT * FROM disciplina WHERE empresa_cod_empresa = $id");
    return $disciplinas;
  }

  public function registrar_disciplina($conn, $name, $id_empresa, $price)
  {
    $sql = "INSERT INTO disciplina (nombre_disciplina, empresa_cod_empresa, precio_disciplina) VALUES (:name, :id_empresa, :price)";
    $conn
      ->prepare($sql)
      ->execute([
        ":name" => $name,
        ":id_empresa" => $id_empresa,
        ":price" => $price
      ]);
  }

  public function validar_disciplina($conn, $name)
  {
    $statement = $conn->prepare("SELECT nombre_disciplina FROM disciplina WHERE nombre_disciplina = :nombre");
    $statement->bindParam(":nombre", $name);
    $statement->execute();

    return $statement->rowCount() > 0;
  }

  public function obtener_disciplina($conn, $id_disciplina)
  {
    $statement = $conn->prepare("SELECT * FROM disciplina WHERE cod_disciplina = :id_disciplina");
    $statement->execute([":id_disciplina" => $id_disciplina]);
    return $statement;
  }

  public function actualizar_disciplina($conn, $id, $name, $price)
  {
    try {
      $statement = $conn->prepare("UPDATE disciplina SET nombre_disciplina = :name, precio_disciplina = :price WHERE cod_disciplina = :id");
      $statement->execute([
        ":id" => $id,
        ":name" => $name,
        ":price" => $price
      ]);
    } catch (Exception $e) {
      echo 'Excepción capturada: ',  $e->getMessage();
    }
  }

  public function eliminar_disciplina($conn, $id)
  {
    try {
      $conn
        ->prepare("DELETE FROM disciplina WHERE cod_disciplina = :id")
        ->execute([":id" => $id]);
    } catch (Exception $e) {
      echo 'Excepción capturada: ',  $e->getMessage();
    }
  }

  public function tiene_registros_disciplina($conn, $id)
  {
    try {
      $statement = $conn->prepare("SELECT * FROM cancha WHERE Disciplina_cod_disciplina  = :id LIMIT 1");
      $statement->execute([":id" => $id]);

      return ($statement->rowCount() > 0);
    } catch (Exception $e) {
      echo 'Excepción capturada: ',  $e->getMessage();
    }
  }
}

<?php

class User
{
  protected $nombre;
  protected $apellido;
  protected $direccion;
  protected $telefono;
  protected $correo;
  protected $genero;
  protected $fnacimiento;

  function __construct()
  {
    $this->nombre = "";
    $this->apellido = "";
    $this->direccion = "";
    $this->telefono = "";
    $this->correo = "";
    $this->genero = "";
    $this->fnacimiento = "";
  }

  public function validar_correo($conn, $email)
  {
    $statement = $conn->prepare("SELECT correo_cliente FROM cliente WHERE correo_cliente = :email");
    $statement->bindParam(":email", $email);
    $statement->execute();

    $statement2 = $conn->prepare("SELECT correo_empresa FROM empresa WHERE correo_empresa = :email");
    $statement2->bindParam(":email", $email);
    $statement2->execute();

    return ($statement->rowCount() > 0 || $statement2->rowCount() > 0);
  }

  public function registrar_usuario($conn, $name, $surname, $email, $dir, $pass, $gen, $tel, $fn)
  {
    $sql = "INSERT INTO
      cliente (nombre_cliente, apellido_cliente, dir_cliente, tel_cliente, correo_cliente, pass, genero_cliente, fn_cliente)
      VALUES (:name, :surname, :dir, :tel, :email, :pass, :gen, :fn)";

    $conn
      ->prepare($sql)
      ->execute([
        ":name" => $name,
        ":surname" => $surname,
        ":email" => $email,
        ":dir" => $dir,
        ":pass" => password_hash($pass, PASSWORD_BCRYPT),
        ":gen" => $gen,
        ":tel" => $tel,
        ":fn" => $fn
      ]);

    $statement = $conn->prepare("SELECT * FROM cliente WHERE correo_cliente = :email LIMIT 1");
    $statement->bindParam(":email", $email);
    $statement->execute();

    return $statement;
  }

  public function obtener_todas_reservas($conn, $id)
  {
    $reservas = $conn->query("SELECT * FROM reserva WHERE cliente_cod_cliente = $id");
    return $reservas;
  }

  public function iniciar_sesion($conn, $email)
  {
    $statement = $conn->prepare("SELECT * FROM cliente WHERE correo_cliente = :email LIMIT 1");
    $statement->bindParam(":email", $email);
    $statement->execute();

    return $statement;
  }
}

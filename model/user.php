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

  public function obtener_mis_reservas($conn, $id)
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

  public function obtener_promociones_cancha($conn)
  {
    try {
      $promos = $conn->query("SELECT cod_cancha, nombre_cancha, obs_cancha, nombre_disciplina, precio_disciplina, descuento_promocion, nombre_promocion
      FROM cancha c INNER JOIN disciplina d ON c.Disciplina_cod_disciplina = d.cod_disciplina
      INNER JOIN promocion p ON p.Disciplina_cod_disciplina = d.cod_disciplina
      WHERE c.estado_cancha = 0 AND p.fechaf_promocion >= CURRENT_DATE
      GROUP BY nombre_cancha");

      return $promos;
    } catch (Exception $e) {
      echo 'Excepción capturada: ',  $e->getMessage(), "\n";
    }
  }
  public function obtener_promociones_cancha_filtrado($conn, $filtro)
  {
    try {
      $promos = $conn->query("SELECT cod_cancha, nombre_cancha, obs_cancha, nombre_disciplina, precio_disciplina, descuento_promocion, nombre_promocion
      FROM cancha c INNER JOIN disciplina d ON c.Disciplina_cod_disciplina = d.cod_disciplina
      INNER JOIN promocion p ON p.Disciplina_cod_disciplina = d.cod_disciplina
      WHERE c.estado_cancha = 0 AND p.fechaf_promocion >= CURRENT_DATE
      AND (nombre_cancha LIKE '%$filtro%' OR nombre_disciplina LIKE '%$filtro%'
           OR precio_disciplina LIKE '%$filtro%' OR descuento_promocion LIKE '%$filtro%')
      GROUP BY nombre_cancha");

      return $promos;
    } catch (Exception $e) {
      echo 'Excepción capturada: ',  $e->getMessage(), "\n";
    }
  }

  public function obtener_todas_canchas_disponibles($conn)
  {
    try {
      $promos = $conn->query("SELECT cod_cancha, nombre_cancha, obs_cancha, nombre_disciplina, precio_disciplina
      FROM cancha c INNER JOIN disciplina d
      ON c.Disciplina_cod_disciplina = d.cod_disciplina
      WHERE c.estado_cancha = 0");

      return $promos;
    } catch (Exception $e) {
      echo 'Excepción capturada: ',  $e->getMessage(), "\n";
    }
  }

  public function obtener_todas_canchas_disponibles_filtrado($conn, $filtro)
  {
    try {
      $canchas = $conn->query("SELECT cod_cancha, nombre_cancha, obs_cancha, nombre_disciplina, precio_disciplina
      FROM cancha c INNER JOIN disciplina d
      ON c.Disciplina_cod_disciplina = d.cod_disciplina
      WHERE c.estado_cancha = 0
      AND (nombre_cancha LIKE '%$filtro%' OR precio_disciplina LIKE '%$filtro%')");

      return $canchas;
    } catch (Exception $e) {
      echo 'Excepción capturada: ',  $e->getMessage(), "\n";
    }
  }

  public function obtener_cancha($conn, $id_cancha)
  {
    try {
      $statement = $conn->query("SELECT cod_cancha, nombre_cancha, obs_cancha, nombre_disciplina, precio_disciplina, descuento_promocion, nombre_promocion
      FROM cancha c INNER JOIN disciplina d ON c.Disciplina_cod_disciplina = d.cod_disciplina
      INNER JOIN promocion p ON p.Disciplina_cod_disciplina = d.cod_disciplina
      WHERE c.estado_cancha = 0 AND p.fechaf_promocion >= CURRENT_DATE AND cod_cancha = $id_cancha
      GROUP BY nombre_cancha");

      $statement = $statement->fetch(PDO::FETCH_ASSOC);

      if (!isset($statement['descuento_promocion'])) {
        $statement = $conn->query("SELECT cod_cancha, nombre_cancha, obs_cancha, nombre_disciplina, precio_disciplina
        FROM cancha c INNER JOIN disciplina d
        ON c.Disciplina_cod_disciplina = d.cod_disciplina
        WHERE c.estado_cancha = 0 AND cod_cancha = $id_cancha");
        $statement = $statement->fetch(PDO::FETCH_ASSOC);
      }

      return $statement;
    } catch (Exception $e) {
      echo 'Excepción capturada: ', $e->getMessage(), "\n";
    }
  }

  public function obtener_fecha($conn, $id_cancha)
  {
    try {
      $statement = $conn->query("SELECT fechai_promocion, fechaf_promocion
      FROM cancha c INNER JOIN disciplina d ON c.Disciplina_cod_disciplina = d.cod_disciplina
      INNER JOIN promocion p ON p.Disciplina_cod_disciplina = d.cod_disciplina
      WHERE c.cod_cancha = $id_cancha AND fechaf_promocion >= CURRENT_DATE LIMIT 1");

      $statement = $statement->fetch(PDO::FETCH_ASSOC);

      if (!isset($statement['fechaf_promocion'])) {
        $statement = array();
      }
      $statement2 = $conn->query("SELECT fecha_reserva
        FROM cancha c INNER JOIN detalle_reserva dt ON c.cod_cancha = dt.cancha_cod_cancha
        INNER JOIN reserva r ON r.cod_reserva = dt.reserva_cod_reserva
        WHERE c.cod_cancha = $id_cancha
        ORDER BY fecha_reserva DESC
        LIMIT 1");
      $statement2 = $statement2->fetch(PDO::FETCH_ASSOC);

      if (isset($statement2['fecha_reserva'])) {
        $statement["ultima_fecha_reserva"] = $statement2["fecha_reserva"];
      }

      return $statement;
    } catch (Exception $e) {
      echo 'Excepción capturada: ', $e->getMessage(), "\n";
    }
  }
}

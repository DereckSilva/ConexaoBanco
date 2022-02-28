<?php

require_once __DIR__ . '/banco.php';

class Conexao extends Banco
{
  protected $matricula;

  public function __construct(string $usuario, int $senha, int $matricula)
  {
    parent::__construct($usuario, $senha);
    $this->matricula = $matricula;
  }

  public function conectarBanco()
  {
    return $this->conectaBanco();
  }

  //selecionando dados com base na matricula
  public function selecionaDados()
  {
    $stmt = $this->db->prepare('SELECT * FROM pessoa where idNome = ' . $this->matricula);

    $stmt->execute();

    while ($row = $stmt->fetch(PDO::FETCH_BOTH)) {
      echo "Nome: " . $row['nome'] . "\n" .
        "Idade: " . $row['idade'] . "\n" .
        "Altura: " . $row['altura'] . "\n" .
        "Sexo: " . $row['sexo'];
    }
  }
}

try {
  $teste = new Conexao("dereck", "123456", "1");
  $teste->conectarBanco();
  $teste->selecionaDados();
} catch (PDOException $e) {
  echo $e->getMessage();
}

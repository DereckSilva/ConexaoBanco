<?php

abstract class Banco
{
  protected $user;
  protected $pass;
  protected $db;
  protected $dsn;

  //métodos mágicos para não acessar atributos privados ou protegidos
  public function __set($atribute, $value)
  {
    return null;
  }

  public function __get($value)
  {
    return null;
  }

  //método mágico para retornar frase de método inexistente
  public function __call($name, $arguments)
  {
    echo "Esse método não existe";
  }

  public function __construct(string $usuario, int $senha)
  {
    $this->user = $usuario;
    $this->pass = $senha;
  }

  //acesso no banco
  protected function conectaBanco()
  {
    $this->dsn = "mysql:host=127.0.0.1;" .
      "port=3306;" .
      "dbname=dereck2";

    $this->db = new PDO($this->dsn, $this->user, $this->pass);
  }
}

<?php

require_once __DIR__ . '/geral.php';

class Funcionario extends Banco
{
  protected $matricula;

  public function __construct(string $user, int $senha, int $matricula)
  {
    parent::__construct($user, $senha);
    $this->matricula = $matricula;
  }

  public function conectaBanco()
  {
    return $this->conectaBanco();
  }

  //cria tabela para funcionários
  public function criaTabelaFunc()
  {
    $stmt = $this->db->prepare('CREATE TABLE funcionarios(
                                            mat_func int not null auto_increment,
                                            nome_func varchar(100),
                                            datNas_func date,
                                            email_func varchar(50),
                                            numCel_func varchar(20),
                                            primary key(mat_func);

    )');

    $stmt->execute();
  }

  //cria tabela de salarios
  public function criaTabelaSal()
  {
    $stmt = $this->db->prepare('CREATE TABLE salarios (
                                            idSal int not null auto_increment,
                                            salario float (10,2),
                                            mat_func int not null,
                                            primary key(idSal)
    )');

    $stmt->execute();
  }

  //faz a criação de colunas estrangeiras
  public function criaChaveEstrangeira()
  {
    $stmt = $this->db->prepare('ALTER TABLE salarios add constraint fk_salarios_funcionarios
                                foreign key(mat_func) references funcionarios(mat_func)
                                on delete no action
                                on update no action');

    $stmt->execute();
  }

  //insere dados na tabela de salarios
  public function insereDadosSal()
  {
    $stmt = $this->db->prepare('INSERT INTO salarios (idSal, salario, mat_func) VALUES (1468, 14500, 1548)');

    $stmt->execute();
  }

  //insere dados na tabela de funcionarios
  public function insereDadosFunc()
  {
    $stmt = $this->db->prepare('INSERT INTO funcionarios (
                                            mat_func,
                                            nome_func,
                                            datNas_func,
                                            email_func,
                                            numCel_func)
                                            VALUES (
                                            1548 ,
                                            "João Victor Gomes" ,
                                            "2000-05-30" ,
                                            "joaogomes12@gmail.com" ,
                                            "(19)98568-2145"
                                            )
    )');

    $stmt->execute();
  }

  //seleciona dados geral
  public function selecionaDados()
  {
    $stmt = $this->db->prepare('SELECT * FROM funcionarios f INNER JOIN salarios s 
                                ON (f.mat_func = s.mat_func) AND f.mat_func = ' . $this->matricula);

    $stmt->execute();

    while ($row = $stmt->fetch(PDO::FETCH_BOTH)) {
      echo "Nome: " . $row['nome_func'] . "\n" .
        "Data de Nascimento: " . $row['datNas_func'] . "\n" .
        "Email: " . $row['email_func'] . "\n" .
        "Número: " . $row['numCel_func'];
    }
  }
}

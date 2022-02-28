<?php

require_once __DIR__ . '/func.php';
require_once __DIR__ . '/conexao.php';

try {

  $db = new Funcionario("dereck", "123456", 14457);
  $db->conectaBanco();
  $db->selecionaDados();
} catch (PDOException $e) {
  echo $e->getMessage();
}

<?php
require_once 'config.php';
  $dadosa = $_GET['botaoat'];
  print_r($dadosa);


  echo "<form>";
  echo "<input type='text' name='idnomeup' placeholder='Nome da pessoa'>";
  echo "<input type='submit' name='botaoup' value='Atualizar'>";
  echo "</form>";
  $nome = $_GET['idnomeup'];
try {

  $dsn = "pgsql:host=$host;port=5432;dbname=$db;";
	// make a database connection
	$pdo = new PDO($dsn, $user, $password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

  $stmt = $pdo->prepare('UPDATE pessoas SET nome = :nome WHERE id = :id');
  $stmt->execute(array(
    ':id'   => $idup,
    ':nome' => $nome
  ));
  echo "<p>$nome cadastrado(a) com sucesso!</p>";

  echo $stmt->rowCount();
} catch(PDOException $e) {
  echo 'Error: ' . $e->getMessage();
}
?>
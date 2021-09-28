<?php
require_once 'config.php';
$nome = $_GET['idnomeup'];
$pessoaid = $_GET['idp'];

try {
    $dsn = "pgsql:host=$host;port=5432;dbname=$db;";
      // make a database connection
      $pdo = new PDO($dsn, $user, $password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    if($pdo){
      $stmt = $pdo->prepare('UPDATE pessoas SET nome = :nome WHERE id = :id');
      $stmt->execute(array(
        ':id'   => $pessoaid,
        ':nome' => $nome
      ));
    }
    echo "<p>$nome Atualizado com sucesso!</p>";
    header("Refresh:2; url=atividade.php");
  } catch(PDOException $e) {
    echo 'Error: ' . $e->getMessage();
  }
?>
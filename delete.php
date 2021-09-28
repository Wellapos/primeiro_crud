<?php
require_once 'config.php';

$id = $_GET['id'];

try {
    $dsn = "pgsql:host=$host;port=5432;dbname=$db;";
      // make a database connection
      $pdo = new PDO($dsn, $user, $password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

  $stmt = $pdo->prepare('DELETE FROM pessoas WHERE id = :id');
  $stmt->bindParam(':id', $id);
  $stmt->execute();

  echo "<p>Excluido com sucesso!</p>";
  header("Refresh:2; url=atividade.php");

} catch(PDOException $e) {
  echo 'Error: ' . $e->getMessage();
}
?>
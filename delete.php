<?php
require_once 'config.php';

$id = $_GET['id'];

try {
  $dsn = "pgsql:host=$host;port=5432;dbname=$db;";
  $pdo = new PDO($dsn, $user, $password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
  $stmt = $pdo->prepare('DELETE FROM pessoas WHERE id = :id');
  $stmt->bindParam(':id', $id);
  $stmt->execute();
  die(json_encode(array('message' => "Excluido com sucesso!", 'code' => 200)));
} catch(PDOException $e) {
  die(json_encode(array('message' => $e->getMessage(), 'code' => 500)));
}
?>
<html>
<head>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
</head>

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

  echo "<p style='color: green;'>Excluido com sucesso!</p>";
  header("Refresh:2; url=atividade.php");
} catch(PDOException $e) {
  echo 'Error: ' . $e->getMessage();
}
?>
</html>
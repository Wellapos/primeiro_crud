<html>
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
</head>
<?php
require_once 'config.php';
try {
	$dsn = "pgsql:host=$host;port=5432;dbname=$db;";
	// make a database connection
	$pdo = new PDO($dsn, $user, $password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

	if ($pdo) {
    $nome = $_GET['idnome'];
    $idade = $_GET['ididade'];
    $cpf = $_GET['idcpf'];

    $stmt = $pdo->prepare('INSERT INTO pessoas (nome, idade, cpf) VALUES(:nome, :idade, :cpf)');
    if(!empty($nome) && !empty($idade) && !empty($cpf)){
      $stmt->execute(array(
          ':nome' => $nome,
          ':idade' => $idade,
          ':cpf' => $cpf
      ));
    }
    header("Refresh:0; url=atividade.php");
	}
} catch (PDOException $e) {
	die($e);
}
?>
</html>
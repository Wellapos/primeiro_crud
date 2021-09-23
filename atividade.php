<?php

require_once 'config.php';

try {
	$dsn = "pgsql:host=$host;port=5432;dbname=$db;";
	// make a database connection
	$pdo = new PDO($dsn, $user, $password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
  $pessoas = $pdo->query('SELECT * FROM pessoas');

	if ($pdo) {
		echo "Connected to the $db database successfully!";
	}
} catch (PDOException $e) {
	die($e);
} finally {
	if ($pdo) {
		$pdo = null;
	}
}
?>
<!DOCTYPE html>
<html>
<head>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
</head>
  <body>
    <div class="container">
      <h1>Estamos aprendendo PHP!</h1>
      <table class="table">
        <thead>
          <tr class="table-dark">
            <th scope="col">Nome</th>
            <th scope="col">Idade</th>
            <th scope="col">CPF</th>
            <th scope="col">Tipo</th>
          </tr>
        </thead>
        <tbody>
          <?php
            foreach($pessoas as $pessoa){
              echo "<tr>";
              echo "<td class='table-secondary'>$pessoa[nome]</td>";
              echo "<td class='table-secondary'>$pessoa[idade]</td>";
              echo "<td class='table-secondary'>$pessoa[cpf]</td>";
              $idad = $pessoa['idade'];
              if($idad <= 12){
                echo "<td class='table-primary'>";
                echo "Criança";
                echo "</td>";
              }
              elseif($idad >= 13 && $idad <= 17){
                echo "<td class='table-success'>";
                echo "Adolescente";
                echo "</td>";
              }
              else{
                echo "<td class='table-info'>";
                echo "Adulto";
                echo "</td>";
              }
              echo "</tr>";
            }
          ?>
          <?php
            $idnome   = $_GET['idnome'];
            $ididade  = $_GET['ididade'];
            $idcpf    = $_GET['cpf'];
            echo "<td class='table-secondary'>$idnome</td>";
            echo "<td class='table-secondary'>$ididade</td>";
            echo "<td class='table-secondary'>$idcpf</td>";
            if($ididade <= 12){
              echo "<td class='table-primary'>";
              echo "Criança";
              echo "</td>";
            }
            elseif($ididade >= 13 && $ididade <= 17){
              echo "<td class='table-success'>";
              echo "Adolescente";
              echo "</td>";
            }
            else{
              echo "<td class='table-info'>";
              echo "Adulto";
              echo "</td>";
            }
          ?>
        </tbody>
      </table>
      <form action="create.php">
        <input type="text" name="idnome" placeholder="Nome">
        <input type="number" name="ididade" placeholder="Idade">
        <input type="number" name="cpf" placeholder="CPF">
        <input type="submit" name="botao" value="Adicionar">
      </form>
    </div>
  </body>
</html>
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
        $stmt->execute(array(
            ':nome' => $nome,
            ':idade' => $idade,
            ':cpf' => $cpf
        ));
        echo "<p>$nome cadastrado(a) com sucesso!</p>";
        header("Refresh:2; url=atividade.php");
	}
} catch (PDOException $e) {
	die($e);
}
?>
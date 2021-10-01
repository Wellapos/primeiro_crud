<html>
<head>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<h1 class="container">Editar Cadastro</h1>
<?php
require_once 'config.php';

$pessoaid = $_GET['id'];
$nome = '';
$idade = '';
$cpf = '';

$dsn = "pgsql:host=$host;port=5432;dbname=$db;";
$pdo = new PDO($dsn, $user, $password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
$sql = "SELECT * FROM pessoas WHERE id = :id";

if($stmt = $pdo->prepare($sql)){
    $stmt->bindParam(":id", $pessoaid);
    
    if($stmt->execute()){
        if($stmt->rowCount() == 1){
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
            $nome = $row["nome"];
            $idade = $row["idade"];
            $cpf = $row["cpf"];
        } else{
            echo("error");
            exit();
        }
    } else{
        echo "Oops! Something went wrong. Please try again later.";
    }
}


echo"<form action='sucesso.php' class='container'>
    <label class='form-label'>Nome:</label>
    <input type='text' name='nome' placeholder='Nome da pessoa' value='$nome' class='form-control'>
    <label class='form-label'>Idade:</label>
    <input type='number' name='idade' placeholder='Idade da pessoa' value='$idade' class='form-control'>
    <label class='form-label'>CPF:</label>
    <input type='text' name='cpf' placeholder='CPF da pessoa' value='$cpf' class='form-control'>
    <input type='hidden' name='idp' value='$pessoaid'>
    <input type='submit' name='botaoup' value='Atualizar' class='btn btn-success'>
    <a href='atividade.php' class='btn btn-danger'>Voltar</a>
    </form>";
?>
</html>
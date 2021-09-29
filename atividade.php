<?php
require_once 'config.php';
try {
	$dsn = "pgsql:host=$host;port=5432;dbname=$db;";
	// make a database connection
	$pdo = new PDO($dsn, $user, $password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
  $pessoas = $pdo->query('SELECT * FROM pessoas');

	if ($pdo) {
	//	echo "Connected to the $db database successfully!";
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
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
  <body>
      <template id="my-template">
      <swal-title>
        Save changes to "Untitled 1" before closing?
      </swal-title>
      <swal-icon type="warning" color="red"></swal-icon>
      <swal-button type="confirm">
        Save As
      </swal-button>
      <swal-button type="cancel">
        Cancel
      </swal-button>
      <swal-button type="deny">
        Close without Saving
      </swal-button>
      <swal-param name="allowEscapeKey" value="false" />
      <swal-param
        name="customClass"
        value='{ "popup": "my-popup" }' />
    </template>
    <div class="container">
      <h1>Cadastro de pessoas!</h1>
      <table class="table">
        <thead>
          <tr class="table-dark">
            <th scope="col">Nome</th>
            <th scope="col">Idade</th>
            <th scope="col">CPF</th>
            <th scope="col">Tipo</th>
            <th scope="col">Editar</th>
          </tr>
        </thead>
        <tbody>
          <?php
            foreach($pessoas as $pessoa){
              echo "<tr>";
              echo "<td class='table-secondary' name='botaoat'>".strtoupper($pessoa[nome])."</td>";
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
              echo "<td class='table-secondary'> <a href='update.php?id=$pessoa[id]' class='btn btn-success'>Editar</a><a href='delete.php?id=$pessoa[id]' class='btn btn-danger'>Excluir</td>";
              echo "</tr>";
            }
          ?>
          <?php
            if($idad){
            }
            elseif($ididade <= 12){
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
      <div>
        <form action="create.php">
          <h3>Adicionar pessoas</h3>
          <div class="container">
            <label class="form-label">Nome:</label>
            <input type="text" name="idnome" placeholder="Nome da pessoa" class="form-control">
            <label class="form-label">Idade:</label>
            <input type="number" name="ididade" placeholder="Idade" class="form-control">
            <label class="form-label">CPF:</label>
            <input type="number" name="idcpf" placeholder="CPF" class="form-control">
            <input type="submit" name="botao" value="Adicionar" class="btn btn-outline-secondary">
          </div>
        </form>
      </div>
    </div>
  </body>
</html>
<?php
require_once 'config.php';
try {
	$dsn = "pgsql:host=$host;port=5432;dbname=$db;";
	// make a database connection
	$pdo = new PDO($dsn, $user, $password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
  $pessoas = $pdo->query('SELECT * FROM pessoas ORDER BY nome');

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
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cadastro de pessoas</title>
  <script type="text/javascript" src="jquery/jquery-3.6.0.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
  <body>
    <div class="container">
      <div class="row">
        <div class="col-6">
          <h3>Cadastro de pessoas!</h3>
        </div>
        <div class="col-6 text-end">
          <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Adicionar Pessoas
          </button>
        </div>
      </div>

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
            echo "<tr id='linha-$pessoa[id]'>";
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
            echo "<td class='table-secondary'> <a href='update.php?id=$pessoa[id]' class='btn btn-success'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil-square' viewBox='0 0 16 16'>
            <path d='M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z'/>
            <path fill-rule='evenodd' d='M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z'/>
            </svg></a>";
            echo "<a href='delete.php?id=$pessoa[id]' class='btn btn-danger' onclick='confirmation(event, $pessoa[id])'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash-fill' viewBox='0 0 16 16'>
            <path d='M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z'/>
            </svg></a></td>";
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


    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Dados da pessoa</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form action="create.php">
                <div class="container">
                  <label class="form-label">Nome:</label>
                  <input type="text" name="idnome" placeholder="Nome da pessoa" class="form-control">
                  <label class="form-label">Idade:</label>
                  <input type="number" name="ididade" placeholder="Idade" class="form-control">
                  <label class="form-label">CPF:</label>
                  <input type="number" name="idcpf" placeholder="CPF" class="form-control">
                </div>
              </div>
                <div class="modal-footer">
                <input type="submit" name="botao" value="Adicionar" class="btn btn-outline-secondary">
            </form>
          </div>
        </div>
      </div>
    </div>

    <script>
      function confirmation(ev, id) {
        ev.preventDefault();

        Swal.fire({
          title: 'Realmente deseja excluir?',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Sim, excluir!'
        }).then((result) => {
          if (result.isConfirmed == true){
            $.ajax({
              url: 'delete.php',
              type: 'GET',
              data: 'id=' + id,
            })
            .done(function(response) {
              resposta = JSON.parse(response);
                if (resposta["code"] == 200){
                  Swal.fire('Sucesso', resposta["message"], 'success')
                  $('#linha-'+id).fadeOut();
                }else{
                  Swal.fire('Oops...', resposta["message"], 'error')
                }
            })
            .fail(function() {
                Swal.fire('Oops...', 'Algo deu errado!', 'error')
            });
          }
        });
      }
    </script>
  </body>
</html>
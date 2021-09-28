<?php
require_once 'config.php';
$pessoaid = $_GET['id'];
$nome = $_GET['idnomeup'];
echo "<form action='sucesso.php'>";
echo "<input type='text' name='idnomeup' placeholder='Nome da pessoa'>";
echo " <input type='hidden' name='idp' value='$pessoaid'>";
echo "<input type='submit' name='botaoup' value='Atualizar'>";
echo "</form>";
?>
<?php
$servidor = "localhost";
$usuario = "aluno";
$senha = "root";

$con = mysqli_connect($servidor, $usuario, $senha) or die ("Deu ruim");
mysqli_select_db($con, "produto") or die ("Deu ruim\n");
?>

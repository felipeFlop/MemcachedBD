<?php
include ('conexaoBD.php');

//Inicia o Memcache
$memcache = new Memcache;

//Define o servidor que será usado
$memcache->connect('localhost', 11211) or die ("Não foi possível se conectar");

$sql = "SELECT nome FROM produto";
$chave = md5($sql);

//Busca o resultado na memória
$cache = $memcache->get($chave);

//Verifica se o resultado não existe ou expirou
if($cache == false) {
	//Executa a consulta novamente
	$query = mysqli_query($con, $sql);
	$tempo = 60 * 60; //3600s
	while($dados = mysqli_fetch_assoc($query))
	$query = $dados;
	$memcache->set($chave, $query, 0, $tempo);
} else {
	//A consulta ainda está salva na memória, então é só
	//pegar o resultado
	$query = $cache;
}

foreach($query as $linha) {
	echo $linha['nome'];
	echo "\n";
}
?>

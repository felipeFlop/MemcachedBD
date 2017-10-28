<?php
include ('conexaoBD.php');
$memcache = new Memcache;
$memcache->connect('localhost', 11211) or die ("Não foi possível se conectar\n");


$chave = md5('lista nomes');
$cache_result = array();
$cache_result = $memcache->get($chave);
$resultado = null;
$sql = "SELECT nome FROM produto";

	if($cache_result) {
		$inicio = 0;
		$fim = 0;
		$inicio = microtime(true);
		$resultado = $cache_result;
		$fim = microtime(true);
		$total = $fim - $inicio;
		echo "Resultado 1 em $total\n";
	}else {
		$inicio = 0;
		$fim = 0;
		$inicio = microtime(true);
		$query=mysqli_query($con,$sql);
		while($row=mysqli_fetch_array($query))
		$resultado[]=$row;
		$memcache->set($chave, $resultado, 0, 100);
		$fim = microtime(true);
		$total = $fim - $inicio;
		echo "Resultado 2 em $total\n";
	}

foreach($resultado as $row) {
	echo $row['nome'];
	echo "\n";
}

?>

<?php

require('../config.php');

$method = strtolower($_SERVER['REQUEST_METHOD']);
if ($method === 'get') {

	$sql = $pdo->query("SELECT * FROM tamanho");
	if ($sql) {
		$data = $sql->fetchAll(PDO::FETCH_ASSOC);
		foreach ($data as $item) {
			$array['result'][] = [
				'tamanho' => $item['TAMANHO'],
				'sigla' => $item['SIGLA'],
				'descricao' => $item['DESCRICAO'],
				'valor' => $item['VALOR']
			];
		}
	}
} else {
	$array['error'] = 'Método não permitido (Apenas GET)';
}

require('../return.php');

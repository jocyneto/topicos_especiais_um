<?php

require('../config.php');

$method = strtolower($_SERVER['REQUEST_METHOD']);
if ($method === 'get') {

	$sql = $pdo->query("SELECT * FROM bebida");
	if ($sql) {
		$data = $sql->fetchAll(PDO::FETCH_ASSOC);
		foreach ($data as $item) {
			$array['result'][] = [
				'bebida' => $item['BEBIDA'],
				'descricao' => $item['DESCRICAO'],
				'valor' => $item['VALOR'],
				'imagem' => $item['IMAGEM']
			];
		}
	}
} else {
	$array['error'] = 'Método não permitido (Apenas GET)';
}

require('../return.php');

<?php

require('../config.php');

$method = strtolower($_SERVER['REQUEST_METHOD']);
if ($method === 'get') {

	$sql = $pdo->query("SELECT * FROM pizza");
	if ($sql) {
		$data = $sql->fetchAll(PDO::FETCH_ASSOC);
		foreach ($data as $item) {
			$array['result'][] = [
				'pizza' => $item['PIZZA'],
				'tamanho' => $item['TAMANHO'],
				'massa' => $item['MASSA'],
				'borda' => $item['BORDA'],
				'sabor' => $item['SABOR'],
				'valor' => $item['VALOR']
			];
		}
	}
} else {
	$array['error'] = 'Método não permitido (Apenas GET)';
}

require('../return.php');

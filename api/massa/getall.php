<?php

require('../config.php');

$method = strtolower($_SERVER['REQUEST_METHOD']);
if ($method === 'get') {

	$sql = $pdo->query("SELECT * FROM massa");
	if ($sql) {
		$data = $sql->fetchAll(PDO::FETCH_ASSOC);
		foreach ($data as $item) {
			$array['result'][] = [
				'massa' => $item['MASSA'],
				'descricao' => $item['DESCRICAO']
			];
		}
	}
} else {
	$array['error'] = 'Método não permitido (Apenas GET)';
}

require('../return.php');

<?php

require('../config.php');

$method = strtolower($_SERVER['REQUEST_METHOD']);
if ($method === 'get') {

	$sql = $pdo->query("SELECT * FROM usuario");
	if ($sql) {
		$data = $sql->fetchAll(PDO::FETCH_ASSOC);
		foreach ($data as $item) {
			$array['result'][] = [
				'usuario' => $item['USUARIO'],
				'grupo' => $item['GRUPO'],
				'email' => $item['EMAIL'],
				'cpf' => $item['CPF'],
				'senha' => $item['SENHA'],
				'nome' => $item['NOME'],
				'sobrenome' => $item['SOBRENOME'],
				'token' => $item['TOKEN']
			];
		}
	}
} else {
	$array['error'] = 'Método não permitido (Apenas GET)';
}

require('../return.php');
<?php

require('../config.php');


$method = strtolower($_SERVER['REQUEST_METHOD']);
if ($method === 'post') {

	$descricao = filter_input(INPUT_POST, 'descricao');

	if ($descricao) {
		$sql = $pdo->prepare("INSERT INTO grupo (descricao) VALUES (:descricao)");
		$sql->bindValue(':descricao', $descricao);
		$sql->execute();

		$grupo = $pdo->lastInsertId();

		$array['result'] = [
			'grupo' => $grupo,
			'descricao' => $descricao
		];
	} else {
		$array['error'] = 'Campos não enviados';
	}
} else {
	$array['error'] = 'Método não permitido (Apenas POST)';
}

require('../return.php');

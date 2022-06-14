<?php

require('../config.php');


$method = strtolower($_SERVER['REQUEST_METHOD']);
if ($method === 'post') {

	$descricao = filter_input(INPUT_POST, 'descricao');

	if ($descricao) {
		$sql = $pdo->prepare("INSERT INTO massa (descricao) VALUES (:descricao)");
		$sql->bindValue(':descricao', $descricao);
		$sql->execute();

		$massa = $pdo->lastInsertId();

		$array['result'] = [
			'massa' => $massa,
			'descricao' => $descricao
		];
	} else {
		$array['error'] = 'Campos não enviados';
	}
} else {
	$array['error'] = 'Método não permitido (Apenas POST)';
}

require('../return.php');

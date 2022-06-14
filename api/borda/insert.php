<?php

require('../config.php');


$method = strtolower($_SERVER['REQUEST_METHOD']);
if ($method === 'post') {

	$descricao = filter_input(INPUT_POST, 'descricao');
	$valor = filter_input(INPUT_POST, 'valor');

	if ($descricao && $valor) {
		$sql = $pdo->prepare("INSERT INTO borda (descricao, valor) VALUES (:descricao, :valor)");
		$sql->bindValue(':descricao', $descricao);
		$sql->bindValue(':valor', $valor);
		$sql->execute();

		$borda = $pdo->lastInsertId();

		$array['result'] = [
			'borda' => $borda,
			'descricao' => $descricao,
			'valor' => $valor
		];
	} else {
		$array['error'] = 'Campos não enviados';
	}
} else {
	$array['error'] = 'Método não permitido (Apenas POST)';
}

require('../return.php');

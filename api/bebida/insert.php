<?php

require('../config.php');


$method = strtolower($_SERVER['REQUEST_METHOD']);
if ($method === 'post') {

	$descricao = filter_input(INPUT_POST, 'descricao');
	$valor = filter_input(INPUT_POST, 'valor');
	$imagem = filter_input(INPUT_POST, 'imagem');

	if ($descricao) {
		$sql = $pdo->prepare("INSERT INTO bebida (descricao, valor, imagem) VALUES (:descricao, :valor, :imagem)");
		$sql->bindValue(':descricao', $descricao);
		$sql->bindValue(':valor', $valor);
		$sql->bindValue(':imagem', $imagem);
		$sql->execute();

		$bebida = $pdo->lastInsertId();

		$array['result'] = [
			'bebida' => $bebida,
			'descricao' => $descricao,
			'valor' => $valor,
			'imagem' => $imagem
		];
	} else {
		$array['error'] = 'Campos não enviados';
	}
} else {
	$array['error'] = 'Método não permitido (Apenas POST)';
}

require('../return.php');

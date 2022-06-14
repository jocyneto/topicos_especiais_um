<?php

require('../config.php');


$method = strtolower($_SERVER['REQUEST_METHOD']);
if ($method === 'post') {

	$sigla = filter_input(INPUT_POST, 'sigla');
	$descricao = filter_input(INPUT_POST, 'descricao');
	$valor = filter_input(INPUT_POST, 'valor');

	if ($descricao) {
		$sql = $pdo->prepare("INSERT INTO tamanho (sigla, descricao, valor) VALUES (:sigla, :descricao, :valor)");
		$sql->bindValue(':sigla', $sigla);
		$sql->bindValue(':descricao', $descricao);
		$sql->bindValue(':valor', $valor);
		$sql->execute();

		$tamanho = $pdo->lastInsertId();

		$array['result'] = [
			'tamanho' => $tamanho,
			'sigla' => $sigla,
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

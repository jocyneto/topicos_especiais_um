<?php

require('../config.php');


$method = strtolower($_SERVER['REQUEST_METHOD']);
if ($method === 'put') {

	parse_str(file_get_contents('php://input'), $input);

	$tamanho = $input['tamanho'] ?? null;
	$sigla = $input['sigla'] ?? null;
	$descricao = $input['descricao'] ?? null;
	$valor = $input['valor'] ?? null;

	$tamanho = filter_var($tamanho);
	$sigla = filter_var($sigla);
	$descricao = filter_var($descricao);
	$valor = filter_var($valor);

	if ($tamanho && $sigla && $descricao && $valor) {
		$sql = $pdo->prepare("SELECT * FROM tamanho WHERE tamanho = :tamanho");
		$sql->bindValue(':tamanho', $tamanho);
		$sql->execute();

		if ($sql->rowCount() > 0) {
			$sql = $pdo->prepare("UPDATE tamanho SET sigla = :sigla, descricao = :descricao, valor = :valor WHERE tamanho = :tamanho");
			$sql->bindValue(':tamanho', $tamanho);
			$sql->bindValue(':sigla', $sigla);
			$sql->bindValue(':descricao', $descricao);
			$sql->bindValue(':valor', $valor);
			$sql->execute();

			$array['result'] = [
				'tamanho' => $tamanho,
				'sigla' => $sigla,
				'descricao' => $descricao,
				'valor' => $valor
			];
		} else {
			$array['error'] = 'Tamanho inexistente';
		}
	} else {
		$array['error'] = 'Dados não enviados';
	}
} else {
	$array['error'] = 'Método não permitido (Apenas PUT)';
}

require('../return.php');

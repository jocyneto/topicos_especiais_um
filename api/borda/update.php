<?php

require('../config.php');


$method = strtolower($_SERVER['REQUEST_METHOD']);
if ($method === 'put') {

	parse_str(file_get_contents('php://input'), $input);

	$borda = $input['borda'] ?? null;
	$descricao = $input['descricao'] ?? null;
	$valor = $input['valor'] ?? null;

	$borda = filter_var($borda);
	$descricao = filter_var($descricao);
	$valor = filter_var($valor);

	if ($borda && $descricao && $valor) {
		$sql = $pdo->prepare("SELECT * FROM borda WHERE borda = :borda");
		$sql->bindValue(':borda', $borda);
		$sql->execute();

		if ($sql->rowCount() > 0) {
			$sql = $pdo->prepare("UPDATE borda SET descricao = :descricao, valor = :valor WHERE borda = :borda");
			$sql->bindValue(':borda', $borda);
			$sql->bindValue(':descricao', $descricao);
			$sql->bindValue(':valor', $valor);
			$sql->execute();

			$array['result'] = [
				'borda' => $borda,
				'descricao' => $descricao,
				'valor' => $valor
			];
		} else {
			$array['error'] = 'Borda inexistente';
		}
	} else {
		$array['error'] = 'Dados não enviados';
	}
} else {
	$array['error'] = 'Método não permitido (Apenas PUT)';
}

require('../return.php');

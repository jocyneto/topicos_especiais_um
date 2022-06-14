<?php

require('../config.php');


$method = strtolower($_SERVER['REQUEST_METHOD']);
if ($method === 'put') {

	parse_str(file_get_contents('php://input'), $input);

	$bebida = $input['bebida'] ?? null;
	$descricao = $input['descricao'] ?? null;
	$valor = $input['valor'] ?? null;
	$imagem = $input['imagem'] ?? null;

	$bebida = filter_var($bebida);
	$descricao = filter_var($descricao);
	$valor = filter_var($valor);
	$imagem = filter_var($imagem);

	if ($bebida && $descricao && $valor && $imagem) {
		$sql = $pdo->prepare("SELECT * FROM bebida WHERE bebida = :bebida");
		$sql->bindValue(':bebida', $bebida);
		$sql->execute();

		if ($sql->rowCount() > 0) {
			$sql = $pdo->prepare("UPDATE bebida SET descricao = :descricao, valor = :valor, imagem = :imagem WHERE bebida = :bebida");
			$sql->bindValue(':bebida', $bebida);
			$sql->bindValue(':descricao', $descricao);
			$sql->bindValue(':valor', $valor);
			$sql->bindValue(':imagem', $descricao);
			$sql->execute();

			$array['result'] = [
				'bebida' => $bebida,
				'descricao' => $descricao,
				'valor' => $valor,
				'imagem' => $imagem
			];
		} else {
			$array['error'] = 'Bebida inexistente';
		}
	} else {
		$array['error'] = 'Dados não enviados';
	}
} else {
	$array['error'] = 'Método não permitido (Apenas PUT)';
}

require('../return.php');

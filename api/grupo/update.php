<?php

require('../config.php');


$method = strtolower($_SERVER['REQUEST_METHOD']);
if ($method === 'put') {

	parse_str(file_get_contents('php://input'), $input);

	$grupo = $input['grupo'] ?? null;
	$descricao = $input['descricao'] ?? null;

	$grupo = filter_var($grupo);
	$descricao = filter_var($descricao);

	if ($grupo && $descricao) {
		$sql = $pdo->prepare("SELECT * FROM grupo WHERE grupo = :grupo");
		$sql->bindValue(':grupo', $grupo);
		$sql->execute();

		if ($sql->rowCount() > 0) {
			$sql = $pdo->prepare("UPDATE grupo SET descricao = :descricao WHERE grupo = :grupo");
			$sql->bindValue(':grupo', $grupo);
			$sql->bindValue(':descricao', $descricao);
			$sql->execute();

			$array['result'] = [
				'grupo' => $grupo,
				'descricao' => $descricao
			];
		} else {
			$array['error'] = 'Grupo inexistente';
		}
	} else {
		$array['error'] = 'Dados não enviados';
	}
} else {
	$array['error'] = 'Método não permitido (Apenas PUT)';
}

require('../return.php');

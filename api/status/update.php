<?php

require('../config.php');


$method = strtolower($_SERVER['REQUEST_METHOD']);
if ($method === 'put') {

	parse_str(file_get_contents('php://input'), $input);

	$status = $input['status'] ?? null;
	$descricao = $input['descricao'] ?? null;

	$status = filter_var($status);
	$descricao = filter_var($descricao);

	if ($status && $descricao) {
		$sql = $pdo->prepare("SELECT * FROM status WHERE status = :status");
		$sql->bindValue(':status', $status);
		$sql->execute();

		if ($sql->rowCount() > 0) {
			$sql = $pdo->prepare("UPDATE status SET descricao = :descricao WHERE status = :status");
			$sql->bindValue(':status', $status);
			$sql->bindValue(':descricao', $descricao);
			$sql->execute();

			$array['result'] = [
				'status' => $status,
				'descricao' => $descricao
			];
		} else {
			$array['error'] = 'Status inexistente';
		}
	} else {
		$array['error'] = 'Dados não enviados';
	}
} else {
	$array['error'] = 'Método não permitido (Apenas PUT)';
}

require('../return.php');

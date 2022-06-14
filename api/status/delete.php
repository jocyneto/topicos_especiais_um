<?php

require('../config.php');


$method = strtolower($_SERVER['REQUEST_METHOD']);
if ($method === 'delete') {

	parse_str(file_get_contents('php://input'), $input);

	$status = $input['status'] ?? null;

	$status = filter_var($status);

	if ($status) {
		$sql = $pdo->prepare("SELECT * FROM status WHERE status = :status");
		$sql->bindValue(':status', $status);
		$sql->execute();

		if ($sql->rowCount() > 0) {
			$sql = $pdo->prepare("DELETE FROM status WHERE status = :status");
			$sql->bindValue(':status', $status);
			$sql->execute();
		} else {
			$array['error'] = 'Status inexistente';
		}
	} else {
		$array['error'] = 'Status não enviado';
	}
} else {
	$array['error'] = 'Método não permitido (Apenas DELETE)';
}

require('../return.php');

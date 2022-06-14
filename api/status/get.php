<?php

require('../config.php');

$method = strtolower($_SERVER['REQUEST_METHOD']);
if ($method === 'get') {

	$status = filter_input(INPUT_GET, 'status');

	$sql = $pdo->prepare("SELECT * FROM status WHERE status = :status");
	$sql->bindValue(':status', $status);
	$sql->execute();

	if ($status) {
		if ($sql->rowCount() > 0) {
			$data = $sql->fetch(PDO::FETCH_ASSOC);
			$array['result'] = [
				'status' => $data['STATUS'],
				'descricao' => $data['DESCRICAO']
			];
		} else {
			$array['error'] = 'Status inexistente';
		}
	} else {
		$array['error'] = 'Status não enviada';
	}
} else {
	$array['error'] = 'Método não permitido (Apenas GET)';
}

require('../return.php');

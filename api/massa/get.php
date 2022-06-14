<?php

require('../config.php');

$method = strtolower($_SERVER['REQUEST_METHOD']);
if ($method === 'get') {

	$massa = filter_input(INPUT_GET, 'massa');

	$sql = $pdo->prepare("SELECT * FROM massa WHERE massa = :massa");
	$sql->bindValue(':massa', $massa);
	$sql->execute();

	if ($massa) {
		if ($sql->rowCount() > 0) {
			$data = $sql->fetch(PDO::FETCH_ASSOC);
			$array['result'] = [
				'massa' => $data['MASSA'],
				'descricao' => $data['DESCRICAO']
			];
		} else {
			$array['error'] = 'Massa inexistente';
		}
	} else {
		$array['error'] = 'Massa não enviada';
	}
} else {
	$array['error'] = 'Método não permitido (Apenas GET)';
}

require('../return.php');

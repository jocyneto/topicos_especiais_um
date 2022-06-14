<?php

require('../config.php');

$method = strtolower($_SERVER['REQUEST_METHOD']);
if ($method === 'get') {

	$sabor = filter_input(INPUT_GET, 'sabor');

	$sql = $pdo->prepare("SELECT * FROM sabor WHERE sabor = :sabor");
	$sql->bindValue(':sabor', $sabor);
	$sql->execute();

	if ($sabor) {
		if ($sql->rowCount() > 0) {
			$data = $sql->fetch(PDO::FETCH_ASSOC);
			$array['result'] = [
				'sabor' => $data['SABOR'],
				'nome' => $data['NOME'],
				'imagem' => $data['IMAGEM']
			];
		} else {
			$array['error'] = 'Sabor inexistente';
		}
	} else {
		$array['error'] = 'Sabor não enviado';
	}
} else {
	$array['error'] = 'Método não permitido (Apenas GET)';
}

require('../return.php');

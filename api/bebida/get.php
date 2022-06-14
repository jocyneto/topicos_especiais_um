<?php

require('../config.php');

$method = strtolower($_SERVER['REQUEST_METHOD']);
if ($method === 'get') {

	$bebida = filter_input(INPUT_GET, 'bebida');

	$sql = $pdo->prepare("SELECT * FROM bebida WHERE bebida = :bebida");
	$sql->bindValue(':bebida', $bebida);
	$sql->execute();

	if ($bebida) {
		if ($sql->rowCount() > 0) {
			$data = $sql->fetch(PDO::FETCH_ASSOC);
			$array['result'] = [
				'bebida' => $data['BEBIDA'],
				'descricao' => $data['DESCRICAO'],
				'valor' => $data['VALOR'],
				'imagem' => $data['IMAGEM']
			];
		} else {
			$array['error'] = 'Bebida inexistente';
		}
	} else {
		$array['error'] = 'Bebida não enviada';
	}
} else {
	$array['error'] = 'Método não permitido (Apenas GET)';
}

require('../return.php');

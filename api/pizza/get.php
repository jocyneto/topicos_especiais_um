<?php

require('../config.php');

$method = strtolower($_SERVER['REQUEST_METHOD']);
if ($method === 'get') {

	$pizza = filter_input(INPUT_GET, 'pizza');

	$sql = $pdo->prepare("SELECT * FROM pizza WHERE pizza = :pizza");
	$sql->bindValue(':pizza', $pizza);
	$sql->execute();

	if ($pizza) {
		if ($sql->rowCount() > 0) {
			$data = $sql->fetch(PDO::FETCH_ASSOC);
			$array['result'] = [
				'pizza' => $data['PIZZA'],
				'tamanho' => $data['TAMANHO'],
				'massa' => $data['MASSA'],
				'borda' => $data['BORDA'],
				'sabor' => $data['SABOR'],
				'valor' => $data['VALOR']
			];
		} else {
			$array['error'] = 'Pizza inexistente';
		}
	} else {
		$array['error'] = 'Pizza não enviada';
	}
} else {
	$array['error'] = 'Método não permitido (Apenas GET)';
}

require('../return.php');

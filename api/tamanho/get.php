<?php

require('../config.php');

$method = strtolower($_SERVER['REQUEST_METHOD']);
if ($method === 'get') {

	$tamanho = filter_input(INPUT_GET, 'tamanho');

	$sql = $pdo->prepare("SELECT * FROM tamanho WHERE tamanho = :tamanho");
	$sql->bindValue(':tamanho', $tamanho);
	$sql->execute();

	if ($tamanho) {
		if ($sql->rowCount() > 0) {
			$data = $sql->fetch(PDO::FETCH_ASSOC);
			$array['result'] = [
				'tamanho' => $data['TAMANHO'],
				'sigla' => $data['SIGLA'],
				'descricao' => $data['DESCRICAO'],
				'valor' => $data['VALOR']
			];
		} else {
			$array['error'] = 'Tamanho inexistente';
		}
	} else {
		$array['error'] = 'Tamanho não enviada';
	}
} else {
	$array['error'] = 'Método não permitido (Apenas GET)';
}

require('../return.php');

<?php

require('../config.php');


$method = strtolower($_SERVER['REQUEST_METHOD']);
if ($method === 'delete') {

	parse_str(file_get_contents('php://input'), $input);

	$tamanho = $input['tamanho'] ?? null;

	$tamanho = filter_var($tamanho);

	if ($tamanho) {
		$sql = $pdo->prepare("SELECT * FROM tamanho WHERE tamanho = :tamanho");
		$sql->bindValue(':tamanho', $tamanho);
		$sql->execute();

		if ($sql->rowCount() > 0) {
			$sql = $pdo->prepare("DELETE FROM tamanho WHERE tamanho = :tamanho");
			$sql->bindValue(':tamanho', $tamanho);
			$sql->execute();
		} else {
			$array['error'] = 'Tamanho inexistente';
		}
	} else {
		$array['error'] = 'Tamanho não enviado';
	}
} else {
	$array['error'] = 'Método não permitido (Apenas DELETE)';
}

require('../return.php');

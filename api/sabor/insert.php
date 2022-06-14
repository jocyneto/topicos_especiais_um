<?php

require('../config.php');


$method = strtolower($_SERVER['REQUEST_METHOD']);
if ($method === 'post') {

	$nome = filter_input(INPUT_POST, 'nome');
	$imagem = filter_input(INPUT_POST, 'imagem');

	if ($nome && $imagem) {
		$sql = $pdo->prepare("INSERT INTO sabor (nome, imagem) VALUES (:nome, :imagem)");
		$sql->bindValue(':nome', $nome);
		$sql->bindValue(':imagem', $imagem);
		$sql->execute();

		$sabor = $pdo->lastInsertId();

		$array['result'] = [
			'sabor' => $sabor,
			'nome' => $nome,
			'imagem' => $imagem
		];
	} else {
		$array['error'] = 'Campos não enviados';
	}
} else {
	$array['error'] = 'Método não permitido (Apenas POST)';
}

require('../return.php');

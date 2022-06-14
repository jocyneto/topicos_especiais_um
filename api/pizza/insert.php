<?php

require('../config.php');

$method = strtolower($_SERVER['REQUEST_METHOD']);
if ($method === 'post') {
	$data = file_get_contents("php://input");
	$decode_data = json_decode($data, true);
	$tamanho = $decode_data['tamanho'];
	$massa =  $decode_data['massa'];
	$borda =  $decode_data['borda'];
	$sabor =  $decode_data['sabor'];
	// $valor =  $decode_data['valor'];

	$sql = $pdo->prepare("SELECT 
							valor 
						FROM tamanho
						WHERE tamanho = :tamanho");
	$sql->bindValue(':tamanho', $tamanho);
	$sql->execute();

	if ($sql->rowCount() > 0) {
		$tamanhoPreco = $sql->fetch(PDO::FETCH_ASSOC);
	}

	$sql = $pdo->prepare("SELECT 
							valor
						FROM borda
						WHERE borda = :borda");
	$sql->bindValue(':borda', $borda);
	$sql->execute();

	if ($sql->rowCount() > 0) {
		$bordaPreco = $sql->fetch(PDO::FETCH_ASSOC);
	}

	$valor = $bordaPreco['valor'] + $tamanhoPreco['valor'];

	if ($tamanho && $massa && $borda && $sabor && $valor) {
		$sql = $pdo->prepare("INSERT INTO pizza (tamanho, massa, borda, sabor, valor) VALUES (:tamanho, :massa, :borda, :sabor, :valor)");
		$sql->bindValue(':tamanho', $tamanho);
		$sql->bindValue(':massa', $massa);
		$sql->bindValue(':borda', $borda);
		$sql->bindValue(':sabor', $sabor);
		$sql->bindValue(':valor', $valor);
		$sql->execute();

		$pizza = $pdo->lastInsertId();

		$array['result'] = [
			'pizza' => $pizza,
			'tamanho' => $tamanho,
			'massa' => $massa,
			'borda' => $borda,
			'sabor' => $sabor,
			'valor' => $valor
		];
	} else {
		$array['error'] = 'Campos não enviados';
	}
} else {
	$array['error'] = 'Método não permitido (Apenas POST)';
}

require('../return.php');

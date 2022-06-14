<?php

require('../config.php');


$method = strtolower($_SERVER['REQUEST_METHOD']);
if ($method === 'put') {

	$data = file_get_contents("php://input");
	$decode_data = json_decode($data, true);

	// $pizza =  $decode_data['pizza'];
	$tamanho = $decode_data['tamanho'];
	$massa =  $decode_data['massa'];
	$borda =  $decode_data['borda'];
	$sabor =  $decode_data['sabor'];
	$pedido = $decode_data['pedido'];

	$sql = $pdo->prepare("SELECT 
							pizza 
						FROM pedido
						WHERE pedido = :pedido");
	$sql->bindValue(':pedido', $pedido);
	$sql->execute();

	if ($sql->rowCount() > 0) {
		$pizza = $sql->fetch(PDO::FETCH_ASSOC);
		$pizza = $pizza['pizza'];
	}

	$sql = $pdo->prepare("SELECT 
							be.valor 
						FROM pedido as pe
						JOIN bebida as be ON be.bebida = pe.bebida
						WHERE pe.pedido = :pedido");
	$sql->bindValue(':pedido', $pedido);
	$sql->execute();

	if ($sql->rowCount() > 0) {
		$bebidaPreco = $sql->fetch(PDO::FETCH_ASSOC);
	}

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

	$valorPizza = $bordaPreco['valor'] + $tamanhoPreco['valor'];
	$valorPedido = $bebidaPreco['valor'] + $valorPizza;

	if ($pizza && $tamanho && $massa && $borda && $sabor) {
		$sql = $pdo->prepare("UPDATE pizza SET tamanho = :tamanho, massa = :massa, borda = :borda, sabor = :sabor, valor = :valor WHERE pizza = :pizza");
		$sql->bindValue(':pizza', $pizza);
		$sql->bindValue(':tamanho', $tamanho);
		$sql->bindValue(':massa', $massa);
		$sql->bindValue(':borda', $borda);
		$sql->bindValue(':sabor', $sabor);
		$sql->bindValue(':valor', $valorPizza);
		$sql->execute();

		$sql = $pdo->prepare("UPDATE pedido SET valor = :valor WHERE pedido = :pedido");
		$sql->bindValue(':valor', $valorPedido);
		$sql->bindValue(':pedido', $pedido);
		$sql->execute();

		$array['result'] = [
			'pizza' => $pizza,
			'tamanho' => $tamanho,
			'massa' => $massa,
			'borda' => $borda,
			'sabor' => $sabor
		];
	} else {
		$array['error'] = 'Dados não enviados';
	}
} else {
	$array['error'] = 'Método não permitido (Apenas PUT)';
}

require('../return.php');

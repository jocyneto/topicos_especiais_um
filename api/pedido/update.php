<?php

require('../config.php');


$method = strtolower($_SERVER['REQUEST_METHOD']);
if ($method === 'put') {
	$data = file_get_contents("php://input");
	$decode_data = json_decode($data, true);

	$pedido = $decode_data['pedido'];
	$status = $decode_data['status'];
	$bebida = $decode_data['bebida'];
	// $valor = $decode_data['valor'];

	$sql = $pdo->prepare("SELECT 
							valor 
						FROM bebida
						WHERE bebida = :bebida");
	$sql->bindValue(':bebida', $bebida);
	$sql->execute();

	if ($sql->rowCount() > 0) {
		$bebidaPreco = $sql->fetch(PDO::FETCH_ASSOC);
	}

	$sql = $pdo->prepare("SELECT 
							pi.valor 
						FROM pedido AS pe
						JOIN pizza AS pi ON pi.pizza = pe.pizza
						WHERE pe.pedido = :pedido");
	$sql->bindValue(':pedido', $pedido);
	$sql->execute();

	if ($sql->rowCount() > 0) {
		$pizzaPreco = $sql->fetch(PDO::FETCH_ASSOC);
	}

	$valor = $bebidaPreco['valor'] + $pizzaPreco['valor'];

	/* if ($pedido && $status && $bebida && $valor) { */
	$sql = $pdo->prepare("SELECT * FROM pedido WHERE pedido = :pedido");
	$sql->bindValue(':pedido', $pedido);
	$sql->execute();

	if ($sql->rowCount() > 0) {
		$sql = $pdo->prepare("UPDATE pedido SET status = :status, bebida = :bebida, valor = :valor WHERE pedido = :pedido");
		$sql->bindValue(':pedido', $pedido);
		$sql->bindValue(':status', $status);
		$sql->bindValue(':bebida', $bebida);
		$sql->bindValue(':valor', $valor);
		$sql->execute();

		$array['result'] = [
			'pedido' => $pedido,
			'status' => $status,
			'bebida' => $bebida,
			'valor' => $valor,
		];
	} else {
		$array['error'] = 'Pedido inexistente';
	}
	/* } else {
		$array['error'] = 'Dados não enviados';
	} */
} else {
	$array['error'] = 'Método não permitido (Apenas PUT)';
}

require('../return.php');

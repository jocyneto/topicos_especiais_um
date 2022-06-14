<?php

require('../config.php');


$method = strtolower($_SERVER['REQUEST_METHOD']);
if ($method === 'post') {
	$data = file_get_contents("php://input");
	$decode_data = json_decode($data, true);

	$pizza = $decode_data['pizza'];
	$status =  $decode_data['status'];
	$bebida =  $decode_data['bebida'];
	// $valor =  $decode_data['valor'];
	$usuario =  $decode_data['usuario'];

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
							valor 
						FROM pizza
						WHERE pizza = :pizza");
	$sql->bindValue(':pizza', $pizza);
	$sql->execute();

	if ($sql->rowCount() > 0) {
		$pizzaPreco = $sql->fetch(PDO::FETCH_ASSOC);
	}

	$valor = $bebidaPreco['valor'] + $pizzaPreco['valor'];

	/* if ($pizza && $status && $bebida && $valor && $usuario) { */
	$sql = $pdo->prepare("INSERT INTO pedido (pizza, status, bebida, valor, usuario) VALUES (:pizza, :status, :bebida, :valor, :usuario)");
	$sql->bindValue(':pizza', $pizza);
	$sql->bindValue(':status', $status);
	$sql->bindValue(':bebida', $bebida);
	$sql->bindValue(':valor', $valor);
	$sql->bindValue(':usuario', $usuario);
	$sql->execute();

	$pedido = $pdo->lastInsertId();

	$array['result'] = [
		'pedido' => $pedido,
		'pizza' => $pizza,
		'status' => $status,
		'bebida' => $bebida,
		'valor' => $valor,
		'usuario' => $usuario
	];
	/* } else {
		$array['error'] = 'Campos não enviados';
	} */
} else {
	$array['error'] = 'Método não permitido (Apenas POST)';
}

require('../return.php');

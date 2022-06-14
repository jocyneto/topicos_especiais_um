<?php

require('../config.php');

$method = strtolower($_SERVER['REQUEST_METHOD']);
if ($method === 'get') {

	$pedido = filter_input(INPUT_GET, 'pedido');

	$sql = $pdo->prepare("SELECT * FROM pedido WHERE pedido = :pedido");
	$sql->bindValue(':pedido', $pedido);
	$sql->execute();

	if ($pedido) {
		if ($sql->rowCount() > 0) {
			$data = $sql->fetch(PDO::FETCH_ASSOC);
			$array['result'] = [
				'pedido' => $data['PEDIDO'],
				'pizza' => $data['PIZZA'],
				'status' => $data['STATUS'],
				'bebida' => $data['BEBIDA'],
				'valor' => $data['VALOR'],
				'usuario' => $data['USUARIO']
			];
		} else {
			$array['error'] = 'Pedido inexistente';
		}
	} else {
		$array['error'] = 'Pedido não enviada';
	}
} else {
	$array['error'] = 'Método não permitido (Apenas GET)';
}

require('../return.php');

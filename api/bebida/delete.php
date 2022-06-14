<?php

require('../config.php');


$method = strtolower($_SERVER['REQUEST_METHOD']);
if ($method === 'delete') {

	parse_str(file_get_contents('php://input'), $input);

	$bebida = $input['bebida'] ?? null;

	$bebida = filter_var($bebida);

	if ($bebida) {
		$sql = $pdo->prepare("SELECT * FROM bebida WHERE bebida = :bebida");
		$sql->bindValue(':bebida', $bebida);
		$sql->execute();

		if ($sql->rowCount() > 0) {
			$sql = $pdo->prepare("DELETE FROM bebida WHERE bebida = :bebida");
			$sql->bindValue(':bebida', $bebida);
			$sql->execute();
		} else {
			$array['error'] = 'Bebida inexistente';
		}
	} else {
		$array['error'] = 'Bebida não enviado';
	}
} else {
	$array['error'] = 'Método não permitido (Apenas DELETE)';
}

require('../return.php');

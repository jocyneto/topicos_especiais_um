<?php

require('../config.php');


$method = strtolower($_SERVER['REQUEST_METHOD']);
if ($method === 'delete') {

	parse_str(file_get_contents('php://input'), $input);

	$sabor = $input['sabor'] ?? null;

	$sabor = filter_var($sabor);

	if ($sabor) {
		$sql = $pdo->prepare("SELECT * FROM sabor WHERE sabor = :sabor");
		$sql->bindValue(':sabor', $sabor);
		$sql->execute();

		if ($sql->rowCount() > 0) {
			$sql = $pdo->prepare("DELETE FROM sabor WHERE sabor = :sabor");
			$sql->bindValue(':sabor', $sabor);
			$sql->execute();
		} else {
			$array['error'] = 'Sabor inexistente';
		}
	} else {
		$array['error'] = 'Sabor não enviado';
	}
} else {
	$array['error'] = 'Método não permitido (Apenas DELETE)';
}

require('../return.php');

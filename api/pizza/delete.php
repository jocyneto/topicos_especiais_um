<?php

require('../config.php');


$method = strtolower($_SERVER['REQUEST_METHOD']);
if ($method === 'delete') {

	parse_str(file_get_contents('php://input'), $input);

	$pizza = $input['pizza'] ?? null;

	$pizza = filter_var($pizza);

	if ($pizza) {
		$sql = $pdo->prepare("SELECT * FROM pizza WHERE pizza = :pizza");
		$sql->bindValue(':pizza', $pizza);
		$sql->execute();

		if ($sql->rowCount() > 0) {
			$sql = $pdo->prepare("DELETE FROM pizza WHERE pizza = :pizza");
			$sql->bindValue(':pizza', $pizza);
			$sql->execute();
		} else {
			$array['error'] = 'Pizza inexistente';
		}
	} else {
		$array['error'] = 'Pizza não enviado';
	}
} else {
	$array['error'] = 'Método não permitido (Apenas DELETE)';
}

require('../return.php');

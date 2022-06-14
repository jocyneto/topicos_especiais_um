<?php

require('../config.php');


$method = strtolower($_SERVER['REQUEST_METHOD']);
if ($method === 'delete') {

	parse_str(file_get_contents('php://input'), $input);

	$usuario = $input['usuario'] ?? null;

	$usuario = filter_var($usuario);

	if ($usuario) {
		$sql = $pdo->prepare("SELECT * FROM usuario WHERE usuario = :usuario");
		$sql->bindValue(':usuario', $usuario);
		$sql->execute();

		if ($sql->rowCount() > 0) {
			$sql = $pdo->prepare("DELETE FROM usuario WHERE usuario = :usuario");
			$sql->bindValue(':usuario', $usuario);
			$sql->execute();
		} else {
			$array['error'] = 'Usuário inexistente';
		}
	} else {
		$array['error'] = 'Usuário não enviado';
	}
} else {
	$array['error'] = 'Método não permitido (Apenas DELETE)';
}

require('../return.php');

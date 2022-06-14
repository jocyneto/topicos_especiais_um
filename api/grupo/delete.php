<?php

require('../config.php');


$method = strtolower($_SERVER['REQUEST_METHOD']);
if ($method === 'delete') {

	parse_str(file_get_contents('php://input'), $input);

	$grupo = $input['grupo'] ?? null;

	$grupo = filter_var($grupo);

	if ($grupo) {
		$sql = $pdo->prepare("SELECT * FROM grupo WHERE grupo = :grupo");
		$sql->bindValue(':grupo', $grupo);
		$sql->execute();

		if ($sql->rowCount() > 0) {
			$sql = $pdo->prepare("DELETE FROM grupo WHERE grupo = :grupo");
			$sql->bindValue(':grupo', $grupo);
			$sql->execute();
		} else {
			$array['error'] = 'Grupo inexistente';
		}
	} else {
		$array['error'] = 'Grupo não enviado';
	}
} else {
	$array['error'] = 'Método não permitido (Apenas DELETE)';
}

require('../return.php');

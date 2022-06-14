<?php

require('../config.php');


$method = strtolower($_SERVER['REQUEST_METHOD']);
if ($method === 'delete') {

	parse_str(file_get_contents('php://input'), $input);

	$massa = $input['massa'] ?? null;

	$massa = filter_var($massa);

	if ($massa) {
		$sql = $pdo->prepare("SELECT * FROM massa WHERE massa = :massa");
		$sql->bindValue(':massa', $massa);
		$sql->execute();

		if ($sql->rowCount() > 0) {
			$sql = $pdo->prepare("DELETE FROM massa WHERE massa = :massa");
			$sql->bindValue(':massa', $massa);
			$sql->execute();
		} else {
			$array['error'] = 'Massa inexistente';
		}
	} else {
		$array['error'] = 'Massa não enviado';
	}
} else {
	$array['error'] = 'Método não permitido (Apenas DELETE)';
}

require('../return.php');

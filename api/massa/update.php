<?php

require('../config.php');


$method = strtolower($_SERVER['REQUEST_METHOD']);
if ($method === 'put') {

	parse_str(file_get_contents('php://input'), $input);

	$massa = $input['massa'] ?? null;
	$descricao = $input['descricao'] ?? null;

	$massa = filter_var($massa);
	$descricao = filter_var($descricao);

	if ($massa && $descricao) {
		$sql = $pdo->prepare("SELECT * FROM massa WHERE massa = :massa");
		$sql->bindValue(':massa', $massa);
		$sql->execute();

		if ($sql->rowCount() > 0) {
			$sql = $pdo->prepare("UPDATE massa SET descricao = :descricao WHERE massa = :massa");
			$sql->bindValue(':massa', $massa);
			$sql->bindValue(':descricao', $descricao);
			$sql->execute();

			$array['result'] = [
				'massa' => $massa,
				'descricao' => $descricao
			];
		} else {
			$array['error'] = 'Massa inexistente';
		}
	} else {
		$array['error'] = 'Dados não enviados';
	}
} else {
	$array['error'] = 'Método não permitido (Apenas PUT)';
}

require('../return.php');

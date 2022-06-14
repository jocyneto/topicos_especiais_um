<?php

require('../config.php');


$method = strtolower($_SERVER['REQUEST_METHOD']);
if ($method === 'delete') {

	parse_str(file_get_contents('php://input'), $input);

	$borda = $input['borda'] ?? null;

	$borda = filter_var($borda);

	if ($borda) {
		$sql = $pdo->prepare("SELECT * FROM borda WHERE borda = :borda");
		$sql->bindValue(':borda', $borda);
		$sql->execute();

		if ($sql->rowCount() > 0) {
			$sql = $pdo->prepare("DELETE FROM borda WHERE borda = :borda");
			$sql->bindValue(':borda', $borda);
			$sql->execute();
		} else {
			$array['error'] = 'Borda inexistente';
		}
	} else {
		$array['error'] = 'Borda não enviado';
	}
} else {
	$array['error'] = 'Método não permitido (Apenas DELETE)';
}

require('../return.php');

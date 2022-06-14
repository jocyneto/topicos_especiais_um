<?php

require('../config.php');

$method = strtolower($_SERVER['REQUEST_METHOD']);
if ($method === 'get') {

	$borda = filter_input(INPUT_GET, 'borda');

	$sql = $pdo->prepare("SELECT * FROM borda WHERE borda = :borda");
	$sql->bindValue(':borda', $borda);
	$sql->execute();

	if ($borda) {
		if ($sql->rowCount() > 0) {
			$data = $sql->fetch(PDO::FETCH_ASSOC);
			$array['result'] = [
				'borda' => $data['BORDA'],
				'descricao' => $data['DESCRICAO'],
				'valor' => $data['VALOR']
			];
		} else {
			$array['error'] = 'Borda inexistente';
		}
	} else {
		$array['error'] = 'Borda não enviada';
	}
} else {
	$array['error'] = 'Método não permitido (Apenas GET)';
}

require('../return.php');

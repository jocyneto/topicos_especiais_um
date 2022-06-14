<?php

require('../config.php');

$method = strtolower($_SERVER['REQUEST_METHOD']);
if ($method === 'get') {

	$grupo = filter_input(INPUT_GET, 'grupo');

	$sql = $pdo->prepare("SELECT * FROM grupo WHERE grupo = :grupo");
	$sql->bindValue(':grupo', $grupo);
	$sql->execute();

	if ($grupo) {
		if ($sql->rowCount() > 0) {
			$data = $sql->fetch(PDO::FETCH_ASSOC);
			$array['result'] = [
				'grupo' => $data['GRUPO'],
				'descricao' => $data['DESCRICAO']
			];
		} else {
			$array['error'] = 'Grupo inexistente';
		}
	} else {
		$array['error'] = 'Grupo não enviada';
	}
} else {
	$array['error'] = 'Método não permitido (Apenas GET)';
}

require('../return.php');

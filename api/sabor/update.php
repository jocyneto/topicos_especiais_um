<?php

require('../config.php');


$method = strtolower($_SERVER['REQUEST_METHOD']);
if ($method === 'put') {

	parse_str(file_get_contents('php://input'), $input);

	$sabor = $input['sabor'] ?? null;
	$nome = $input['nome'] ?? null;
	$imagem = $input['imagem'] ?? null;

	$sabor = filter_var($sabor);
	$nome = filter_var($nome);
	$imagem = filter_var($imagem);

	if ($sabor && $nome && $imagem) {
		$sql = $pdo->prepare("SELECT * FROM sabor WHERE sabor = :sabor");
		$sql->bindValue(':sabor', $sabor);
		$sql->execute();

		if ($sql->rowCount() > 0) {
			$sql = $pdo->prepare("UPDATE sabor SET nome = :nome, imagem = :imagem WHERE sabor = :sabor");
			$sql->bindValue(':sabor', $sabor);
			$sql->bindValue(':nome', $nome);
			$sql->bindValue(':imagem', $imagem);
			$sql->execute();

			$array['result'] = [
				'sabor' => $sabor,
				'nome' => $nome,
				'imagem' => $imagem
			];
		} else {
			$array['error'] = 'Sabor inexistente';
		}
	} else {
		$array['error'] = 'Dados não enviados';
	}
} else {
	$array['error'] = 'Método não permitido (Apenas PUT)';
}

require('../return.php');

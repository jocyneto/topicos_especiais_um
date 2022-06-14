<?php

require('../config.php');


$method = strtolower($_SERVER['REQUEST_METHOD']);
if ($method === 'post') {

	$grupo = filter_input(INPUT_POST, 'grupo');
	$email = filter_input(INPUT_POST, 'email');
	$cpf = filter_input(INPUT_POST, 'cpf');
	$senha = filter_input(INPUT_POST, 'senha');
	$nome = filter_input(INPUT_POST, 'nome');
	$sobrenome = filter_input(INPUT_POST, 'sobrenome');

	$senha = password_hash($senha, PASSWORD_DEFAULT);

	if ($grupo && $email && $cpf && $senha && $nome && $sobrenome) {
		$sql = $pdo->prepare("INSERT INTO usuario (grupo, email, cpf, senha, nome, sobrenome) VALUES (:grupo, :email, :cpf, :senha, :nome, :sobrenome)");
		$sql->bindValue(':grupo', $grupo);
		$sql->bindValue(':email', $email);
		$sql->bindValue(':cpf', $cpf);
		$sql->bindValue(':senha', $senha);
		$sql->bindValue(':nome', $nome);
		$sql->bindValue(':sobrenome', $sobrenome);
		$sql->execute();

		$usuario = $pdo->lastInsertId();

		$array['result'] = [
			'usuario' => $usuario,
			'grupo' => $grupo,
			'cpf' => $cpf,
			'senha' => $senha,
			'nome' => $nome,
			'sobrenome' => $sobrenome
		];
	} else {
		$array['error'] = 'Campos não enviados';
	}
} else {
	$array['error'] = 'Método não permitido (Apenas POST)';
}

require('../return.php');

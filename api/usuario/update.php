<?php

require('../config.php');


$method = strtolower($_SERVER['REQUEST_METHOD']);
if ($method === 'put') {

	parse_str(file_get_contents('php://input'), $input);

	$usuario = $input['usuario'] ?? null;
	$grupo = $input['grupo'] ?? null;
	$email = $input['email'] ?? null;
	$cpf = $input['cpf'] ?? null;
	$senha = $input['senha'] ?? null;
	$nome = $input['nome'] ?? null;
	$sobrenome = $input['sobrenome'] ?? null;

	$usuario = filter_var($usuario);
	$grupo = filter_var($grupo);
	$email = filter_var($email);
	$cpf = filter_var($cpf);
	$senha = filter_var($senha);
	$nome = filter_var($nome);
	$sobrenome = filter_var($sobrenome);

	$senha = password_hash($senha, PASSWORD_DEFAULT);

	if ($usuario && $grupo && $email && $cpf && $senha && $nome && $sobrenome) {
		$sql = $pdo->prepare("SELECT * FROM usuario WHERE usuario = :usuario");
		$sql->bindValue(':usuario', $usuario);
		$sql->execute();

		if ($sql->rowCount() > 0) {
			$sql = $pdo->prepare("UPDATE usuario SET grupo = :grupo, email = :email, cpf = :cpf, senha = :senha, nome = :nome, sobrenome = :sobrenome WHERE usuario = :usuario");
			$sql->bindValue(':usuario', $usuario);
			$sql->bindValue(':grupo', $grupo);
			$sql->bindValue(':email', $email);
			$sql->bindValue(':cpf', $cpf);
			$sql->bindValue(':senha', $senha);
			$sql->bindValue(':nome', $nome);
			$sql->bindValue(':sobrenome', $sobrenome);
			$sql->execute();

			$array['result'] = [
				'usuario' => $usuario,
				'grupo' => $grupo,
				'email' => $email,
				'cpf' => $cpf,
				'senha' => $senha,
				'nome' => $nome,
				'sobrenome' => $sobrenome,
			];
		} else {
			$array['error'] = 'Usuário inexistente';
		}
	} else {
		$array['error'] = 'Dados não enviados';
	}
} else {
	$array['error'] = 'Método não permitido (Apenas PUT)';
}

require('../return.php');

<?php

require('../config.php');

$method = strtolower($_SERVER['REQUEST_METHOD']);
if ($method === 'post') {

	$data = file_get_contents("php://input");
	$decode_data = json_decode($data, true);

	$email = $decode_data['email'];
	$senha = $decode_data['senha'];

	$sql = $pdo->prepare("SELECT senha FROM usuario WHERE email = :email");
	$sql->bindValue(':email', $email);
	$sql->execute();

	$hash = '';
	if ($sql->rowCount() > 0) {
		$dataHash = $sql->fetch(PDO::FETCH_ASSOC);
		$hash = $dataHash['senha'];
	}


	 if (password_verify($senha, $hash)) { 
		$sql = $pdo->prepare("SELECT * FROM usuario WHERE email = :email and senha = :hash");
		$sql->bindValue(':email', $email);
		$sql->bindValue(':hash', $hash);
		$sql->execute();

		 if ($email && $hash) { 
			 if ($sql->rowCount() > 0) { 
				$data = $sql->fetch(PDO::FETCH_ASSOC);
				$array['result'] = [
					'usuario' => $data['USUARIO'],
					'grupo' => $data['GRUPO'],
					'email' => $data['EMAIL'],
					'cpf' => $data['CPF'],
					'senha' => $data['SENHA'],
					'nome' => $data['NOME'],
					'sobrenome' => $data['SOBRENOME'],
					'token' => $data['TOKEN']
				];
			 } else {
				$array['error'] = 'Usuário inexistente';
			} 
		 } else {
			$array['error'] = 'Usuário ou senha incorreta.';
		} 
	 } else {
		$array['error'] = 'Usuário ou senha incorreta';
	} 
} else {
	$array['error'] = 'Método não permitido (Apenas POST)';
}

require('../return.php');
